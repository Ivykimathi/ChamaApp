<?php

// Validate and sanitize input data (phone_number and amount)
$phoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
$amount = isset($_POST['amount']) ? $_POST['amount'] : '';

// Validate the phone number and amount (add more validation as needed)
if (empty($phoneNumber) || empty($amount) || !is_numeric($amount)) {
    // Handle invalid input, e.g., display an error message or redirect back to the form.
    die('Invalid input. Please provide a valid phone number and amount.');
}

// Replace 'YOUR_DARAJA_API_ENDPOINT' with the actual API endpoint provided by Safaricom Daraja
$darajaApiEndpoint = 'YOUR_DARAJA_API_ENDPOINT';

// Replace 'YOUR_DARAJA_API_KEY' with your Daraja API key
$apiKey = 'YOUR_DARAJA_API_KEY';

// Other required parameters for the STK push (you may need to refer to the Daraja API documentation for the exact parameters)
$accountReference = 'YOUR_ACCOUNT_REFERENCE'; // Replace with your reference number
$callbackURL = 'YOUR_CALLBACK_URL'; // Replace with the URL to receive the callback from the API

// Prepare the data for the API request
$data = [
    'BusinessShortCode' => 'YOUR_BUSINESS_SHORTCODE', // Replace with your business shortcode
    'Password' => base64_encode('YOUR_BUSINESS_SHORTCODE' . 'YOUR_DARAJA_PASSKEY' . date('YmdHis')), // Replace with your Daraja Passkey
    'Timestamp' => date('YmdHis'),
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $phoneNumber,
    'PartyB' => 'YOUR_PAYBILL_NUMBER', // Replace with your Paybill number
    'PhoneNumber' => $phoneNumber,
    'CallBackURL' => $callbackURL,
    'AccountReference' => $accountReference,
    'TransactionDesc' => 'Payment for goods/services', // Customize this description as needed
];

// Use cURL to send the POST request to the Daraja API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $darajaApiEndpoint);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
curl_close($ch);

// Process the response from the API
$responseData = json_decode($response, true);

// Handle the response (check for success or failure) and provide feedback to the user
if (isset($responseData['ResponseCode']) && $responseData['ResponseCode'] == '0') {
    // STK push initiated successfully
    echo 'STK push initiated successfully!';
} else {
    // STK push failed
    echo 'Failed to initiate STK push. Error: ' . $responseData['errorMessage'];
}

?>
