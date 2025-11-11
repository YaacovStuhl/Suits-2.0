<?php
/**
 * Database Configuration File
 * Contains database connection settings for Simply Suits
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Default XAMPP password is empty
define('DB_NAME', 'simply_suits_db');

/**
 * Get database connection
 * @return mysqli|false Returns MySQLi connection object or false on failure
 */
function getDBConnection() {
    // Create connection
    $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        error_log("MySQL Connection Error: " . $conn->connect_error);
        // Don't die() - return false so calling code can handle it
        // But log the error for debugging
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8mb4 for proper character encoding
    $conn->set_charset("utf8mb4");
    
    return $conn;
}

/**
 * Close database connection
 * @param mysqli $conn The database connection to close
 */
function closeDBConnection($conn) {
    if ($conn) {
        $conn->close();
    }
}

?>

