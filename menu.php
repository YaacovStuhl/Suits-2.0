<?php
// Site Navigation Menu
?>
<nav class="main-navigation">
    <ul id="navigation" class="slimmenu">
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

#navigation,
#navigation ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

#navigation {
    display: flex;
    align-items: center;
    background: transparent;
}

#navigation li {
    background: transparent !important;
    border: none !important;
    float: none !important;
}

#navigation > li {
    position: relative;
    margin: 0 1rem;
}

#navigation > li:first-child {
    margin-left: 0;
}

#navigation > li:last-child {
    margin-right: 0;
}

#navigation > li {
    position: relative;
    margin: 0 1rem;
}

#navigation > li > a {
    color: var(--secondary-color);
    text-decoration: none;
    padding: 0.75rem 1.25rem;
    display: block;
    transition: all 0.3s ease-in-out;
    border-radius: 4px;
    font-weight: 500;
    font-size: 1.1rem;
}

#navigation > li.dropdown > a,
#navigation > li.has-submenu > a {
    padding-right: 2.75rem;
}

#navigation > li > a:hover,
#navigation > li > a:focus {
    background-color: var(--accent-color);
    color: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.menu-collapser {
    background-color: var(--primary-color);
    color: var(--secondary-color);
    border: 1px solid rgba(255, 255, 255, 0.15);
    font-weight: 600;
}

.menu-collapser .collapse-button {
    background-color: var(--accent-color);
    color: var(--secondary-color);
}

.menu-collapser .collapse-button .icon-bar {
    background-color: var(--secondary-color);
}

.menu-collapser .collapse-button:hover {
    background-color: var(--secondary-color);
    color: var(--accent-color);
}

#navigation li .sub-toggle {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    width: auto;
    height: auto;
    padding: 0;
    background: transparent !important;
    border: none;
}

#navigation li .sub-toggle > i {
    display: inline-block;
    color: var(--secondary-color);
    font-size: 0.85rem;
}

#navigation li .sub-toggle.expanded > i {
    color: var(--accent-color);
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
    padding: 0.5rem 0;
    margin: 0;
}

.dropdown:hover > .dropdown-menu {
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
    #navigation {
        flex-direction: column;
        width: 100%;
    }
    
    #navigation > li {
        margin: 0.25rem 0;
        width: 100%;
    }
    
    #navigation > li > a {
        text-align: center;
        padding: 0.75rem 1rem;
        border-radius: 0;
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
