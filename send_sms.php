<?php
// send_sms.php

require_once 'vendor/autoload.php';
require_once 'conf.php';

use AfricasTalking\SDK\AfricasTalking;

// Set the phone number you want to send the SMS to
$recipient = '+254768876579'; // Replace with the recipient's phone number in international format

// Create a new instance of the SMS service
$AT = new AfricasTalking($AT_USERNAME, $AT_API_KEY);
$sms = $AT->sms();

// Set the message and sender ID
$message = 'Hello, this is a test message from Africa\'s Talking!';

try {
    // Send the SMS
    $result = $sms->send([
        'to' => $recipient,
        'message' => $message,
        'from' => $SMS_SENDER_ID,
    ]);

    // Output the response
    print_r($result);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
