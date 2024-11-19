<?php
// Start the session
session_start();

// Restrict access to logged-in admin users
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: GetAway-AdminLogin.html");
    exit;
}

// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "getaway";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// SQL query to fetch all reservations
$sql = "SELECT * FROM reservation ORDER BY created_at DESC"; // Ensure this line is present

// Execute the query
$result = $conn->query($sql);

// Check for errors in the query execution
if (!$result) {
    die("Error executing query: " . $conn->error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>All Reservations</title>
    <style>
          body {
            background-color: #f0e5d3 !important;
            margin: 0;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        .main-header {
            display: flex;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.68);
            color: black;
            padding: 10px 20px;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-img {
            height: 120px;
            width: 120px;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: bold;
            color: black;
            margin: 0;
        }

        .nav-menu {
            margin-left: 800px; /* Push navigation menu to the far right */
        }


        .nav-menu a {
            font-size: 16px;
            font-weight: bold;
            color: black;
            text-decoration: none;
            padding: 10px 15px;
            background-color: #f2f2f2; /* Optional button styling */
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .nav-menu a:hover {
            background-color: #ddd; /* Hover effect for the link */
        }


        table {
            width: 90%;
            border-collapse: collapse;
            background-color: white;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="main-header">
        <div class="logo-container">
            <img class="logo-img" src="LOGO.png" alt="logo">
            <h1 class="logo-text">GetAway Admin</h1>
        </div>
            <div class="nav-menu">
           <a href="AdminDashboard.php"><b>Dashboard</b></a>
        </div>
    </div>


    <h1 align="center" >All Reservations</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Adults</th>
                <th>Children</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Message</th>
                <th>Card Name</th>
                <th>Card Number</th>
                <th>Expiration Date</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['adults']) . "</td>";
            echo "<td>" . htmlspecialchars($row['children']) . "</td>";
            echo "<td>" . htmlspecialchars($row['checkin']) . "</td>";
            echo "<td>" . htmlspecialchars($row['checkout']) . "</td>";
            echo "<td>" . htmlspecialchars($row['message']) . "</td>";
            echo "<td>" . htmlspecialchars($row['card_name']) . "</td>";
            echo "<td>**** **** **** " . htmlspecialchars(substr($row['card_number'], -4)) . "</td>";
            echo "<td>" . htmlspecialchars($row['exp_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
            // Add Delete button/link here
            echo "<td><a href='delete_reservation.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this reservation?\");'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='14'>No reservations found.</td></tr>";
    }
    ?>
</tbody>

    </table>
</body>
</html>
