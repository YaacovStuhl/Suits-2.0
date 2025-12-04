<?php
session_start();
require_once 'database_functions.php';
require_once 'users_data.php';

// Redirect if not POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: order_form.php');
    exit();
}

// Initialize variables
$errors = [];
$form_data = [];

// Validate and sanitize input
$user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';
$category_id = isset($_POST['category_id']) ? trim($_POST['category_id']) : '';
$size_id = isset($_POST['size_id']) ? trim($_POST['size_id']) : '';
$product_name = isset($_POST['product_name']) ? trim($_POST['product_name']) : '';
$total_amount = isset($_POST['total_amount']) ? trim($_POST['total_amount']) : '';
$options = isset($_POST['options']) && is_array($_POST['options']) ? $_POST['options'] : [];
$notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';

// Validation
if (empty($user_id)) {
    $errors[] = 'Please select a customer.';
} elseif (!is_numeric($user_id)) {
    $errors[] = 'Invalid customer selection.';
} else {
    // Verify user exists
    $user = getUserById((int)$user_id);
    if (!$user) {
        $errors[] = 'Selected customer does not exist.';
    } else {
        unset($user['password']); // no need to keep sensitive fields in session data
        $form_data['user'] = $user;
    }
}

if (empty($category_id)) {
    $errors[] = 'Please select a category.';
} elseif (!is_numeric($category_id)) {
    $errors[] = 'Invalid category selection.';
} else {
    $category = getCategoryById((int)$category_id);
    if (!$category) {
        $errors[] = 'Selected category does not exist.';
    } else {
        $form_data['category'] = $category;
    }
}

if (empty($size_id)) {
    $errors[] = 'Please select a size.';
} elseif (!is_numeric($size_id)) {
    $errors[] = 'Invalid size selection.';
} else {
    $size = getSizeById((int)$size_id);
    if (!$size) {
        $errors[] = 'Selected size does not exist.';
    } else {
        $form_data['size'] = $size;
    }
}

if (empty($product_name)) {
    $errors[] = 'Product name is required.';
} elseif (strlen($product_name) > 255) {
    $errors[] = 'Product name must be 255 characters or less.';
} else {
    $form_data['product_name'] = htmlspecialchars($product_name);
}

if (empty($total_amount)) {
    $errors[] = 'Total amount is required.';
} elseif (!is_numeric($total_amount)) {
    $errors[] = 'Total amount must be a valid number.';
} elseif ($total_amount <= 0) {
    $errors[] = 'Total amount must be greater than zero.';
} elseif ($total_amount > 99999.99) {
    $errors[] = 'Total amount cannot exceed $99,999.99.';
} else {
    $form_data['total_amount'] = (float)$total_amount;
}

// Store additional form data for confirmation page
$form_data['options'] = $options;
$form_data['notes'] = htmlspecialchars($notes);

// If validation passes, save to database
if (empty($errors)) {
    try {
        $order_id = createOrder(
            (int)$user_id,
            $form_data['product_name'],
            $form_data['total_amount']
        );
        
        if ($order_id) {
            // Store form data in session for confirmation page
            $_SESSION['order_data'] = [
                'order_id' => $order_id,
                'user_id' => (int)$user_id,
                'user' => $form_data['user'],
                'category' => $form_data['category'],
                'size' => $form_data['size'],
                'product_name' => $form_data['product_name'],
                'total_amount' => $form_data['total_amount'],
                'options' => $form_data['options'],
                'notes' => $form_data['notes']
            ];
            
            // Redirect to confirmation page
            header('Location: order_confirmation.php');
            exit();
        } else {
            $errors[] = 'Failed to save order. Please try again.';
        }
    } catch (Exception $e) {
        error_log("Order processing error: " . $e->getMessage());
        $errors[] = 'An error occurred while processing your order. Please try again.';
    }
}

// If we get here, there were errors
// Store form data and errors in session for display
$_SESSION['form_errors'] = $errors;
$_SESSION['form_data'] = $_POST;

// Redirect back to form with errors
header('Location: order_form.php?error=1');
exit();
?>


