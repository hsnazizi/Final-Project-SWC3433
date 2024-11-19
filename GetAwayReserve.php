<?php

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

    // Basic server-side validation
    if (empty($name) || empty($email) || empty($phone) || $adults < 1 || empty($checkin) || empty($checkout)) {
        echo "All fields are required and must be filled correctly.";
        exit;
    }

    // Check if check-out date is after check-in date
    if (strtotime($checkout) <= strtotime($checkin)) {
        echo "Check-out date must be after the check-in date.";
        exit;
    }

    // SQL query using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO reservation (name, email, phone, adults, children, checkin, checkout, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiiss", $name, $email, $phone, $adults, $children, $checkin, $checkout, $message);

    if ($stmt->execute()) {
        echo "<p>Your reservation has been saved successfully!</p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

    // Display reservation details as confirmation (for demonstration)
    echo "<h2>Reservation Details</h2>";
    echo "<p>Name: $name</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Phone: $phone</p>";
    echo "<p>Number of Adults: $adults</p>";
    echo "<p>Number of Children: $children</p>";
    echo "<p>Check-in Date: $checkin</p>";
    echo "<p>Check-out Date: $checkout</p>";
    echo "<p>Message: $message</p>";
    echo "<p>Your reservation has been submitted successfully!</p>";
}

$conn->close();
?>
