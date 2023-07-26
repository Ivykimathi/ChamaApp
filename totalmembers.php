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

$sql = "SELECT COUNT(*) AS totalMembers FROM users";
$result = $conn->query($sql);

$totalMembers = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalMembers = $row['totalMembers'];
}

$conn->close();

// Return the total number of members as JSON
header('Content-Type: application/json');
echo json_encode(['totalMembers' => $totalMembers]);
?>
