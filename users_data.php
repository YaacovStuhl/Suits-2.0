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
    $stmt = $conn->prepare("SELECT username, password FROM AuthorizedUsers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    closeDBConnection($conn);
    
    return $user ? $user : false;
}

/**
 * Get a user by ID (Note: AuthorizedUsers table uses username as primary key, not user_id)
 * This function is kept for compatibility but may not work if the table structure differs
 * @param int $user_id The user ID to search for
 * @return array|false Returns user array or false if not found
 */
function getUserById($user_id) {
    // AuthorizedUsers table uses username as primary key, not user_id
    // This function may not be applicable for this table
    return false;
}

/**
 * Add a new user to the database
 * @param string $username Username
 * @param string $password Plain text password
 * @param string $phone Phone number (optional, not stored in AuthorizedUsers table)
 * @return bool Returns true on success, false on failure
 */
function addUser($username, $password, $phone = null) {
    // Check if username already exists
    if (getUserByUsername($username)) {
        return false; // Username already exists
    }
    
    try {
        $conn = getDBConnection();
        
        // Check if email column exists in the table
        $result = $conn->query("SHOW COLUMNS FROM AuthorizedUsers LIKE 'email'");
        $hasEmailColumn = $result && $result->num_rows > 0;
        
        if ($hasEmailColumn) {
            // If email column exists, generate a unique email based on username
            // or set to NULL if the column allows it
            // First, try to get the column definition to see if it allows NULL
            $columnInfo = $conn->query("SHOW COLUMNS FROM AuthorizedUsers WHERE Field = 'email'");
            $column = $columnInfo->fetch_assoc();
            $allowsNull = ($column['Null'] === 'YES');
            
            if ($allowsNull) {
                // Set email to NULL if allowed
                $stmt = $conn->prepare("INSERT INTO AuthorizedUsers (username, password, email) VALUES (?, ?, NULL)");
                $stmt->bind_param("ss", $username, $password);
            } else {
                // Generate a unique email based on username to avoid duplicate empty strings
                $email = $username . '@simplysuits.local';
                $stmt = $conn->prepare("INSERT INTO AuthorizedUsers (username, password, email) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $password, $email);
            }
        } else {
            // No email column, just insert username and password
            $stmt = $conn->prepare("INSERT INTO AuthorizedUsers (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
        }
        
        $result = $stmt->execute();
        
        if (!$result) {
            $error = $stmt->error;
            error_log("Error adding user: " . $error);
            $stmt->close();
            closeDBConnection($conn);
            return false;
        }
        
        $stmt->close();
        closeDBConnection($conn);
        
        return true;
    } catch (mysqli_sql_exception $e) {
        error_log("MySQL Exception in addUser(): " . $e->getMessage());
        return false;
    } catch (Exception $e) {
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
    $result = $conn->query("SELECT username FROM AuthorizedUsers ORDER BY username");
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
