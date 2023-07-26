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

// INITIAL SQL QUERY
$sql = "SELECT id, Phone, Amount, Timestamp FROM transactions";

// CHECK IF THE FORM IS SUBMITTED
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['sort_option'])) {
    $sort_option = $_GET['sort_option'];

    // MODIFY THE SQL QUERY BASED ON THE SELECTED SORT OPTION
    switch ($sort_option) {
        case 'date':
            $sort_column = 'DATE(Timestamp)';
            break;
        case 'month':
            $sort_column = 'MONTH(Timestamp)';
            break;
        default:
            $sort_column = 'Timestamp';
            break;
    }

    // ADD ORDER BY CLAUSE TO THE SQL QUERY
    $sql .= " ORDER BY $sort_column DESC";
}

// FETCH TRANSACTIONS FROM DATABASE
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
        <form action="" method="get" class="mb-3">
            <label for="sort_option">Sort by:</label>
            <select name="sort_option" id="sort_option">
                <option value="timestamp">Timestamp</option>
                <option value="date">Date</option>
                <option value="month">Month</option>
            </select>
            <input type="submit" value="Sort">
        </form>
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
        <button onclick="goBack()" class="btn btn-secondary">Back</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>

<?php
// CLOSE DATABASE CONNECTION
$conn->close();
?>
