<?php
session_start();
// Set page title
$page_title = "Create Account";
?>

<?php include 'header.php'; ?>

<?php
// Include user data functions
include 'users_data.php';

// Handle form submission
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
    
    // Validation
    $errors = [];
    
    if (empty($username)) {
        $errors[] = 'Username is required.';
    } elseif (strlen($username) < 3) {
        $errors[] = 'Username must be at least 3 characters long.';
    }
    
    if (empty($password)) {
        $errors[] = 'Password is required.';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters long.';
    }
    
    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }
    
    // No email or name required
    
    // Check if username already exists (using MySQL)
    $existing_user = getUserByUsername($username);
    if ($existing_user) {
        $errors[] = 'Username already exists. Please choose a different username.';
    }
    
    if (empty($errors)) {
        // Add user to the system
        if (addUser($username, $password)) {
            $success_message = 'Account created successfully! You can now login with your credentials.';
            
            // Clear form data
            $username = $password = $confirm_password = '';
        } else {
            $error_message = 'Failed to create account. Please try again.';
        }
    } else {
        $error_message = implode('<br>', $errors);
    }
}
?>

<div class="register-container">
    <div class="register-form-wrapper">
        <h1>Create Your Account</h1>
        <p>Join Simply Suits and get access to exclusive content and VIP benefits.</p>
        
        <?php if ($success_message): ?>
            <div class="success-message">
                <p><?php echo $success_message; ?></p>
                <a href="login.php" class="btn btn-primary">Go to Login</a>
            </div>
        <?php else: ?>
            <?php if ($error_message): ?>
                <div class="error-message">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>
            
            <form action="register.php" method="POST" class="register-form">
                
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
                    <small>Must be at least 3 characters long</small>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                        <small>Must be at least 6 characters long</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
</div>
                
                <button type="submit" class="register-btn">Create Account</button>
            </form>
        <?php endif; ?>
        
        <div class="register-links">
            <p>Already have an account? <a href="login.php">Login here</a></p>
            <a href="index.php">← Back to Home</a>
        </div>
    </div>
</div>

<style>
.register-container {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.register-form-wrapper {
    background: white;
    padding: 3rem;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    text-align: center;
}

.register-form-wrapper h1 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 0.5rem;
    font-size: 2rem;
}

.register-form-wrapper p {
    color: #666;
    margin-bottom: 2rem;
    font-size: 1rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
    text-align: left;
}

.form-row .form-group {
    margin-bottom: 0;
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

.form-group small {
    display: block;
    margin-top: 0.25rem;
    color: #666;
    font-size: 0.8rem;
}

.register-btn {
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

.register-btn:hover {
    background-color: var(--accent-color, #3498db);
}

.register-links {
    text-align: center;
}

.register-links p {
    margin-bottom: 1rem;
    color: #666;
}

.register-links a {
    color: var(--accent-color, #3498db);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
    margin: 0 0.5rem;
}

.register-links a:hover {
    color: var(--primary-color, #2c3e50);
    text-decoration: underline;
}

.success-message {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    padding: 1rem;
    border-radius: 5px;
    margin-bottom: 1.5rem;
}

.error-message {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    padding: 1rem;
    border-radius: 5px;
    margin-bottom: 1.5rem;
    text-align: left;
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
    margin-top: 1rem;
}

.btn-primary {
    background-color: var(--primary-color, #2c3e50);
    color: white;
}

.btn-primary:hover {
    background-color: var(--accent-color, #3498db);
    transform: translateY(-2px);
}

@media (max-width: 768px) {
}

@media (max-width: 480px) {
    .register-form-wrapper {
        padding: 2rem;
        margin: 1rem;
    }
    
    .register-form-wrapper h1 {
        font-size: 1.5rem;
    }
}
</style>

<?php include 'footer.php'; ?>
