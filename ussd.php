<?php
// Database credentials
$host = 'localhost';
$username = 'root'; // Update with your MySQL username
$password = ''; // Update with your MySQL password
$database = 'paymentmethods'; // Update with your database name

// Africa's Talking API credentials
$apiKey = "c9e2c70a7dc95be18034dbb43cf11798c88d3b1870c9345821236dc098603b03";
$username = "dynos";

// Create database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check for database connection errors
if ($mysqli->connect_error) {
    die('Database connection error: ' . $mysqli->connect_error);
}

function insertUserData($name, $phoneNumber, $apiKey) {
    global $mysqli;
    
    if (!$name) {
        echo "Name is required";
        return;
    }

    $query = "INSERT INTO credentials (Name, Phone) VALUES (?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $name, $phoneNumber);

    if ($stmt->execute()) {
        echo "Data inserted successfully!\n";
        $message = "Dear $name, your registration was successful. Welcome to Chama App!";
        // Implement SMS sending logic using the Africa's Talking API or any other SMS service API for PHP.
        // Example: sendSms($phoneNumber, $message, $apiKey);
    } else {
        echo "Error executing query: " . $stmt->error;
    }
}

function loginUser($phoneNumber, $name) {
    global $mysqli;
    
    $query = "SELECT * FROM credentials WHERE Name = ? AND Phone = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $name, $phoneNumber);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $isLoggedIn = $result->num_rows > 0;
        echo $isLoggedIn ? "User logged in successfully!\n" : "Invalid login credentials.\n";
    } else {
        echo "Error executing query: " . $stmt->error;
    }
}

// Process POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $phoneNumber = $_POST["phoneNumber"];
    $text = $_POST["text"];
    $counter = 0;

    $response = "";

    if ($text === "") {
        $response = "CON Welcome to Chama App\n1. Register\n2. Login\n3. Terms and Conditions\n4. Know more about us";
    } elseif ($text === '1') {
        $response = "CON Please enter your name:";
    } elseif ($text === '2') {
        $response = "CON Please enter your name:";
    } elseif (substr($text, 0, 2) === '1*') {
        $userInput = substr($text, 2);
        if (!strpos($userInput, '*')) {
            $name = $userInput;
            $response = "CON Please enter your password:";
        } else {
            list($name, $password) = explode('*', $userInput);
            echo "Name is $name\n";
            echo "Password is $password\n";
            echo $phoneNumber;
            insertUserData($name, $phoneNumber, $apiKey);
            $response = "END Registration successful!";
        }
    } elseif (substr($text, 0, 2) === '2*') {
        $userInput = substr($text, 2);
        if (!strpos($userInput, '*')) {
            $name = $userInput;
            $response = "CON Please enter your password:";
        } else {
            list($name, $password) = explode('*', $userInput);
            echo "Name is $name\n";
            echo "Password is $password\n";
            echo $phoneNumber;
            loginUser($phoneNumber, $name);
            return; // Return early to avoid sending the response twice
        }
    } elseif ($text === '3') {
        // Implement SMS sending logic to send the terms and conditions using the Africa's Talking API or any other SMS service API for PHP.
        // Example: sendSms($phoneNumber, "Chama App Terms and Conditions: ...", $apiKey);
        $response = "END You will get a message about our Terms and Conditions";
    } elseif ($text === '4') {
        // Implement SMS sending logic to send information about the app using the Africa's Talking API or any other SMS service API for PHP.
        // Example: sendSms($phoneNumber, "Chama App is a revolutionary platform that aims to ...", $apiKey);
        $response = "END You will get an SMS About Us:";
    } else {
        $response = "END Invalid input. Please try again.";
    }

    header("Content-Type: text/plain");
    echo $response;
}
?>
