<?php
// Set page title
$page_title = "Protected Content";
?>

<?php include 'header.php'; ?>

<?php
// Check if user is logged in
$is_logged_in = isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] === true;
$username = '';

if ($is_logged_in) {
    // Get username from session or cookie
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 
                (isset($_COOKIE['username']) ? $_COOKIE['username'] : 'User');
} else {
    // If not logged in, redirect to login page after 3 seconds
    header('refresh:3;url=login.php');
}
?>

<?php if ($is_logged_in): ?>
    <div class="content-container">
        <div class="welcome-section">
            <h1>🎉 Welcome to Protected Content!</h1>
            <p class="greeting">Hello <strong><?php echo htmlspecialchars($username); ?></strong>!</p>
            <p>You have successfully accessed the protected area of Simply Suits.</p>
        </div>
        
        <div class="protected-content">
            <div class="content-card">
                <h2>🏆 VIP Member Benefits</h2>
                <ul>
                    <li>Exclusive access to premium suit collections</li>
                    <li>Early access to new arrivals and sales</li>
                    <li>Personal styling consultations</li>
                    <li>Free alterations on all purchases</li>
                    <li>Priority customer support</li>
                </ul>
            </div>
            
            <div class="content-card">
                <h2>👔 Premium Collections</h2>
                <p>As a VIP member, you have access to our exclusive premium collections:</p>
                <ul>
                    <li>Designer Italian Suits</li>
                    <li>Custom Tailored Options</li>
                    <li>Limited Edition Pieces</li>
                    <li>Celebrity Style Replicas</li>
                </ul>
            </div>
            
            <div class="content-card">
                <h2>📞 Personal Stylist</h2>
                <p>Need help choosing the perfect suit? Our personal stylists are here to help:</p>
                <ul>
                    <li>Free style consultation</li>
                    <li>Body type analysis</li>
                    <li>Color coordination advice</li>
                    <li>Occasion-specific recommendations</li>
                </ul>
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="index.php" class="btn btn-primary">Browse Collections</a>
            <a href="logout.php" class="btn btn-secondary">Logout</a>
        </div>
    </div>
<?php else: ?>
    <div class="error-container">
        <div class="error-wrapper">
            <h1>🚫 Access Denied</h1>
            <p>You must be logged in to access this content.</p>
            <p>You will be redirected to the login page in a few seconds...</p>
            
            <div class="error-actions">
                <a href="login.php" class="btn btn-primary">Login Now</a>
                <a href="index.php" class="btn btn-secondary">Return to Home</a>
            </div>
        </div>
    </div>
<?php endif; ?>

<style>
.content-container {
    min-height: 60vh;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.welcome-section {
    text-align: center;
    margin-bottom: 3rem;
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.welcome-section h1 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 1rem;
    font-size: 2.5rem;
}

.greeting {
    font-size: 1.5rem;
    color: var(--accent-color, #3498db);
    margin-bottom: 1rem;
}

.welcome-section p {
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
}

.protected-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.content-card {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.content-card:hover {
    transform: translateY(-5px);
}

.content-card h2 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.content-card ul {
    list-style: none;
    padding: 0;
}

.content-card li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #eee;
    color: #666;
}

.content-card li:before {
    content: "✓ ";
    color: var(--accent-color, #3498db);
    font-weight: bold;
}

.action-buttons {
    text-align: center;
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.error-container {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.error-wrapper {
    background: white;
    padding: 3rem;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    text-align: center;
}

.error-wrapper h1 {
    color: #e74c3c;
    margin-bottom: 1rem;
    font-size: 2rem;
}

.error-wrapper p {
    color: #666;
    margin-bottom: 1rem;
    font-size: 1.1rem;
    line-height: 1.6;
}

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

@media (max-width: 768px) {
    .protected-content {
        grid-template-columns: 1fr;
    }
    
    .welcome-section h1 {
        font-size: 2rem;
    }
    
    .greeting {
        font-size: 1.2rem;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 200px;
    }
}

@media (max-width: 480px) {
    .content-container,
    .error-container {
        padding: 1rem;
    }
    
    .welcome-section,
    .content-card,
    .error-wrapper {
        padding: 1.5rem;
    }
}
</style>

<?php include 'footer.php'; ?>
