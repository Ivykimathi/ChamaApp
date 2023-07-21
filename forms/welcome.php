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
    </style>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">Features</a>
      <a class="nav-item nav-link" href="#">Pricing</a>
      <a class="nav-item nav-link disabled" href="#">Disabled</a>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="reset-password.php" class="btn btn-warning">Reset Your Password< /a>
          <a class="dropdown-item" href="index.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        </div>
      </li>
    </div>
  </div>
</nav>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
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