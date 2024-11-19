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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data and sanitize
    $fname = trim(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING));
    $lname = trim(filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING));
    $day = filter_input(INPUT_POST, 'day', FILTER_SANITIZE_NUMBER_INT);
    $month = filter_input(INPUT_POST, 'month', FILTER_SANITIZE_STRING);
    $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']); // Password is sanitized below
    $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $subscribe = filter_input(INPUT_POST, 'cust', FILTER_SANITIZE_STRING);

    // Validate form data
    if (empty($fname) || empty($lname) || empty($email) || empty($password)) {
        echo "Please fill out all required fields.";
    } else {
        // Check if the email already exists
        $check_stmt = $conn->prepare("SELECT id FROM signup WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "This email is already registered. Please use a different email.";
        } else {
            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            echo "Hashed Password: $hashed_password<br>";

            // Prepare the SQL statement
            $stmt = $conn->prepare(
                "INSERT INTO signup (fname, lname, dob_day, dob_month, dob_year, email, password, area_code, phone, subscribe) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("ssisssssss", $fname, $lname, $day, $month, $year, $email, $hashed_password, $code, $phone, $subscribe);

            // Execute the query and check if it was successful
            if ($stmt->execute()) {
                echo "<script>alert(Thank you for registering, $fname $lname!');</script>";

             // Redirect to the login page
            header("Location: Get Away - Login.html");
            exit(); // Ensure no further code is executed

            } else {
                echo "An error occurred. Please try again later.";
            }

            $stmt->close();
        }

        $check_stmt->close();
    }
}

// Close the connection
$conn->close();
?>
