<?php
/**
 * Database Helper Functions
 * Functions for interacting with categories, sizes, and orders
 */

require_once 'db_config.php';

// ============================================
// CATEGORY FUNCTIONS
// ============================================

/**
 * Get all active categories for dropdown lists
 * @return array Returns array of categories
 */
function getCategories() {
    $conn = getDBConnection();
    $result = $conn->query("SELECT category_id, category_name, description FROM categories WHERE is_active = 1 ORDER BY display_order ASC, category_name ASC");
    $categories = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    
    closeDBConnection($conn);
    return $categories;
}

/**
 * Get category by ID
 * @param int $category_id Category ID
 * @return array|false Returns category array or false if not found
 */
function getCategoryById($category_id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT category_id, category_name, description, display_order, is_active FROM categories WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $category = $result->fetch_assoc();
    $stmt->close();
    closeDBConnection($conn);
    
    return $category ? $category : false;
}

// ============================================
// SIZE FUNCTIONS
// ============================================

/**
 * Get all active sizes for a specific type (for dropdown lists)
 * @param string $size_type Type of size (clothing, shoes, accessories)
 * @return array Returns array of sizes
 */
function getSizes($size_type = 'clothing') {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT size_id, size_value, description FROM sizes WHERE size_type = ? AND is_active = 1 ORDER BY display_order ASC, size_value ASC");
    $stmt->bind_param("s", $size_type);
    $stmt->execute();
    $result = $stmt->get_result();
    $sizes = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sizes[] = $row;
        }
    }
    
    $stmt->close();
    closeDBConnection($conn);
    return $sizes;
}

/**
 * Get all active sizes regardless of type
 * @return array Returns array of all sizes grouped by type
 */
function getAllSizes() {
    $conn = getDBConnection();
    $result = $conn->query("SELECT size_id, size_value, size_type, description FROM sizes WHERE is_active = 1 ORDER BY size_type ASC, display_order ASC, size_value ASC");
    $sizes = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sizes[] = $row;
        }
    }
    
    closeDBConnection($conn);
    return $sizes;
}

/**
 * Get size by ID
 * @param int $size_id Size ID
 * @return array|false Returns size array or false if not found
 */
function getSizeById($size_id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT size_id, size_value, size_type, description FROM sizes WHERE size_id = ?");
    $stmt->bind_param("i", $size_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $size = $result->fetch_assoc();
    $stmt->close();
    closeDBConnection($conn);
    
    return $size ? $size : false;
}

// ============================================
// ORDER FUNCTIONS
// ============================================

/**
 * Create a new order (simplified)
 * @param int $user_id Customer user ID
 * @param string $product_name Product name
 * @param float $total_amount Total amount
 * @return int|false Returns order ID on success, false on failure
 */
function createOrder($user_id, $product_name, $total_amount) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO orders (user_id, product_name, total_amount) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $user_id, $product_name, $total_amount);
    
    if ($stmt->execute()) {
        $order_id = $conn->insert_id;
        $stmt->close();
        closeDBConnection($conn);
        return $order_id;
    } else {
        $stmt->close();
        closeDBConnection($conn);
        return false;
    }
}

/**
 * Get all orders for a specific user
 * @param int $user_id User ID
 * @return array Returns array of orders
 */
function getUserOrders($user_id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT order_id, user_id, product_name, total_amount FROM orders WHERE user_id = ? ORDER BY order_id DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }
    
    $stmt->close();
    closeDBConnection($conn);
    return $orders;
}

/**
 * Get order by ID
 * @param int $order_id Order ID
 * @return array|false Returns order array or false if not found
 */
function getOrderById($order_id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT o.order_id, o.user_id, o.product_name, o.total_amount, u.username, u.email, u.first_name, u.last_name FROM orders o LEFT JOIN users u ON o.user_id = u.user_id WHERE o.order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    $stmt->close();
    closeDBConnection($conn);
    
    return $order ? $order : false;
}

/**
 * Get all orders (for admin purposes)
 * @return array Returns array of all orders
 */
function getAllOrders() {
    $conn = getDBConnection();
    $result = $conn->query("SELECT o.order_id, o.user_id, o.product_name, o.total_amount, u.username, u.email, u.first_name, u.last_name FROM orders o LEFT JOIN users u ON o.user_id = u.user_id ORDER BY o.order_id DESC");
    $orders = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }
    
    closeDBConnection($conn);
    return $orders;
}


?>

