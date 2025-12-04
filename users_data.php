<?php
/**
 * User Data Functions - MySQL Version
 * Handles user registration, authentication, and management
 */

require_once 'db_config.php';

/**
 * Get a user by username
 * @param string $username The username to search for
 * @return array|false Returns user array or false if not found
 */
function getUserByUsername($username) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT user_id, username, password, phone, updated_at FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    closeDBConnection($conn);
    
    return $user ? $user : false;
}

/**
 * Get a user by ID
 * @param int $user_id The user ID to search for
 * @return array|false Returns user array or false if not found
 */
function getUserById($user_id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT user_id, username, password, phone, updated_at FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    closeDBConnection($conn);
    
    return $user ? $user : false;
}

/**
 * Add a new user to the database
 * @param string $username Username
 * @param string $password Plain text password
 * @param string $phone Phone number (optional, not stored in AuthorizedUsers table)
 * @return bool Returns true on success, false on failure
 */
function addUser($username, $password, $phone = null) {
    // Check if username already exists in the customers table
    if (getUserByUsername($username)) {
        return false; // Username already exists
    }
    
    $conn = null;
    
    try {
        $conn = getDBConnection();
        $conn->begin_transaction();
        
        // Create customer record (used by orders and dropdowns)
        $stmt = $conn->prepare("INSERT INTO users (username, password, phone) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $phone);
        $stmt->execute();
        $stmt->close();
        
        // Keep login credentials in AuthorizedUsers for the legacy login flow
        $authStmt = $conn->prepare("INSERT INTO AuthorizedUsers (username, password) VALUES (?, ?)");
        $authStmt->bind_param("ss", $username, $password);
        $authStmt->execute();
        $authStmt->close();
        
        $conn->commit();
        closeDBConnection($conn);
        
        return true;
    } catch (mysqli_sql_exception $e) {
        if ($conn) {
            $conn->rollback();
            closeDBConnection($conn);
        }
        error_log("MySQL Exception in addUser(): " . $e->getMessage());
        return false;
    } catch (Exception $e) {
        if ($conn) {
            $conn->rollback();
            closeDBConnection($conn);
        }
        error_log("Exception in addUser(): " . $e->getMessage());
        return false;
    }
}

/**
 * Validate user credentials
 * @param string $username Username
 * @param string $password Plain text password
 * @return array|false Returns user array if valid, false otherwise
 */
function validateUser($username, $password) {
    // Ensure we're using MySQL - check that db_config is loaded
    if (!function_exists('getDBConnection')) {
        error_log("ERROR: getDBConnection() not found! Database connection not available.");
        return false;
    }
    
    try {
        $user = getUserByUsername($username);
        
        if (!$user) {
            // User not found in database
            return false;
        }
        
        // Compare plain text password
        if ($user['password'] === $password) {
            // Remove password from returned user data
            unset($user['password']);
            return $user;
        }
        
        // Password doesn't match
        return false;
        
    } catch (Exception $e) {
        error_log("Error in validateUser(): " . $e->getMessage());
        return false;
    }
}

/**
 * Get all users (for admin purposes - use with caution)
 * @return array Returns array of all users
 */
function getAllUsers() {
    $conn = getDBConnection();
    $result = $conn->query("SELECT user_id, username, phone FROM users ORDER BY username ASC");
    $users = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    
    closeDBConnection($conn);
    return $users;
}

?>
