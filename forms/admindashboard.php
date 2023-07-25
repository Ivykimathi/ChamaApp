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
                <p class="brand-name">CHAMA</p>
                <ul class="list-items">
                    <li> <a href="/ChamaApp/" id="Home">Home</a> </li>
                    <li> <a href="/ChamaApp/" id="About">About Us</a> </li>
                    <li> <a href="/ChamaApp/" >Services</a></li>
                    <li> <a href="/ChamaApp/" id="admin">Admin</a></li>
                </ul> 
            </nav>
        </section>
        <div class="admin-dashboard">
            <div class="left-sidebar">
                <ul>
                    <li>View Group Balance</li>
                    <li>Loans Taken</li>
                    <li>Group Loan</li>
                    <li>View Members</li>
                </ul>
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
                    <div class="grid-item" id='members-icon'>Total Members
                        <img src='assets/img/iconsSocial/icons8-people-96.png' alt="Total Members"/>
                    </div>

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