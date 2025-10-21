<?php
// Start session for login system
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>Simply Suits</title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="suits.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    
    <!-- Meta Tags -->
    <meta name="description" content="Simply Suits - Premium quality suits for every occasion. Formal, casual, plus size, and accessories.">
    <meta name="keywords" content="suits, formal wear, business casual, mens clothing, fashion">
    <meta name="author" content="Simply Suits">
</head>
<body>
    <!-- Site Header -->
    <header class="site-header" id="site-header">
        <div class="header-container">
            <!-- Site Logo -->
            <a href="index.php" class="site-logo">
                <img src="images/new-logo.png" alt="Simply Suits Logo" class="site-logo-img">
            </a>
            
            <!-- Include Navigation Menu -->
            <?php include 'menu.php'; ?>
        </div>
    </header>
    
    <!-- Main Content Container -->
    <main class="main-content">
