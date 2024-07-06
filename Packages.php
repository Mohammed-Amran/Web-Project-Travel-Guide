<?php
session_start(); // Start the session

// Step 1: Connect to the MySQL server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registered";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $location = $_POST['location'];

    $sql = "SELECT * FROM userInfo WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User is registered, redirect to the specific package page
        header("Location: " . htmlspecialchars($location) . ".html"); // Redirect to the package page
        exit;
    } else {
        $error_message = "You are not registered. Please register first.";
    }
}

// Step 3: Show the email input form if location is provided in the query string
if (isset($_GET['location'])) {
    $location = htmlspecialchars($_GET['location']);
} else {
    die("No location specified.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Registration</title>
</head>
<body>
    <h2>Verify Your Registration</h2>
    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>
    <form action="package.php" method="post">
        <input type="hidden" name="location" value="<?php echo $location; ?>">
        <label for="email">Enter your email to verify registration:</label>
        <input type="email" name="email" id="email" placeholder="Your email" required>
        <input type="submit" value="Verify and Continue">
    </form>
</body>
</html>

<?php
// Close the connection
mysqli_close($conn);
?>
