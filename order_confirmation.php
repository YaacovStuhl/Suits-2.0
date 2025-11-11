<?php
session_start();
$page_title = "Order Confirmation";
include 'header.php';

// Check if order data exists in session
if (!isset($_SESSION['order_data'])) {
    header('Location: order_form.php');
    exit();
}

$order_data = $_SESSION['order_data'];
unset($_SESSION['order_data']); // Clear session data after use

// Map option values to readable labels
$option_labels = [
    'rush_order' => 'Rush Order (Expedited Processing)',
    'custom_fitting' => 'Custom Fitting Required',
    'gift_wrapping' => 'Gift Wrapping',
    'tailoring' => 'Professional Tailoring Included',
    'newsletter' => 'Subscribe to Newsletter for Updates'
];
?>

<div class="confirmation-container">
    <div class="confirmation-wrapper">
        <div class="success-icon">✓</div>
        <h1>Thank You for Your Order!</h1>
        <p class="confirmation-intro">Your order has been successfully submitted and saved to our database.</p>
        
        <div class="order-details">
            <h2>Order Details</h2>
            
            <div class="detail-section">
                <h3>Order Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Order ID:</span>
                    <span class="detail-value">#<?php echo htmlspecialchars($order_data['order_id']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Product Name:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($order_data['product_name']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Amount:</span>
                    <span class="detail-value price">$<?php echo number_format($order_data['total_amount'], 2); ?></span>
                </div>
            </div>

            <div class="detail-section">
                <h3>Customer Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Username:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($order_data['user']['username']); ?></span>
                </div>
            </div>

            <div class="detail-section">
                <h3>Product Specifications</h3>
                <div class="detail-row">
                    <span class="detail-label">Category:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($order_data['category']['category_name']); ?></span>
                </div>
                <?php if (isset($order_data['category']['description']) && !empty($order_data['category']['description'])): ?>
                <div class="detail-row">
                    <span class="detail-label">Category Description:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($order_data['category']['description']); ?></span>
                </div>
                <?php endif; ?>
                <div class="detail-row">
                    <span class="detail-label">Size:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($order_data['size']['size_value']); ?> (<?php echo htmlspecialchars(ucfirst($order_data['size']['size_type'])); ?>)</span>
                </div>
                <?php if (isset($order_data['size']['description']) && !empty($order_data['size']['description'])): ?>
                <div class="detail-row">
                    <span class="detail-label">Size Description:</span>
                    <span class="detail-value"><?php echo htmlspecialchars($order_data['size']['description']); ?></span>
                </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($order_data['options'])): ?>
            <div class="detail-section">
                <h3>Selected Options</h3>
                <ul class="options-list">
                    <?php foreach ($order_data['options'] as $option): ?>
                        <?php if (isset($option_labels[$option])): ?>
                        <li><?php echo htmlspecialchars($option_labels[$option]); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($order_data['notes'])): ?>
            <div class="detail-section">
                <h3>Special Instructions</h3>
                <div class="notes-box">
                    <?php echo nl2br(htmlspecialchars($order_data['notes'])); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="confirmation-actions">
            <a href="view_orders.php" class="btn btn-primary">View All Orders</a>
            <a href="order_form.php" class="btn btn-secondary">Place Another Order</a>
            <a href="index.php" class="btn btn-secondary">Return to Home</a>
        </div>
    </div>
</div>

<style>
.confirmation-container {
    min-height: 70vh;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.confirmation-wrapper {
    background: white;
    padding: 3rem;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.success-icon {
    width: 80px;
    height: 80px;
    background-color: #28a745;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    margin: 0 auto 1.5rem;
    font-weight: bold;
}

.confirmation-wrapper h1 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 0.5rem;
}

.confirmation-intro {
    color: #666;
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

.order-details {
    text-align: left;
    margin-bottom: 2rem;
}

.order-details h2 {
    color: var(--primary-color, #2c3e50);
    border-bottom: 2px solid var(--accent-color, #3498db);
    padding-bottom: 0.5rem;
    margin-bottom: 1.5rem;
}

.detail-section {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background-color: #f8f9fa;
    border-radius: 5px;
}

.detail-section h3 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.detail-row {
    display: flex;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e1e5e9;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    color: #666;
    width: 40%;
    min-width: 150px;
}

.detail-value {
    color: var(--primary-color, #2c3e50);
    flex: 1;
}

.detail-value.price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #28a745;
}

.options-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.options-list li {
    padding: 0.5rem 0;
    padding-left: 1.5rem;
    position: relative;
}

.options-list li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #28a745;
    font-weight: bold;
}

.notes-box {
    background-color: white;
    padding: 1rem;
    border-radius: 5px;
    border: 1px solid #e1e5e9;
    color: var(--primary-color, #2c3e50);
    white-space: pre-wrap;
}

.confirmation-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.btn {
    padding: 0.75rem 2rem;
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
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .confirmation-wrapper {
        padding: 2rem;
    }
    
    .detail-row {
        flex-direction: column;
    }
    
    .detail-label {
        width: 100%;
        margin-bottom: 0.25rem;
    }
    
    .confirmation-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
    }
}
</style>

<?php include 'footer.php'; ?>


