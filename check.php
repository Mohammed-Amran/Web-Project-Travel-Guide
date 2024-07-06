<?php
session_start(); // Start or resume session

// Step 1: Connect to MySQL server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registered"; // Replace with your database name
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['checkname']);
    $phone = mysqli_real_escape_string($conn, $_POST['checkphone']);

    // Step 3: Query to check if user exists in the table
    $checkQuery = "SELECT id FROM userinfo WHERE name='$name' AND phone='$phone'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // User exists, retrieve user_id and store in session
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];

        // Redirect to packages.html or any authorized page
        header("Location: packages.html");
        exit();
    } else {
        // User does not exist, redirect to register.html or show message
        header("Location: register.html");
        exit();
    }
}

mysqli_close($conn);
?>
