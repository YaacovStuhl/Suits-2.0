<?php
// Set page title
$page_title = "Logout";
?>

<?php include 'header.php'; ?>

<?php
// Destroy session and clear cookies
session_start();

// Clear session variables
$_SESSION = array();

// Destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Clear username cookie
setcookie('username', '', time() - 3600, '/');
?>

<div class="logout-container">
    <div class="logout-wrapper">
        <h1>👋 Logged Out Successfully</h1>
        <p>You have been successfully logged out of your account.</p>
        <p>Thank you for visiting Simply Suits!</p>
        
        <div class="logout-actions">
            <a href="login.php" class="btn btn-primary">Login Again</a>
            <a href="index.php" class="btn btn-secondary">Return to Home</a>
        </div>
    </div>
</div>

<style>
.logout-container {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.logout-wrapper {
    background: white;
    padding: 3rem;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    text-align: center;
}

.logout-wrapper h1 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 1rem;
    font-size: 2rem;
}

.logout-wrapper p {
    color: #666;
    margin-bottom: 1rem;
    font-size: 1.1rem;
    line-height: 1.6;
}

.logout-actions {
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
    .logout-wrapper {
        padding: 2rem;
        margin: 1rem;
    }
    
    .logout-wrapper h1 {
        font-size: 1.5rem;
    }
    
    .logout-actions {
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
