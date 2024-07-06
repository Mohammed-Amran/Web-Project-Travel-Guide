<?php

session_start(); // Start or resume session
$user_id = $_SESSION['user_id']; // Access user_id from session



// Step 1: Connect to the MySQL server
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Step 3: Select the created database
if (!mysqli_select_db($conn, "registered")) {
    die("Error selecting database: " . mysqli_error($conn));
}

/*
$createTableSql = "CREATE TABLE IF NOT EXISTS user_packages (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    package_id INT(6) UNSIGNED NOT NULL,  
    FOREIGN KEY (user_id) REFERENCES userinfo(id),
    FOREIGN KEY (package_id) REFERENCES locandpack(id)
)";
if (!mysqli_query($conn, $createTableSql)) {
    die("Error creating table: " . mysqli_error($conn));
}
*/



// Step 5: Insert data into the table upon form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST['Location'];
    $package = $_POST['PackageType'];

    // Insert into locandpack table
    $insertSqlLocandpack = "INSERT INTO locandpack (location, Package_Type) VALUES ('$location', '$package')";
    if (!mysqli_query($conn, $insertSqlLocandpack)) {
        die("Error inserting into locandpack table: " . mysqli_error($conn));
    }

    // Get the last inserted ID for locandpack
    $locandpack_id = mysqli_insert_id($conn);

    // Assuming you have stored user ID somewhere (e.g., in session)
    $user_id = $_SESSION['user_id']; // Adjust this as per your actual session handling

    // Insert into user_packages table
    $insertSqlUserPackages = "INSERT INTO user_packages (user_id, package_id) VALUES ('$user_id', '$locandpack_id')";
    if (mysqli_query($conn, $insertSqlUserPackages)) {
        // Redirect or show success message
        header("Location: index.html"); // Adjust the redirect as needed
        exit();
    } else {
        echo "Error: " . $insertSqlUserPackages . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);






?>