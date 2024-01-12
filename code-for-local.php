<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use google\appengine\api\mail\Message;


require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $contactName = $_POST['contactName'];
    $contactPhone = $_POST['contactPhone'];
    $contactEmail = $_POST['contactEmail'];
    $contactMessage = $_POST['contactMessage'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'marttraino@gmail.com';
        $mail->Password = 'zbliuivlqxcugjqp';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($contactEmail, $contactName);
        $mail->addAddress($contactEmail); 
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "Name: $contactName\nPhone: $contactPhone\nEmail: $contactEmail\nMessage: $contactMessage\n";

        $mail->send();
        echo "Thank you! Your message has been sent.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Access denied.";
}
?>