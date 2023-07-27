<?php
// send_sms.php

require_once 'vendor/autoload.php';
require_once 'conf.php';

use AfricasTalking\SDK\AfricasTalking;

// Check if the mobile_number query parameter is provided
if (isset($_GET['mobile_number'])) {
    // Get the phone number from the query parameter
    $recipient = $_GET['mobile_number'];

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
            // 'from' => $SMS_SENDER_ID,
        ]);

        // Output the response
        echo json_encode(array("message" => "SMS sent successfully."));
    } catch (Exception $e) {
        echo json_encode(array("message" => "Error sending SMS: " . $e->getMessage()));
    }
} else {
    echo json_encode(array("message" => "Mobile number not provided."));
}
?>
