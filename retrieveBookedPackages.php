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

// Step 2: Retrieve user_id from session
if (!isset($_SESSION['user_id'])) {
    // Redirect if user is not logged in (handle as per your application's logic)
    header("Location: index.html"); // Redirect to index or login page
    exit();
}

$user_id = $_SESSION['user_id'];

// Step 3: Query to retrieve booked packages along with the user's name
$query = "SELECT userinfo.name, locandpack.location, locandpack.Package_Type
          FROM user_packages
          JOIN locandpack ON user_packages.package_id = locandpack.id
          JOIN userinfo ON user_packages.user_id = userinfo.id
          WHERE user_packages.user_id = $user_id";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error retrieving data: " . mysqli_error($conn));
}

// Step 4: Generate table rows dynamically
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['location']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Package_Type']) . "</td>";
    echo "</tr>";
}

mysqli_close($conn);
?>
