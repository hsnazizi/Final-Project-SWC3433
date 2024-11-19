<?php
// Start the session
session_start();

// Restrict access to logged-in admin users
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: GetAway-AdminLogin.html");
    exit;
}

// Database connection details
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is blank
$dbname = "getaway"; // The database name you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all users from the signup table
$sql = "SELECT * FROM signup ORDER BY fname ASC"; // Adjust order as necessary
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            background-color: #f0e5d3 !important;
            margin: 0;
            overflow-x: hidden;
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
            margin-left: 800px;
        }

        .nav-menu a {
            font-size: 16px;
            font-weight: bold;
            color: black;
            text-decoration: none;
            padding: 10px 15px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .nav-menu a:hover {
            background-color: #ddd;
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

        .action-links {
            margin-top: 10px;
        }

        .action-links a {
            text-decoration: none;
            color: red;
            font-weight: bold;
        }

        .action-links a:hover {
            color: darkred;
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

<h1 align="center">Manage Users</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Subscribe</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Display each user record in a row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['fname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['lname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($row['subscribe']) . "</td>";
                echo "<td class='action-links'>
                        <a href='delete_user.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No users found.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
