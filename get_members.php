
<?php
// Assuming you have already established a database connection in your "config.php" or other relevant file.

// Include config file
require_once "config.php";

// Fetch all users from the database
$sql = "SELECT id, username, mobile_number FROM users"; // Modify this query based on your database table structure
$result = mysqli_query($link, $sql);

// Create an array to store the user data
$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}


// Send the user data as a JSON response
header("Content-Type: application/json");
echo json_encode($users);
?>