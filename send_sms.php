<?php
// send_sms.php

require_once 'vendor/autoload.php';
require_once 'conf.php'; // Assuming you have your Africa's Talking credentials here

use AfricasTalking\SDK\AfricasTalking;

function sendSMS($recipient, $message) {
    // Create a new instance of the SMS service
    $AT = new AfricasTalking($AT_USERNAME, $AT_API_KEY);
    $sms = $AT->sms();

    try {
        // Send the SMS
        $result = $sms->send([
            'to' => $recipient,
            'message' => $message,
        ]);

        // SMS sent successfully
        return true;
    } catch (Exception $e) {
        // Error sending SMS
        return false;
    }
}
?>
