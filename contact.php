<?php
session_start();
$page_title = "Contact Us";
include 'header.php';

$success_message = '';
$error_message = '';

// Check if form was submitted successfully
if (isset($_GET['success']) && $_GET['success'] == '1') {
    $success_message = 'Thank you! Your message has been sent successfully. We will get back to you soon.';
}

// Check if there was an error
if (isset($_GET['error']) && $_GET['error'] == '1') {
    $error_message = 'Sorry, there was an error sending your message. Please try again.';
}
?>

<div class="contact-container">
    <div class="contact-form-wrapper">
        <h1>Contact Us</h1>
        <p>Have a question or need assistance? We'd love to hear from you! Send us a message and we'll respond as soon as possible.</p>
        
        <?php if ($success_message): ?>
            <div class="success-message">
                <p><?php echo $success_message; ?></p>
                <a href="index.php" class="btn btn-primary">Back to Home</a>
            </div>
        <?php else: ?>
            <?php if ($error_message): ?>
                <div class="error-message">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>
            
            <form action="process_contact.php" method="POST" class="contact-form">
                
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="6" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                </div>
                
                <button type="submit" class="contact-btn">Send Message</button>
            </form>
        <?php endif; ?>
        
        <div class="contact-links">
            <a href="index.php">← Back to Home</a>
        </div>
    </div>
</div>

<style>
.contact-container {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.contact-form-wrapper {
    background: white;
    padding: 3rem;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 700px;
    text-align: center;
}

.contact-form-wrapper h1 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 0.5rem;
    font-size: 2rem;
}

.contact-form-wrapper p {
    color: #666;
    margin-bottom: 2rem;
    font-size: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
    text-align: left;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--primary-color, #2c3e50);
    font-weight: 600;
}

.form-group input,
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
.form-group textarea:focus {
    outline: none;
    border-color: var(--accent-color, #3498db);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.contact-btn {
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

.contact-btn:hover {
    background-color: var(--accent-color, #3498db);
}

.contact-links {
    text-align: center;
}

.contact-links a {
    color: var(--accent-color, #3498db);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.contact-links a:hover {
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

@media (max-width: 480px) {
    .contact-form-wrapper {
        padding: 2rem;
        margin: 1rem;
    }
    
    .contact-form-wrapper h1 {
        font-size: 1.5rem;
    }
}
</style>

<?php include 'footer.php'; ?>

