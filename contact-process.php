<?php

use google\appengine\api\mail\Message;

// Set email configuration
$emailTo = 'manishguptaa33@gmail.com'; // Change with your Email address

// Get form data (make sure to sanitize and validate user inputs)
$contactName = isset($_POST["contactName"]) ? $_POST["contactName"] : "";
$contactPhone = isset($_POST["contactPhone"]) ? $_POST["contactPhone"] : "";
$contactEmail = isset($_POST["contactEmail"]) ? $_POST["contactEmail"] : "";
$contactMessage = isset($_POST["contactMessage"]) ? $_POST["contactMessage"] : "";

// Validate email
if (empty($contactEmail) || !filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email address.');
}

// If no validation errors, proceed to send the email
try {
    // Create a new Message
    $message = new Message();

    // Set sender and recipient
    $message->setSender($emailTo);
    $message->addTo($emailTo);

    // Set email subject
    $message->setSubject('TrainoMart - Contact form');

    // Set email body (HTML content)
    $body = "Name: $contactName<br>Phone: $contactPhone<br>Email: $contactEmail<br>Message: $contactMessage";
    $message->setHtmlBody($body);

    // Send the email
    $message->send();

    echo 'Email has been sent successfully';
} catch (Exception $e) {
    echo "Unable to send mail. Error: " . $e->getMessage();
}
