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

// FETCH TRANSACTIONS FROM DATABASE
$sql = "SELECT id, Phone, Amount, Timestamp FROM transactions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Transaction History</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Phone Number</th>
                    <th>Amount</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // CHECK IF THERE ARE ANY TRANSACTIONS
                if ($result->num_rows > 0) {
                    // LOOP THROUGH THE RESULTS AND DISPLAY THEM IN THE TABLE
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['Phone'] . "</td>";
                        echo "<td>" . $row['Amount'] . "</td>";
                        echo "<td>" . $row['Timestamp'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // NO TRANSACTIONS FOUND
                    echo "<tr><td colspan='4'>No transactions found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// CLOSE DATABASE CONNECTION
$conn->close();
?>
