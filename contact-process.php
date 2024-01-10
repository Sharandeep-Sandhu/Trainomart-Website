<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $contactName = $_POST['contactName'];
    $contactPhone = $_POST['contactPhone'];
    $contactEmail = $_POST['contactEmail'];
    $contactMessage = $_POST['contactMessage'];

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Gmail SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sharan090910@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'Digital@360'; // Replace with your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email content
        $mail->setFrom($contactEmail, $contactName);
        $mail->addAddress('recipient@example.com'); // Replace with the recipient's email address
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "Name: $contactName\nPhone: $contactPhone\nEmail: $contactEmail\nMessage: $contactMessage\n";

        // Send email
        $mail->send();
        echo "Thank you! Your message has been sent.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Access denied.";
}
?>
