<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if not logged in
    header("Location: GetAwayLogin.php");
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

// Get the logged-in user's email from the session
$user_email = $_SESSION['email'];

// Query to retrieve the reservations for the logged-in user
$sql = "SELECT id, name, email, phone, adults, children, checkin, checkout, message, card_name, card_number, exp_date 
        FROM reservation 
        WHERE email = ? 
        ORDER BY checkin ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking History</title>
  <style>
    body {
      background-color: #f0e5d3;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
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

    h2 {
      text-align: center;
      margin: 20px 0;
    }

    table {
      border-collapse: collapse;
      width: 90%;
      margin: 20px auto;
      background-color: white;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #ddd;
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

<h2>Your Booking History</h2>

<?php if ($result->num_rows > 0): ?>
<table>
  <thead>
    <tr>
      <th>Reservation ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Adults</th>
      <th>Children</th>
      <th>Check-In</th>
      <th>Check-Out</th>
      <th>Message</th>
      <th>Card Name</th>
      <th>Card Number</th>
      <th>Expiration Date</th>
      <th>Receipts</th>
    </tr>
  </thead>
  <tbody>
  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?php echo htmlspecialchars($row['id']); ?></td>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['email']); ?></td>
    <td><?php echo htmlspecialchars($row['phone']); ?></td>
    <td><?php echo htmlspecialchars($row['adults']); ?></td>
    <td><?php echo htmlspecialchars($row['children']); ?></td>
    <td><?php echo htmlspecialchars($row['checkin']); ?></td>
    <td><?php echo htmlspecialchars($row['checkout']); ?></td>
    <td><?php echo htmlspecialchars($row['message']); ?></td>
    <td><?php echo htmlspecialchars($row['card_name']); ?></td>
    <td><?php echo htmlspecialchars($row['card_number']); ?></td>
    <td><?php echo htmlspecialchars($row['exp_date']); ?></td>
    <td>
      <a href="booking_history.php?reservation_id=<?php echo $row['id']; ?>" target="_blank">Booking Receipt</a>
    </td>
  </tr>
  <?php endwhile; ?>
</tbody>
</table>
<?php else: ?>
<p style="text-align: center;">You have no reservations in your booking history.</p>
<?php endif; ?>

<?php
$stmt->close();
$conn->close();
?>

</body>
</html>
