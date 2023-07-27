<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
        header{ transition: all 0.5s; z-index: 997;padding: 15px 0;margin-top:0px;background: #37517e;}
        #header.header-scrolled,#header.header-inner-pages {background: rgba(40, 58, 90, 0.9);}
        
        .navbar {padding: 0;}
.navbar ul {margin: 0;padding: 0;display: flex;list-style: none;align-items: center;}
.navbar li {position: relative;}
.navbar a, .navbar a:focus {display: flex;align-items: center;justify-content: space-between;padding: 10px 0 10px 30px;font-size: 15px;font-weight: 500;white-space: nowrap;transition: 0.3s;}
.navbar a i,.navbar a:focus i {font-size: 12px;line-height: 0;margin-left: 5px;}
.navbar a:hover,.navbar .active,.navbar .active:focus,.navbar li:hover>a {color: #47b2e4;}
.navbar .getstarted,.navbar .getstarted:focus {padding: 8px 20px;margin-left: 30px;border-radius: 50px;color: #fff;font-size: 14px;border: 2px solid #47b2e4;font-weight: 600; }
.navbar .getstarted:hover,.navbar .getstarted:focus:hover {color: #fff;background: #31a9e1; }
.navbar .dropdown ul {display: block;position: absolute;left: 14px;top: calc(100% + 30px);margin: 0;padding: 10px 0;z-index: 99;opacity: 0;visibility: hidden;background: #fff;box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);transition: 0.3s;border-radius: 4px; }
.navbar .dropdown ul li {min-width: 200px; }
.navbar .dropdown ul a {padding: 10px 20px;font-size: 14px;text-transform: none;font-weight: 500;color: #0c3c53; }
.navbar .dropdown ul a i {font-size: 12px; }
.navbar .dropdown ul a:hover,.navbar .dropdown ul .active:hover,.navbar .dropdown ul li:hover>a {color: #47b2e4; }
.navbar .dropdown:hover>ul {opacity: 1;top: 100%;visibility: visible; }
.navbar .dropdown .dropdown ul {top: 0;left: calc(100% - 30px);visibility: hidden; }
.navbar .dropdown .dropdown:hover>ul {opacity: 1;top: 0;left: 100%;visibility: visible; }
.nav-link{font:50px;}
</style>
    <link rel="stylesheet" href="admin.css">
<header id="header" class="fixed-top ">
  <div class="container d-flex align-items-center">
<h1 class="logo me-auto"><a href="index.html">Chama App</a></h1>  <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="http://localhost/ChamaApp/">Home</a></li>
          <li><a class="nav-link scrollto" href="/ChamaApp/">About</a></li>
          <li><a class="nav-link scrollto" href="/ChamaApp/">Services</a></li>
          <li class="dropdown"><a class="nav-link scrollto"><span>Choose</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="logout.php">Logout</a></li>
              <li><a href="register.php">Register</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="/ChamaApp/">Contact</a></li>
        </ul>
       
      </nav>
      
    </div>
    
    </header>
</head>
<body><br><br><br>
<h1 style="margin-left:890px;"class="my-5">Welcome <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>,</h1>
 
  
   

    <body>
   

    <div class="frame">
        <h2>User Profile</h2>
        <p><strong>Name:</strong><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></p>
        <p><strong>Phone Number</strong> <?php echo $userData['email'] ?? ''; ?></p>
    </div>

    <div class="frame">
        <h2>Account Balance</h2>
        <p><strong>Account:</strong> <?php echo $accountsData['account_balance'] ?? ''; ?></p>
    </div>

    <div class="frame">
        <h2>Loan Details</h2>
        <p><strong>Loan Amount:</strong> <?php echo $accountsData['loan_amount'] ?? ''; ?></p>
        <p><strong>Loan Status:</strong> <?php echo $accountsData['loan_status'] ?? ''; ?></p>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <a href="paymentform.php" class="btn btn-danger ml-3">Proceed to Payment</a>
    </p>

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
    
</body>
</body>
</html>