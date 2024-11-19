<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if not logged in
    header("Location: GetAwayLogin.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "getaway";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if reservation_id is provided in the URL
if (!isset($_GET['reservation_id']) || empty($_GET['reservation_id'])) {
    echo "Error: Reservation ID is missing.";
    exit;
}

// Sanitize and fetch the reservation_id
$reservation_id = intval($_GET['reservation_id']);

// Query the database for the reservation details
$stmt = $conn->prepare("SELECT * FROM reservation WHERE id = ?");
$stmt->bind_param("i", $reservation_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if reservation exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    $row = null;
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetAway: Successful Booking</title>
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0e5d3;
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* Prevent horizontal scrolling */
    }

    /* Header styling */
    .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.68);
            color: black;
            padding: 10px 20px;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            margin: 0;
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
      display: flex;
      gap: 20px; /* Space between navigation links */
      margin-right: 20px;
    }

    .nav-menu a {
      text-decoration: none;
      color: black;
      font-weight: bold;
      padding: 5px 10px;
    }

    .nav-menu a:hover {
      background-color: #ddd;
      border-radius: 5px;
    }

    /* To prevent content overlap with the fixed header */
    .content {
      padding-top: 20px;
    }

    /* Dropdown Button */
        .dropbtn {
        color: black;
        font-weight: bold;
        text-transform: uppercase;
        background: none ;
        border: none;
        font-family: Arial, sans-serif;
        text-decoration: none;
        font-size: 16px;
        }



    .dropdown {
        position: relative;
        display: inline-block;
        }

    /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
        display: none;
        position: absolute;
        min-width: 160px;
        background-color: #f1f1f1;
        }

        .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        }


    /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {display: block;}


    /* END OF HEADER*/

    h1 {
        text-align: center;
        color: #333;
        margin: 20px 0;
    }

    table {
        margin: 20px auto;
        border-collapse: collapse;
        width: 80%;
        background-color: white;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #c99552
        color: white;
    }

    tr:nth-child(even) {
        background-color: #ffcf91;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    p {
        text-align: center;
        font-size: 18px;
        color: #333;
    }
  </style>
</head>
<body>

<header>
    <div class="main-header">
        <div class="logo-container">
        <img class="logo-img" src="LOGO.png" alt="logo listing">
        <h1 class="logo-text">GetAway</h1>
        </div>
        <nav class="nav-menu">
        <a href="Homepage.php"><b>HOME</b></a>
        <a href="Accomodations Listings.php"><b>ACCOMODATIONS</b></a>
        <div class="dropdown">
        <button class="dropbtn">Welcome, <?php echo htmlspecialchars($_SESSION['fname'] . " " . $_SESSION['lname']); ?>!</button>
            <div class="dropdown-content">
                <a href="user-booking-list.php">Booking History</a>
                <a href="GetAwayLogout.php">Log Out from (<?php echo htmlspecialchars($_SESSION['email']); ?>.)</a>
            </div>
        </div>
        </nav>
    </div>
</header>

<?php if ($row): ?>
<table>
<h1>Booking Receipt</h1>
  <tr>
    <th>Name</th>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?php echo htmlspecialchars($row['email']); ?></td>
  </tr>
  <tr>
    <th>Phone</th>
    <td><?php echo htmlspecialchars($row['phone']); ?></td>
  </tr>
  <tr>
    <th>Check-In Date</th>
    <td><?php echo htmlspecialchars($row['checkin']); ?></td>
  </tr>
  <tr>
    <th>Check-Out Date</th>
    <td><?php echo htmlspecialchars($row['checkout']); ?></td>
  </tr>
  <tr>
    <th>Number of Adults</th>
    <td><?php echo htmlspecialchars($row['adults']); ?></td>
  </tr>
  <tr>
    <th>Number of Children</th>
    <td><?php echo htmlspecialchars($row['children']); ?></td>
  </tr>
  <tr>
    <th>Message</th>
    <td><?php echo htmlspecialchars($row['message']); ?></td>
  </tr>
</table>
<?php else: ?>
<p>No reservation found.</p>
<?php endif; ?>

</body>
</html>
