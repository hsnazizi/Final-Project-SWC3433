<?php
// Start the session
session_start();

// Get database connection
$conn = new mysqli('localhost', 'root', '', 'getaway');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get email and password from the form
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    // Validate email and password input
    if (!empty($email) && !empty($password)) {
        // Prepare a SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT password, fname, lname FROM signup WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if the user exists
        if ($stmt->num_rows > 0) {
            // Fetch the hashed password from the database
            $stmt->bind_result($hashed_password, $fname, $lname);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, proceed to login
                 // Store user info in the session
                 $_SESSION['email'] = $email;
                 $_SESSION['fname'] = $fname;
                 $_SESSION['lname'] = $lname;

                echo "<script>alert('Login successful! Redirecting...');</script>";
                // Redirect to the homepage
                header("Location: Homepage.php");
                // Uncomment below lines for session handling and redirection
                // session_start();
                // $_SESSION['email'] = $email;
                // header("Location: welcome.php");
                // exit;
            } else {
                echo "<script>alert('Invalid password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('No user found with this email.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please fill in both email and password fields.');</script>";
    }
}

$conn->close();
?>
