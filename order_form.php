<?php
session_start();
$page_title = "Place Order";
include 'header.php';
require_once 'database_functions.php';
require_once 'users_data.php';

// Get data for dropdowns
$categories = getCategories();
$sizes = getAllSizes();
$all_users = getAllUsers();

// Get logged in user if available
$logged_in_user_id = null;
$logged_in_user = null;
if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] === true && isset($_SESSION['username'])) {
    $logged_in_user = getUserByUsername($_SESSION['username']);
    if ($logged_in_user) {
        $logged_in_user_id = $logged_in_user['user_id'];
    }
}
?>

<div class="order-form-container">
    <div class="order-form-wrapper">
        <h1>Place Your Order</h1>
        <p>Fill out the form below to place an order for your custom suit.</p>
        
        <?php
        // Display errors if any
        if (isset($_SESSION['form_errors']) && !empty($_SESSION['form_errors'])) {
            echo '<div class="error-message">';
            echo '<strong>Please correct the following errors:</strong><ul>';
            foreach ($_SESSION['form_errors'] as $error) {
                echo '<li>' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul></div>';
            unset($_SESSION['form_errors']);
        }
        
        // Pre-fill form data if available
        $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
        unset($_SESSION['form_data']);
        ?>
        
        <form action="process_order.php" method="POST" class="order-form" id="orderForm">
            <!-- Customer Selection -->
            <div class="form-section">
                <h2>Customer Information</h2>
                <div class="form-group">
                    <label for="user_id">Customer:</label>
                    <?php if ($logged_in_user_id): ?>
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($logged_in_user_id); ?>">
                        <div class="user-display">
                            <strong><?php echo htmlspecialchars($logged_in_user['username']); ?></strong>
                        </div>
                    <?php else: ?>
                        <select id="user_id" name="user_id" required>
                            <option value="">-- Select Customer --</option>
                            <?php 
                            $selected_user = isset($form_data['user_id']) ? $form_data['user_id'] : '';
                            foreach ($all_users as $user): 
                                $selected = ($selected_user == $user['user_id']) ? 'selected' : '';
                            ?>
                                <option value="<?php echo htmlspecialchars($user['user_id']); ?>" <?php echo $selected; ?>>
                                    <?php echo htmlspecialchars($user['username']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Product Information -->
            <div class="form-section">
                <h2>Product Details</h2>
                
                <!-- Category Dropdown (from database) -->
                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">-- Select Category --</option>
                        <?php 
                        $selected_category = isset($form_data['category_id']) ? $form_data['category_id'] : '';
                        foreach ($categories as $category): 
                            $selected = ($selected_category == $category['category_id']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo htmlspecialchars($category['category_id']); ?>" <?php echo $selected; ?>>
                                <?php echo htmlspecialchars($category['category_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (empty($categories)): ?>
                        <small class="error-text">No categories available. Please add categories to the database.</small>
                    <?php endif; ?>
                </div>

                <!-- Size Dropdown (from database) -->
                <div class="form-group">
                    <label for="size_id">Size:</label>
                    <select id="size_id" name="size_id" required>
                        <option value="">-- Select Size --</option>
                        <?php 
                        $selected_size = isset($form_data['size_id']) ? $form_data['size_id'] : '';
                        $current_type = '';
                        foreach ($sizes as $size): 
                            if ($size['size_type'] !== $current_type):
                                if ($current_type !== '') echo '</optgroup>';
                                echo '<optgroup label="' . htmlspecialchars(ucfirst($size['size_type'])) . '">';
                                $current_type = $size['size_type'];
                            endif;
                            $selected = ($selected_size == $size['size_id']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo htmlspecialchars($size['size_id']); ?>" <?php echo $selected; ?>>
                                <?php echo htmlspecialchars($size['size_value']); ?>
                                <?php if ($size['description']): ?>
                                    - <?php echo htmlspecialchars($size['description']); ?>
                                <?php endif; ?>
                            </option>
                        <?php endforeach; ?>
                        <?php if ($current_type !== '') echo '</optgroup>'; ?>
                    </select>
                    <?php if (empty($sizes)): ?>
                        <small class="error-text">No sizes available. Please add sizes to the database.</small>
                    <?php endif; ?>
                </div>

                <!-- Product Name Text Input -->
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" id="product_name" name="product_name" 
                           placeholder="e.g., Classic Navy Suit" 
                           maxlength="255" 
                           value="<?php echo isset($form_data['product_name']) ? htmlspecialchars($form_data['product_name']) : ''; ?>"
                           required>
                    <small>Enter the name of the product you're ordering</small>
                </div>

                <!-- Total Amount Number Input -->
                <div class="form-group">
                    <label for="total_amount">Total Amount ($):</label>
                    <input type="number" id="total_amount" name="total_amount" 
                           step="0.01" min="0.01" max="99999.99" 
                           placeholder="0.00"
                           value="<?php echo isset($form_data['total_amount']) ? htmlspecialchars($form_data['total_amount']) : ''; ?>"
                           required>
                    <small>Enter the total price for this order</small>
                </div>
            </div>

            <!-- Preferences/Options (Checkboxes) -->
            <div class="form-section">
                <h2>Additional Options</h2>
                <div class="checkbox-group">
                    <?php 
                    $selected_options = isset($form_data['options']) && is_array($form_data['options']) ? $form_data['options'] : [];
                    $options_list = [
                        'rush_order' => 'Rush Order (Expedited Processing)',
                        'custom_fitting' => 'Custom Fitting Required',
                        'gift_wrapping' => 'Gift Wrapping',
                        'tailoring' => 'Professional Tailoring Included',
                        'newsletter' => 'Subscribe to Newsletter for Updates'
                    ];
                    foreach ($options_list as $value => $label):
                        $checked = in_array($value, $selected_options) ? 'checked' : '';
                    ?>
                    <div class="checkbox-item">
                        <input type="checkbox" id="<?php echo $value; ?>" name="options[]" value="<?php echo $value; ?>" <?php echo $checked; ?>>
                        <label for="<?php echo $value; ?>"><?php echo htmlspecialchars($label); ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Additional Notes -->
            <div class="form-section">
                <div class="form-group">
                    <label for="notes">Special Instructions or Notes:</label>
                    <textarea id="notes" name="notes" rows="4" 
                              placeholder="Any special requests or instructions for this order..."><?php echo isset($form_data['notes']) ? htmlspecialchars($form_data['notes']) : ''; ?></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">Submit Order</button>
                <button type="reset" class="reset-btn">Reset Form</button>
            </div>
        </form>
    </div>
</div>

<style>
.order-form-container {
    min-height: 70vh;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.order-form-wrapper {
    background: white;
    padding: 3rem;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    margin: 0 auto;
}

.order-form-wrapper h1 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 0.5rem;
    text-align: center;
}

.order-form-wrapper > p {
    color: #666;
    text-align: center;
    margin-bottom: 2rem;
}

.form-section {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #e1e5e9;
}

.form-section:last-of-type {
    border-bottom: none;
}

.form-section h2 {
    color: var(--primary-color, #2c3e50);
    font-size: 1.3rem;
    margin-bottom: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--primary-color, #2c3e50);
    font-weight: 600;
}

.form-group input[type="text"],
.form-group input[type="number"],
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e1e5e9;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
    font-family: inherit;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--accent-color, #3498db);
}

.form-group small {
    display: block;
    margin-top: 0.25rem;
    color: #666;
    font-size: 0.85rem;
}

.error-text {
    color: #dc3545;
}

.error-message {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    padding: 1rem;
    border-radius: 5px;
    margin-bottom: 1.5rem;
}

.error-message ul {
    margin: 0.5rem 0 0 1.5rem;
    padding: 0;
}

.error-message li {
    margin: 0.25rem 0;
}

.user-display {
    padding: 0.75rem;
    background-color: #e8f4f8;
    border: 2px solid #c3e6cb;
    border-radius: 5px;
    color: var(--primary-color, #2c3e50);
}

.checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.checkbox-item {
    display: flex;
    align-items: center;
}

.checkbox-item input[type="checkbox"] {
    width: auto;
    margin-right: 0.75rem;
    cursor: pointer;
}

.checkbox-item label {
    margin: 0;
    font-weight: normal;
    cursor: pointer;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.submit-btn,
.reset-btn {
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.submit-btn {
    background-color: var(--primary-color, #2c3e50);
    color: white;
}

.submit-btn:hover {
    background-color: var(--accent-color, #3498db);
    transform: translateY(-2px);
}

.reset-btn {
    background-color: #6c757d;
    color: white;
}

.reset-btn:hover {
    background-color: #5a6268;
}

@media (max-width: 768px) {
    .order-form-wrapper {
        padding: 2rem;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .submit-btn,
    .reset-btn {
        width: 100%;
    }
}
</style>

<?php include 'footer.php'; ?>

