<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .wrapper {
            width: 360px;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2 class="text-center">Payment Form</h2>
        <p class="text-center">Please fill this form to make a payment.</p>
        <form action="process_payment.php" method="post">
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control">
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control">
            </div>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-primary" value="Submit Payment">
            </div>
        </form>
        <p class="text-center"><a href="index.php">Back to homepage</a></p>
    </div>    
</body>
</html>
