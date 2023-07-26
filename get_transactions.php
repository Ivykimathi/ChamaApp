<?php
// REPLACE WITH YOUR DATABASE CONNECTION DETAILS
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
$sql = "SELECT amount FROM transactions";
$result = $conn->query($sql);

$amountTotal = 0;

if ($result->num_rows > 0) {
    // Loop through all rows and sum the amounts
    while ($row = $result->fetch_assoc()) {
        $amountTotal += $row['amount'];
    }
}

$conn->close();

// Return the total amount as JSON
echo json_encode(['totalAmount' => $amountTotal]);
?>
