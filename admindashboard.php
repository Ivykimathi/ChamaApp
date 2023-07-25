<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>admin</title>
</head>
<body>
    <div>
        <section>
            <nav class="navbar">
                <p class="brand-name">CHAMA App</p>
                <ul class="list-items">
                    <li> <a  href="logout.php" id="Home">Logout</a> </li>
                </ul> 
            </nav>
        </section>
        <div class="admin-dashboard">
            <div class="left-sidebar">
                <ul>
                    <li>Loans Taken</li>
                    <li>Group Loan</li>
                    <div class="grid-item" id="members-icon">
                <button id="showMembersButton">View Members</button></div><br>
                  

<div class="grid-item" id="members-icon">
    <button><a href="display.php">View Funds</a></button>
</div>

               
            </div>
            <div class="dashboard-content">
                <div class="dashboard-grid">
                    <!-- Row 1 -->
                    <div class="grid-item">Wallet
                        <img src='assets/img/iconsSocial/icons8-wallet-50.png' alt="Wallet"/>
                    </div>
                    <div class="grid-item">Paid Loans
                        <img src='assets/img/iconsSocial/icons8-pay-30.png' alt="Paid Loans"/>
                    </div>

                    <!-- Row 2 -->
                    <div class="grid-item">Loans Taken
                        <img src='assets/img/iconsSocial/icons8-loan-64.png'alt="Loans Taken"/>
                    </div>
                    <!-- Add an ID to the Total Members div for easier manipulation -->
<!-- <div class="grid-item" id="members-icon">
    <button id="showMembersButton">Total Members</button>
    <img src='assets/img/iconsSocial/icons8-people-96.png' alt="Total Members"/> -->
    <!-- </div> -->
                 <div class="grid-item">Total Members
                        <img src='assets/img/iconsSocial/icons8-loan-64.png'alt="Loans Taken"/>
                    </div>

           <div id="userTable"></div>



                </div>
            </div>
        </div>
        <section id="footer">
            <div class="social-icons">
                <img src="assets/img/iconsSocial/icons8-facebook-48.png" alt="Facebook"/> 
                <img src="assets/img/iconsSocial/icons8-instagram.png" alt="Instagram"/> 
                <img src="assets/img/iconsSocial/icons8-twitter-48.png" alt="Twitter"/> 
            </div>
        </section>
    </div>
</body>
</html>



<!-- Add the following JavaScript/jQuery code -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#showMembersButton").on("click", function() {
            // Fetch user data from the server using AJAX
            $.ajax({
                type: "GET",
                url: "get_members.php",
                dataType: "json",
                success: function(users) {
                    // Create a table to display the user data
                    let table = "<table>";
                    table += "<tr><th>ID</th><th>Username</th><th>Phone</th></tr>";
                    users.forEach(function(user) {
                        table += "<tr><td>" + user.id + "</td><td>" + user.username + "</td><td>" + user.mobile_number + "</td></tr>";
                    });
                    table += "</table>";

                    // Display the table inside a div
                    $("#userTable").html(table);
                },
                error: function() {
                    alert("Failed to fetch user data.");
                }
            });
        });
    });
</script>
