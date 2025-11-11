<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1); // Show errors for debugging
ini_set('log_errors', 1);

// Start output buffering to prevent any output before headers
ob_start();

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database configuration
require_once 'db_config.php';

// Clear any accidental output
ob_end_clean();

$login_successful = false;
$error_message = '';

// Process login FIRST, before any output
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    if (!empty($username) && !empty($password)) {
        try {
            // Connect to database
            $conn = getDBConnection();
            
            // Escape user input to prevent SQL injection (using mysqli_real_escape_string)
            // Note: In production, prepared statements are preferred, but following assignment instructions
            $username_escaped = mysqli_real_escape_string($conn, $username);
            $password_escaped = mysqli_real_escape_string($conn, $password);
            
            // Build SQL query as specified: SELECT username FROM AuthorizedUsers WHERE username='XXXX' AND password='XXXX'
            $sql = "SELECT username FROM AuthorizedUsers WHERE username='" . $username_escaped . "' AND password='" . $password_escaped . "'";
            
            // Execute query
            $result = $conn->query($sql);
            
            // Check for query errors
            if ($result === false) {
                $error_message = 'Database error: ' . htmlspecialchars($conn->error) . '<br>SQL: ' . htmlspecialchars($sql);
                $_SESSION['LoggedIn'] = false;
            } else {
                // Check how many rows this statement returns
                $num_rows = $result->num_rows;
                
                // Debug: Show what we found
                if ($num_rows > 0) {
                    // Valid username/password combination found
                    $login_successful = true;
                    
                    // Set session and cookie BEFORE any HTML output
                    $_SESSION['LoggedIn'] = true;
                    $_SESSION['username'] = $username;
                    setcookie('username', $username, 0, '/');
                    
                } else {
                    // No rows returned - invalid username/password combination
                    $error_message = 'Invalid username or password. Query returned 0 rows. Check that username and password exist in AuthorizedUsers table.';
                    $_SESSION['LoggedIn'] = false;
                }
            }
            
            // Close connection
            closeDBConnection($conn);
            
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            error_log("Login error trace: " . $e->getTraceAsString());
            $error_message = 'An error occurred during login. Please try again.';
            $_SESSION['LoggedIn'] = false;
        } catch (Error $e) {
            error_log("Fatal error in login: " . $e->getMessage());
            error_log("Fatal error trace: " . $e->getTraceAsString());
            $error_message = 'A system error occurred. Please contact support.';
            $_SESSION['LoggedIn'] = false;
        }
    } else {
        $error_message = 'Please enter both username and password.';
        $_SESSION['LoggedIn'] = false;
    }
} else {
    // Redirect if not POST request
    header('Location: login.php');
    exit();
}

// NOW it's safe to output HTML
$page_title = "Login Response";
include 'header.php';
?>
<div class="response-container">
    <div class="response-wrapper">
        <?php if ($login_successful): ?>
            <div class="success-message">
                <h1>✅ Login Successful!</h1>
                <p>Welcome back, <strong><?php echo htmlspecialchars($username); ?></strong>!</p>
                <p>You have been successfully logged in.</p>
                
                <div class="success-actions">
                    <a href="content.php" class="btn btn-primary">Access Protected Content</a>
                    <a href="index.php" class="btn btn-secondary">Return to Home</a>
                </div>
            </div>
        <?php else: ?>
            <div class="error-message">
                <h1>❌ Login Failed</h1>
                <p><?php echo htmlspecialchars($error_message); ?></p>
                
                <div class="error-actions">
                    <a href="login.php" class="btn btn-primary">Try Again</a>
                    <a href="index.php" class="btn btn-secondary">Return to Home</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.response-container {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.response-wrapper {
    background: white;
    padding: 3rem;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    text-align: center;
}

.success-message h1 {
    color: #27ae60;
    margin-bottom: 1rem;
    font-size: 2rem;
}

.error-message h1 {
    color: #e74c3c;
    margin-bottom: 1rem;
    font-size: 2rem;
}

.response-wrapper p {
    color: #666;
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
    line-height: 1.6;
}

.success-actions,
.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-block;
}

.btn-primary {
    background-color: var(--primary-color, #2c3e50);
    color: white;
}

.btn-primary:hover {
    background-color: var(--accent-color, #3498db);
    transform: translateY(-2px);
}

.btn-secondary {
    background-color: #95a5a6;
    color: white;
}

.btn-secondary:hover {
    background-color: #7f8c8d;
    transform: translateY(-2px);
}

@media (max-width: 480px) {
    .response-wrapper {
        padding: 2rem;
        margin: 1rem;
    }
    
    .success-message h1,
    .error-message h1 {
        font-size: 1.5rem;
    }
    
    .success-actions,
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 200px;
    }
}
</style>

<?php include 'footer.php'; ?>
