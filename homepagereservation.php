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

// Get form data
// Check if form data exists before accessing it
$check_in = isset($_POST['check_in']) ? $_POST['check_in'] : '';
$check_out = isset($_POST['check_out']) ? $_POST['check_out'] : '';
$rooms = isset($_POST['rooms']) ? $_POST['rooms'] : '';
$adults = isset($_POST['adults']) ? $_POST['adults'] : '';
$children = isset($_POST['children']) ? $_POST['children'] : '';


// Insert form data into the database
$sql = "INSERT INTO homepagereservation (check_in, check_out, rooms, adults, children)
        VALUES ('$check_in', '$check_out', '$rooms', '$adults', '$children')";

if ($conn->query($sql) === TRUE) {
    // Redirect to search-result.html with query parameters
    header("Location: search-result.html?check_in=$check_in&check_out=$check_out&rooms=$rooms&adults=$adults&children=$children");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
