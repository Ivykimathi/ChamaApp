<!DOCTYPE html>
<html>
<head>
    <title>Members Table</title>
    <style>
        table {
            margin-left:40px;
            width: 70%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Members Table</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Mobile Number</th>
            <th>Actions</th>
        </tr>
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

            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['id'] . "</td>";
                echo "<td>" . $user['username'] . "</td>";
                echo "<td>" . $user['mobile_number'] . "</td>";
                echo '<td><button onclick="remindMember(' . $user['mobile_number'] . ')">Remind Member</button></td>';
                echo "</tr>";
            }
        ?>
    </table><br><br>
   
    <button>Remind Member</button>

</body>
<script>
        function remindMember(mobileNumber) {
            fetch("send_sms.php?mobile_number=" + mobileNumber)
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        }
    </script>
</html>

