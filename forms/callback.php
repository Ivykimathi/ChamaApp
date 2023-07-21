<?php
// Read the raw POST data from M-Pesa
$mpesa_callback_response = file_get_contents('php://input');

// Process the callback response (you can save the details in your database for future reference)
// Decode the JSON response received from M-Pesa
$callback_data = json_decode($mpesa_callback_response, true);

// Get relevant details from the callback response
$transaction_status = $callback_data['Body']['stkCallback']['ResultCode'];
$transaction_desc = $callback_data['Body']['stkCallback']['ResultDesc'];
$merchant_request_id = $callback_data['Body']['stkCallback']['MerchantRequestID'];
$checkout_request_id = $callback_data['Body']['stkCallback']['CheckoutRequestID'];

// You can update your database with the transaction status and other details here

// Respond to M-Pesa with an acknowledgment
$response = [
    'ResultCode' => '0',
    'ResultDesc' => 'The service was accepted successfully',
];
header('Content-Type: application/json');
echo json_encode($response);
?>
