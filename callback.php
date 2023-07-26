<?php
header("Content-Type: application/json");
$stkCallbackResponse = file_get_contents('php://input');
$logFile = "Mpesastkresponse.json";
$log = fopen($logFile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);

$data = json_decode($stkCallbackResponse);

$MerchantRequestID = $data->Body->stkCallback->MerchantRequestID;
$CheckoutRequestID = $data->Body->stkCallback->CheckoutRequestID;
$ResultCode = $data->Body->stkCallback->ResultCode;
$ResultDesc = $data->Body->stkCallback->ResultDesc;
$Amount = $data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$TransactionId = $data->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$UserPhoneNumber = $data->Body->stkCallback->CallbackMetadata->Item[4]->Value;

//CHECK IF THE TRANSACTION WAS SUCCESSFUL 
if ($ResultCode == 0) {
    // STORE THE TRANSACTION DETAILS IN THE DATABASE
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
    
    // ESCAPE USER INPUT FOR SECURITY (OPTIONAL)
    $MerchantRequestID = mysqli_real_escape_string($conn, $MerchantRequestID);
    $CheckoutRequestID = mysqli_real_escape_string($conn, $CheckoutRequestID);
    $ResultCode = mysqli_real_escape_string($conn, $ResultCode);
    $Amount = mysqli_real_escape_string($conn, $Amount);
    $TransactionId = mysqli_real_escape_string($conn, $TransactionId);
    $UserPhoneNumber = mysqli_real_escape_string($conn, $UserPhoneNumber);

    // INSERT TRANSACTION DATA INTO THE DATABASE
    $sql = "INSERT INTO success_transactions (MerchantRequestID, CheckoutRequestID, ResultCode, Amount, MpesaReceiptNumber, PhoneNumber) VALUES ('$MerchantRequestID', '$CheckoutRequestID', '$ResultCode', '$Amount', '$TransactionId', '$UserPhoneNumber')";

    if ($conn->query($sql) === TRUE) {
        // TRANSACTION INSERTED SUCCESSFULLY
        echo json_encode(array("message" => "Transaction inserted successfully."));
    } else {
        // ERROR INSERTING TRANSACTION
        echo json_encode(array("message" => "Error inserting transaction: " . $conn->error));
    }

    // CLOSE DATABASE CONNECTION
    $conn->close();
} else {
    // TRANSACTION WAS NOT SUCCESSFUL, HANDLE AS NEEDED
    echo json_encode(array("message" => "Transaction was not successful."));
}
