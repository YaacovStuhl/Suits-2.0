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
    $stmt = $conn->prepare("SELECT user_id, username, password, email, first_name, last_name, phone FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    closeDBConnection($conn);
    
    return $user ? $user : false;
}

/**
 * Get a user by email
 * @param string $email The email to search for
 * @return array|false Returns user array or false if not found
 */
function getUserByEmail($email) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT user_id, username, password, email, first_name, last_name, phone FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
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
    $stmt = $conn->prepare("SELECT user_id, username, password, email, first_name, last_name, phone FROM users WHERE user_id = ?");
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
 * @param string $email Email address
 * @param string $first_name First name
 * @param string $last_name Last name
 * @param string $phone Phone number (optional)
 * @return bool Returns true on success, false on failure
 */
function addUser($username, $password, $email, $first_name, $last_name, $phone = null) {
    // Check if username already exists
    if (getUserByUsername($username)) {
        return false; // Username already exists
    }
    
    // Check if email already exists
    if (getUserByEmail($email)) {
        return false; // Email already exists
    }
    
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, first_name, last_name, phone) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $password, $email, $first_name, $last_name, $phone);
    $result = $stmt->execute();
    $stmt->close();
    closeDBConnection($conn);
    
    return $result;
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
    $result = $conn->query("SELECT user_id, username, email, first_name, last_name, phone FROM users ORDER BY user_id DESC");
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
