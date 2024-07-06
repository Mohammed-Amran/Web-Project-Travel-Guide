<?php
// Step 1: Connect to the MySQL server
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
/*
// Step 2: Create the database
$createDbSql = "CREATE DATABASE IF NOT EXISTS registered";
if (!mysqli_query($conn, $createDbSql)) {
    die("Error creating database: " . mysqli_error($conn));
}
    */

// Step 3: Select the created database
if (!mysqli_select_db($conn, "registered")) {
    die("Error selecting database: " . mysqli_error($conn));
}

/*
// Step 4: Create the table if it doesn't already exist
$createTableSql = "CREATE TABLE IF NOT EXISTS LOCandPACK (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Location VARCHAR(50) NOT NULL,
    Package_Type VARCHAR(50) NOT NULL  
)";
if (!mysqli_query($conn, $createTableSql)) {
    die("Error creating table: " . mysqli_error($conn));
}
*/

// Step 5: Insert data into the table upon form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['myname1'];
    $email = $_POST['myemail'];
    $phone = $_POST['myphone'];
    $age = $_POST['myage'];
    $gender = $_POST['mygender'];

    $insertSql = "INSERT INTO userInfo (name, email, phone, age, gender) VALUES ('$name', '$email', '$phone', '$age', '$gender')";
    if (mysqli_query($conn, $insertSql)) {
        header("Location: index.html");
        echo "New record created successfully";
    } else {
        echo "Error: " . $insertSql . "<br>" . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);

?>