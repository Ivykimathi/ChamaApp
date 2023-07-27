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
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
    <title>admin</title>
</head>
<body>
    <div>
        <section>
            <nav class="navbar">
                <p class="brand-name">Chama App</p>
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
                <button><a href="members.php">View Members</a></button></div><br>
                  

<div class="grid-item" id="members-icon">
    <button><a href="display.php">View Funds</a></button>
</div>      
            </div>
            <div class="dashboard-content">
                <div class="dashboard-grid">
                    <!-- Row 1 -->
                    <div class="grid-item">Wallet
                    <img src='assets/img/iconsSocial/icons8-wallet-50.png' alt="Wallet"/>
                    <h4>KES</h4> <span id="totalAmount"></span>
                     
    </div>

        <div class="grid-item">Paid Loans
                        <img src='assets/img/iconsSocial/icons8-pay-30.png' alt="Paid Loans"/>
                    </div>

                    <!-- Row 2 -->
                    <div class="grid-item">Loans Taken
                        <img src='assets/img/iconsSocial/icons8-loan-64.png'alt="Loans Taken"/>
                    </div>
                  
                 <div class="grid-item">Total Members
                        <img src='assets/img/iconsSocial/icons8-loan-64.png'alt="Loans Taken"/>
                        <h3><span id="totalMembers"></span></h3> <h4>members</h4>
                    </div>

                    <div id="membersTableContainer"></div>



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
<script>
        // Use JavaScript to fetch the total amount from the PHP script
        fetch('get_transactions.php')
            .then(response => response.json())
            .then(data => {
                // Update the content of the 'totalAmount' span with the retrieved value
                document.getElementById('totalAmount').textContent = data.totalAmount;
            })
            .catch(error => console.error('Error fetching total amount:', error));

        // Use JavaScript to fetch the total number of members from the PHP script
        fetch('totalmembers.php')
            .then(response => response.json())
            .then(data => {
                // Update the content of the 'totalMembers' span with the retrieved value
                document.getElementById('totalMembers').textContent = data.totalMembers;
            })
            .catch(error => console.error('Error fetching total members:', error));
    </script>
              
</html>



<!-- Add the following JavaScript/jQuery code -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    