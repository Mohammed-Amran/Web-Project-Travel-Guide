<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    
    <!--== - THIS LINK BELOW IS RESPONSIBLE FOR SPECIAL FONT-FAMILY STYLES AND WEIGHTS FROM GOOGLE-FONTS - ==-->
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

     <!--== - THIS LINK BELOW IS RESPONSIBLE FOR ICONS, SUCH AS THE MAIL ICON - ==-->
     <link rel="stylesheet"  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

     <style>

body {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0;
    background-color: #f0f0f0;
}

h1 {
    margin-top: 20px;
    text-align: center;
    font-size: 28px;
    color: rgb(21, 74, 74);
}

.table-container {
    padding-top: 95px;
    width: 80%;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-image: linear-gradient(rgba(1, 0, 5, 0.3), rgba(4, 1, 17, 0.3));
    color: white;
    font-size: 18px;
    box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.15);
}

th, td {
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 15px;
    text-align: left;
}

th {
    background-color: rgb(21, 74, 74);
    color: white;
}

tr:nth-child(even) {
    background-color: rgba(4, 1, 17, 0.3);
}

tr:nth-child(odd) {
    background-color: rgba(1, 0, 5, 0.3);
}

tr:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.btn-container {
    text-align: center;
    margin: 20px 0; /* Adjust top and bottom margins */
}

button.btn {
    background-color: rgb(21, 74, 74);
    color: white;
    padding: 10px 20px;
    font-size: 18px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button.btn:hover {
    background-color: rgba(21, 74, 74, 0.8);
}

button.btn:focus {
    outline: none;
}



    </style>




</head>


<body>

<nav style="height: 30px;">

          

<ul class="navbar">

  <li>
    <a href="index.html">Home</a>
    <a href="index.html#locations">Locations</a>
    <a href="check.html">Packages</a>
    <a href="about.html">About Us</a>
  </li>

</ul>

</nav>




<div class="table-container">
    <h1>Booking History</h1>

    <div class="btn-container">

        <form method="POST" action="history.php">

          <button type="submit" class="btn">Booking History</button>

        </form>
    </div>

    <table border="1">
        <tr>
            <th>User Name</th>
            <th>Location</th>
            <th>Package Type</th>
        </tr>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'retrieveBookedpackages.php';
        }
        ?>
    </table>

    </div>

</body>
</html>
