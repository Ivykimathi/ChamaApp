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
.navbar .dropdown .dropdown:hover>ul {opacity: 1;top: 0;left: 100%;visibility: visible; }</style><!-- ======= Header ======= --><header id="header" class="fixed-top "><div class="container d-flex align-items-center">
<h1 class="logo me-auto"><a href="index.html">Chama App</a></h1>  <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="index.php">About</a></li>
          <li><a class="nav-link scrollto" href="index.php">Services</a></li>
          <li class="dropdown"><a><span>Choose</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="index.php">Logout</a></li>
              <li><a href="register.php">Register</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="index.php">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
</head>
<body>
  <br><br>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="index.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

    <body>
    <h1>Welcome, <?php echo $userData['name'] ?? ''; ?>!</h1>

    <div class="frame">
        <h2>User Profile</h2>
        <p><strong>Name:</strong> <?php echo $userData['name'] ?? ''; ?></p>
        <p><strong>Email:</strong> <?php echo $userData['email'] ?? ''; ?></p>
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

    <div class="frame">
        <h2>Make Monthly Payment</h2>
        <?php if (isset($message)) { ?>
            <p><?php echo $message; ?></p>
        <?php } ?>
        <form method="POST" action="">
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="amount">Amount to Pay:</label>
            <input type="text" id="amount" name="amount" required>

            <input type="submit" name="pay" value="Send Payment">
        </form>
    </div>
</body>
</body>
</html>