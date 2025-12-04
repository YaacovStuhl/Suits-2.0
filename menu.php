<?php
// Site Navigation Menu
?>
<nav class="main-navigation">
    <ul class="slimmenu">
        <li><a href="index.php">Home</a></li>
        <li><a href="#about">About</a></li>
        <li class="dropdown">
            <a href="#collections">Collections</a>
            <ul class="dropdown-menu">
                <li><a href="#formal">Formal Suits</a></li>
                <li><a href="#casual">Business Casual</a></li>
                <li><a href="#plussize">Plus Size</a></li>
                <li><a href="#sweaters">Sweaters</a></li>
                <li><a href="#winter">Winter Gear</a></li>
                <li><a href="#shirts">Shirts</a></li>
                <li><a href="#accessories">Accessories</a></li>
            </ul>
        </li>
        <li><a href="sizechart.php">Size Chart</a></li>
        <li><a href="order_form.php">Place Order</a></li>
        <li><a href="#feedback">Feedback</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] === true): ?>
            <li class="user-menu">
                <a href="content.php">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></a>
                <ul class="dropdown-menu">
                    <li><a href="content.php">Protected Content</a></li>
                    <li><a href="view_orders.php">View All Orders</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li><a href="login.php" class="login-link">Login</a></li>
            <li><a href="register.php" class="register-link">Create Account</a></li>
        <?php endif; ?>
    </ul>
</nav>

<style>
/* Navigation Menu Styles */
.main-navigation {
    display: flex;
    justify-content: center;
    align-items: center;
}

.nav-menu {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    align-items: center;
}

.nav-menu li {
    position: relative;
    margin: 0 1rem;
}

.nav-menu a {
    color: var(--secondary-color);
    text-decoration: none;
    padding: 0.75rem 1.25rem;
    display: block;
    transition: all 0.3s ease-in-out;
    border-radius: 4px;
    font-weight: 500;
    font-size: 1.1rem;
}

.nav-menu a:hover {
    background-color: var(--accent-color);
    color: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Dropdown Menu Styles */
.dropdown {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background-color: var(--secondary-color);
    min-width: 200px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-radius: 4px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease-in-out;
    z-index: 1000;
    list-style: none;
    padding: 0.5rem 0;
    margin: 0;
}

.dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-menu li {
    margin: 0;
}

.dropdown-menu a {
    color: var(--text-color);
    padding: 0.75rem 1rem;
    border-radius: 0;
    font-size: 0.9rem;
}

.dropdown-menu a:hover {
    background-color: var(--light-gray);
    color: var(--accent-color);
    transform: none;
    box-shadow: none;
}

/* Login and User Menu Styles */
.login-link {
    background-color: var(--accent-color) !important;
    color: var(--secondary-color) !important;
    font-weight: 600 !important;
    border: 2px solid var(--accent-color) !important;
}

.login-link:hover {
    background-color: var(--secondary-color) !important;
    color: var(--accent-color) !important;
    border-color: var(--secondary-color) !important;
}

.register-link {
    background-color: var(--primary-color) !important;
    color: var(--secondary-color) !important;
    font-weight: 600 !important;
    border: 2px solid var(--primary-color) !important;
}

.register-link:hover {
    background-color: var(--secondary-color) !important;
    color: var(--primary-color) !important;
    border-color: var(--secondary-color) !important;
}

.user-menu a {
    background-color: var(--primary-color) !important;
    color: var(--secondary-color) !important;
    font-weight: 600 !important;
}

.user-menu a:hover {
    background-color: var(--accent-color) !important;
    color: var(--secondary-color) !important;
}

/* Menu maintains consistent styling - no active state changes */

/* Responsive Design */
@media (max-width: 768px) {
    .nav-menu {
        flex-direction: column;
        width: 100%;
    }
    
    .nav-menu li {
        margin: 0.25rem 0;
        width: 100%;
    }
    
    .nav-menu a {
        text-align: center;
        padding: 0.75rem 1rem;
    }
    
    .dropdown-menu {
        position: static;
        opacity: 1;
        visibility: visible;
        transform: none;
        box-shadow: none;
        background-color: var(--light-gray);
        margin-top: 0.5rem;
    }
}
</style>
