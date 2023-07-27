<?php
// INCLUDE THE ACCESS TOKEN FILE
include 'accessToken.php';
date_default_timezone_set('Africa/Nairobi');
$processrequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackurl = 'https://71a6-197-156-129-118.ngrok-free.app/MPEsa-Daraja-Api/callback.php';
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode = '174379';
$stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

// CHECK IF FORM WAS SUBMITTED
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // RETRIEVE PHONE NUMBER AND AMOUNT FROM FORM
    $phone = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $money = isset($_POST['amount']) ? $_POST['amount'] : '';

    // VALIDATE PHONE NUMBER AND AMOUNT (ADD YOUR OWN VALIDATION LOGIC HERE)
    // For example, you might want to check if the phone number is valid and if the amount is greater than 0.

    // ENCRYPT DATA TO GET PASSWORD
    $Timestamp = date('YmdHis');
    $Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);

    $PartyA = $phone;
    $PartyB = '254768876579';
    $AccountReference = 'chamaapp';
    $TransactionDesc = 'stkpush test';
    $Amount = $money;

    // INITIATE CURL
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader); // setting custom header
    $curl_post_data = array(
        // Fill in the request parameters with valid values
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $Password,
        'Timestamp' => $Timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $Amount,
        'PartyA' => $PartyA,
        'PartyB' => $BusinessShortCode,
        'PhoneNumber' => $PartyA,
        'CallBackURL' => $callbackurl,
        'AccountReference' => $AccountReference,
        'TransactionDesc' => $TransactionDesc
    );

    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);
    curl_close($curl);

    // ECHO RESPONSE
    $data = json_decode($curl_response);

    if (isset($data->CheckoutRequestID) && isset($data->ResponseCode) && $data->ResponseCode === "0") {
        // DATABASE CONNECTION DETAILS
        $db_host = 'localhost'; // Replace with your database host
        $db_name = 'pay'; // Replace with your database name
        $db_user = 'root'; // Replace with your database user
        $db_pass = ''; // Replace with your database password

        // CONNECT TO DATABASE
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        // CHECK CONNECTION
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // ESCAPE STRINGS TO PREVENT SQL INJECTION
        $CheckoutRequestID = $conn->real_escape_string($data->CheckoutRequestID);
        $ResponseCode = $conn->real_escape_string($data->ResponseCode);
        $phone = $conn->real_escape_string($phone);
        $money = $conn->real_escape_string($money);

        // INSERT TRANSACTION INTO DATABASE
        $sql = "INSERT INTO transactions (CheckoutRequestID, ResponseCode, Phone, Amount, Timestamp) 
                VALUES ('$CheckoutRequestID', '$ResponseCode', '$phone', '$money', NOW())";

        if ($conn->query($sql) === TRUE) {
            // SEND SMS TO USER USING AFRICA'S TALKING API
            require_once 'vendor/africastalking/AfricasTalkingGateway.php';
            require_once 'vendor/autoload.php'; // Replace with the actual path to the Africa's Talking PHP SDK
            // Replace 'your_username' and 'your_api_key' with your actual credentials
            $username = 'goodxy';
            $apiKey = '7efd6dd9d867e959938a572cb508f0c4d42bde4bb9997f5a96805fcac85b6189';

            // Initialize the SMS service
            $AT = new Africastalking\SDK\Africastalking($username, $apiKey);

            // Get the SMS service
            // $sms = $AT->sms();

            // Set the SMS parameters
            $recipients = $phone;
            $message = "Payment of KES $money was successful. Transaction ID: $CheckoutRequestID";
            $from = "CHAMAAPP";

            // Send the SMS
            $result = $sms->send([
                'to' => $recipients,
                'message' => $message,
                // 'from' => $from,
            ]);

            // Display success message
            echo "Payment successful. An SMS has been sent to your phone.";
        } else {
            echo "Error processing STK push payment. Response Code: " . $ResponseCode;
        }

        // CLOSE DATABASE CONNECTION
        $conn->close();
    } else {
        // HANDLE API RESPONSE ERROR
        if (isset($data->errorMessage)) {
            echo "API Error: " . $data->errorMessage;
        } else {
            echo "Error processing STK push payment. Please check your input and try again.";
        }
    }
}
?>