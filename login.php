<?php
// Set page title
$page_title = "Login";
?>

<?php include 'header.php'; ?>

<div class="login-container">
    <div class="login-form-wrapper">
        <h1>Login to Simply Suits</h1>
        <p>Please enter your credentials to access protected content.</p>
        
        <form action="response.php" method="POST" class="login-form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="login-btn">Login</button>
        </form>
        
        <div class="login-links">
            <p>Don't have an account? <a href="register.php">Create one here</a></p>
            <a href="index.php">← Back to Home</a>
        </div>
    </div>
</div>

<style>
.login-container {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.login-form-wrapper {
    background: white;
    padding: 3rem;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.login-form-wrapper h1 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 0.5rem;
    font-size: 2rem;
}

.login-form-wrapper p {
    color: #666;
    margin-bottom: 2rem;
    font-size: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
    text-align: left;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--primary-color, #2c3e50);
    font-weight: 600;
}

.form-group input {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e1e5e9;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
}

.form-group input:focus {
    outline: none;
    border-color: var(--accent-color, #3498db);
}

.login-btn {
    width: 100%;
    padding: 0.75rem;
    background-color: var(--primary-color, #2c3e50);
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-bottom: 1.5rem;
}

.login-btn:hover {
    background-color: var(--accent-color, #3498db);
}

.login-links {
    text-align: center;
}

.login-links p {
    margin-bottom: 1rem;
    color: #666;
}

.login-links a {
    color: var(--accent-color, #3498db);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.login-links a:hover {
    color: var(--primary-color, #2c3e50);
    text-decoration: underline;
}

@media (max-width: 480px) {
    .login-form-wrapper {
        padding: 2rem;
        margin: 1rem;
    }
    
    .login-form-wrapper h1 {
        font-size: 1.5rem;
    }
}
</style>

<?php include 'footer.php'; ?>
