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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['visitor_name']));
    $email = htmlspecialchars(trim($_POST['visitor_email']));
    $phone = htmlspecialchars(trim($_POST['visitor_phone']));
    $adults = intval($_POST['total_adults']);
    $children = intval($_POST['total_children']);
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $message = htmlspecialchars(trim($_POST['visitor_message']));

    // Collect payment data
    $card_name = htmlspecialchars(trim($_POST['card_name']));
    $card_number = "**** **** **** " . substr(htmlspecialchars(trim($_POST['card_number'])), -4);
    $exp_date = $_POST['exp_date'];
    $cvv = htmlspecialchars(trim($_POST['cvv']));


    // Basic server-side validation
    if (empty($name) || empty($email) || empty($phone) || $adults < 1 || empty($checkin) || empty($checkout) || empty($card_name) || empty($card_number) || empty($exp_date) || empty($cvv)) {
        echo "All fields are required and must be filled correctly.";
        exit;
    }

    // Check if check-out date is after check-in date
    if (strtotime($checkout) <= strtotime($checkin)) {
        echo "Check-out date must be after the check-in date.";
        exit;
    }

    // SQL query using prepared statements to prevent SQL injection
    // SQL query using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO reservation (name, email, phone, adults, children, checkin, checkout, message, card_name, card_number, exp_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiisssss", $name, $email, $phone, $adults, $children, $checkin, $checkout, $message, $card_name, $card_number, $exp_date);



    if ($stmt->execute()) {
        echo "
        <script>
            // Add a modal dynamically to the body
            document.body.insertAdjacentHTML('beforeend', `
            <div id='reservationModal' style='position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; align-items: center; justify-content: center; z-index: 1000;'>
                <div style='background: white; padding: 20px; border-radius: 10px; width: 80%; max-width: 500px; text-align: center;'>
                    <h2>Reservation Confirmation</h2>
                    <p>Your reservation has been saved successfully!</p>
                    <p>Payment successful!</p>
                    <button id='closeModal' style='padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;'>Close</button>
                </div>
            </div>
            `);
    
            // Add event listener to close the modal
            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('reservationModal').remove();
            });
        </script>";
    }
     else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

    // Display reservation details as confirmation (for demonstration)
    echo '<div class="content">';
    echo '<h2 align="center">Reservation Details</h2>';
    echo "<table style='width: 70%; margin: 20px auto; border-collapse: collapse; border: 1px solid #ddd; background-color: white;'>
        <thead>
            <tr style='background-color: #f2f2f2;'>
                <th style='padding: 10px; border: 1px solid #ddd;'>Field</th>
                <th style='padding: 10px; border: 1px solid #ddd;'>Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd;'>Name</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>$name</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd;'>Email</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>$email</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd;'>Phone</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>$phone</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd;'>Number of Adults</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>$adults</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd;'>Number of Children</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>$children</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd;'>Check-in Date</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>$checkin</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd;'>Check-out Date</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>$checkout</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd;'>Message</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>$message</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd;'>Cardholder Name</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>$card_name</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd;'>Card Number</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>**** **** **** " . substr($card_number, -4) . "</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd;'>Expiration Date</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>$exp_date</td>
            </tr>
        </tbody>
      </table>";
      echo '</div>';

       
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> GetAway : Completed Transaction </title>
   <style>
     body {
        background-color: #f0e5d3 !important;
        margin: 0;
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
            position: fixed; /* Fixed header */
            top: 0; /* Stick to the top */
            left: 0;
            z-index: 1000; /* Ensure it stays above other elements */
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

    .content {
    margin-top: 140px; /* Adjust based on header height + padding */
    padding: 20px;
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


</body>
</html>
