<?php

use google\appengine\api\mail\Message;
use PHPMailer\PHPMailer\PHPMailer;

// Set email configuration
$emailTo = 'marttraino@gmail.com'; // Change with your Email address

// Get form data (make sure to sanitize and validate user inputs)
$contactName = $_POST["contactName"];
$contactPhone = $_POST['contactPhone'];
$contactEmail = $_POST['contactEmail'];
$contactMessage = isset($_POST["contactMessage"]) ? test_input($_POST['contactMessage']) : "";

// Validate email
if (empty($contactEmail) || !filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
    $emailError = 'Please enter a valid email address.';
    $hasError = true;
}

// If no validation errors, proceed to send the email
if (!$hasError) {
    try {
        // Create a new Message
        $message = new Message();

        // Set sender and recipient
        $message->setSender($contactEmail);
        $message->addTo($emailTo);
        $message->addTo($contactPhone);


        // Set email subject
        $message->setSubject('360DT - Contact form');

        // Set email body (HTML content)
        $body = "Name: $contactName<br>Phone: $contactPhone<br>Email: $contactEmail<br>Message: $contactMessage";
        $message->setHtmlBody($body);

        // Send the email
        $message->send();

        // Redirect to a success page
        // header("Location: /mail_sent");

    } catch (Exception $e) {
        // Handle the exception (display a generic error message for now)
        $error = "Unable to send mail. Error: " . $e->getMessage();
    }
}

// Function to sanitize and validate input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
