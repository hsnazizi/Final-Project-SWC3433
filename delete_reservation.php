<?php
// Start the session
session_start();

// Restrict access to logged-in admin users
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: GetAway-AdminLogin.html");
    exit;
}

// Check if the ID is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

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

    // SQL query to delete the reservation
    $sql = "DELETE FROM reservation WHERE id = ?";

    // Prepare and bind statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Successfully deleted
            header("Location: ViewAllReservations.php"); // Redirect back to the reservations page
        } else {
            // Error deleting
            echo "Error deleting reservation: " . $conn->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    // If no ID is provided
    echo "Invalid request.";
}
?>
