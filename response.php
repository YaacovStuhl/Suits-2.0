<?php
$page_title = "Login Response";
?>

<?php include 'header.php'; ?>

<?php
include 'users_data.php';


$login_successful = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    

    if (!empty($username) && !empty($password)) {

        $user = validateUser($username, $password);
        
        if ($user) {
            $login_successful = true;
            

            $_SESSION['LoggedIn'] = true;
            $_SESSION['username'] = $username;
            

            setcookie('username', $username, 0, '/');
            
        } else {
            $error_message = 'Invalid username or password. Please try again.';
            $_SESSION['LoggedIn'] = false;
        }
    } else {
        $error_message = 'Please enter both username and password.';
        $_SESSION['LoggedIn'] = false;
    }
} else {

    header('Location: login.php');
    exit();
}
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
