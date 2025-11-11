<?php
session_start();
$page_title = "View All Orders";
include 'header.php';
require_once 'database_functions.php';

// Get all orders from database
$orders = getAllOrders();
?>

<div class="orders-container">
    <div class="orders-wrapper">
        <h1>All Orders</h1>
        <p class="orders-intro">View all orders submitted through the order form.</p>
        
        <?php if (empty($orders)): ?>
            <div class="no-orders">
                <p>No orders have been submitted yet.</p>
                <a href="order_form.php" class="btn btn-primary">Place First Order</a>
            </div>
        <?php else: ?>
            <div class="orders-summary">
                <p><strong>Total Orders:</strong> <?php echo count($orders); ?></p>
            </div>
            
            <div class="orders-table-container">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Product Name</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td class="order-id">#<?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['username'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                            <td class="price">$<?php echo number_format($order['total_amount'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="total-label"><strong>Total:</strong></td>
                            <td class="total-price">
                                <strong>$<?php 
                                    $grand_total = array_sum(array_column($orders, 'total_amount'));
                                    echo number_format($grand_total, 2);
                                ?></strong>
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php endif; ?>
        
        <div class="page-actions">
            <a href="order_form.php" class="btn btn-primary">Place New Order</a>
            <a href="index.php" class="btn btn-secondary">Return to Home</a>
        </div>
    </div>
</div>

<style>
.orders-container {
    min-height: 70vh;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.orders-wrapper {
    background: white;
    padding: 3rem;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    max-width: 1200px;
    margin: 0 auto;
}

.orders-wrapper h1 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 0.5rem;
    text-align: center;
}

.orders-intro {
    color: #666;
    text-align: center;
    margin-bottom: 2rem;
}

.orders-summary {
    margin-bottom: 1.5rem;
    padding: 1rem;
    background-color: #e8f4f8;
    border-radius: 5px;
    text-align: center;
}

.no-orders {
    text-align: center;
    padding: 3rem;
    color: #666;
}

.no-orders p {
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
}

.orders-table-container {
    overflow-x: auto;
    margin-bottom: 2rem;
}

.orders-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.orders-table thead {
    background-color: var(--primary-color, #2c3e50);
    color: white;
}

.orders-table th {
    padding: 1rem;
    text-align: left;
    font-weight: 600;
}

.orders-table td {
    padding: 1rem;
    border-bottom: 1px solid #e1e5e9;
}

.orders-table tbody tr:hover {
    background-color: #f8f9fa;
}

.orders-table tbody tr:last-child td {
    border-bottom: none;
}

.order-id {
    font-weight: 600;
    color: var(--accent-color, #3498db);
}

.price {
    font-weight: 600;
    color: #28a745;
}

.username {
    color: #666;
    font-size: 0.85rem;
}

.orders-table tfoot {
    background-color: #f8f9fa;
    font-weight: 600;
}

.orders-table tfoot td {
    padding: 1rem;
    border-top: 2px solid var(--primary-color, #2c3e50);
}

.total-label {
    text-align: right;
}

.total-price {
    color: #28a745;
    font-size: 1.2rem;
}

.page-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
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
    .orders-wrapper {
        padding: 2rem;
    }
    
    .orders-table {
        font-size: 0.9rem;
    }
    
    .orders-table th,
    .orders-table td {
        padding: 0.75rem 0.5rem;
    }
    
    .page-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
    }
}

@media (max-width: 600px) {
    .orders-table-container {
        font-size: 0.85rem;
    }
    
    .orders-table th,
    .orders-table td {
        padding: 0.5rem 0.25rem;
    }
}
</style>

<?php include 'footer.php'; ?>


