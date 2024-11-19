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
$username = "root";
$password = "";
$dbname = "getaway";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$report_type = null; // Default value
$result = null; // Default value

// Handle report generation based on user selection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $report_type = $_POST['report_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Reservation Summary Report
    if ($report_type == 'reservation_summary') {
        $sql = "SELECT * FROM reservation WHERE created_at BETWEEN '$start_date' AND '$end_date' ORDER BY created_at DESC";
        $result = $conn->query($sql);
    }

    // User Registration Report
    if ($report_type == 'user_registration') {
        $sql = "SELECT * FROM signup WHERE created_at BETWEEN '$start_date' AND '$end_date' ORDER BY created_at DESC";
        $result = $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Reports</title>
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

        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        table {
            background-color : white ;
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

    <div class="dashboard-container">
    <h1>Generate Reports</h1>

    <!-- Form for selecting report type and date range -->
    <form action="GenerateReports.php" method="POST">
        <label for="report_type">Select Report Type:</label>
        <select name="report_type" id="report_type">
            <option value="reservation_summary">Reservation Summary</option>
            <option value="user_registration">User Registration</option>
        </select>

        <br><br>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" required>

        <br><br>
        
        <input type="submit" value="Generate Report">
    </form>

    <br>

    <?php
    // Display Reservation Summary Report
    if ($report_type == 'reservation_summary' && $result && $result->num_rows > 0) {
        echo "<h2>Reservation Summary Report</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Created At</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['checkin']) . "</td>
                    <td>" . htmlspecialchars($row['checkout']) . "</td>
                    <td>" . htmlspecialchars($row['created_at']) . "</td>
                </tr>";
        }
        echo "</table>";
    }

    // Display User Registration Report
    if ($report_type == 'user_registration' && $result && $result->num_rows > 0) {
        echo "<h2>User Registration Report</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subscribed</th>
                    <th>Created At</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['fname']) . "</td>
                    <td>" . htmlspecialchars($row['lname']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['phone']) . "</td>
                    <td>" . htmlspecialchars($row['subscribe']) . "</td>
                    <td>" . htmlspecialchars($row['created_at']) . "</td>
                </tr>";
        }
        echo "</table>";
    }
    ?>
</div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
