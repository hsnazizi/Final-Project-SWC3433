<?php
// Start the session
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to admin login page if not logged in
    header("Location: GetAwayAdminLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            background-color: #f0e5d3;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        .main-header {
            display: flex;
            justify-content: space-between;
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

        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .dashboard-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .dashboard-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #c99552;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .dashboard-container a:hover {
            background-color: #b3834a;
        }

        .welcome-message {
            text-align: center;
            margin-bottom: 20px;
        }

        .logout {
            margin-top: 10px;
            text-align: center;
        }

        .logout a {
            text-decoration: none;
            color: black ;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="main-header">
        <div class="logo-container">
            <img class="logo-img" src="LOGO.png" alt="logo">
            <h1 class="logo-text">GetAway Admin</h1>
        </div>
    </div>

    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        <p class="welcome-message">Welcome, <strong><?php echo htmlspecialchars($_SESSION['admin_email']); ?></strong>!</p>

        <h2>Admin Options</h2>
        <ul>
            <li><a href="ViewAllReservations.php">View All Reservations</a></li>
            <li><a href="ManageUsers.php">Manage Users</a></li>
            <li><a href="GenerateReports.php">Generate Reports</a></li>
        </ul>

        <div class="logout">
            <p><a href="AdminLogout.php">Log Out</a></p>
        </div>
    </div>
</body>
</html>
