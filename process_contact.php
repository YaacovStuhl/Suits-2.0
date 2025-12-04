<?php
// Process contact form and send email
session_start();

// SMTP needs accurate times, and the PHP time zone MUST be set
date_default_timezone_set('Etc/UTC');

// Include PHPMailer from parent directory
require '../PHPMailer-master/PHPMailerAutoload.php';

// Get form data
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// Validate required fields
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    // Store form data in session for repopulation
    $_SESSION['form_data'] = $_POST;
    header('Location: contact.php?error=1');
    exit();
}

// Create PHPMailer instance
$mail = new PHPMailer;
$mail->isSMTP();

// Enable SMTP debugging (0 = off for production, 2 = client and server messages for debugging)
$mail->SMTPDebug = 0;

// Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

// Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

// Set the SMTP port number - 587 for authenticated TLS
$mail->Port = 587;

// Set the encryption system to use - tls
$mail->SMTPSecure = 'tls';

// Whether to use SMTP authentication
$mail->SMTPAuth = true;

// Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'covyrox@gmail.com';

// Password to use for SMTP authentication (App Password for Gmail)
$mail->Password = 'iaopdkbadethrsrx';

// Set who the message is to be sent from
$mail->setFrom('covyrox@gmail.com', 'Simply Suits Contact Form');

// Set who the message is to be sent to (your email)
$mail->addAddress('yaacovstuhl@gmail.com', 'Yaacov Stuhl');

// Set the subject line
$mail->Subject = 'Contact Form: ' . $subject;

// Build the email body with form data
$emailBody = "New contact form submission from Simply Suits website\n\n";
$emailBody .= "Name: " . $name . "\n";
$emailBody .= "Email: " . $email . "\n";
$emailBody .= "Subject: " . $subject . "\n\n";
$emailBody .= "Message:\n" . $message . "\n";

// Set the message body
$mail->Body = $emailBody;

// Set alternative plain text body (same as body for plain text email)
$mail->AltBody = $emailBody;

// Send the message, check for errors
if (!$mail->send()) {
    // Error sending email
    error_log("Contact form email error: " . $mail->ErrorInfo);
    header('Location: contact.php?error=1');
    exit();
} else {
    // Success - redirect to contact page with success message
    header('Location: contact.php?success=1');
    exit();
}
?>

