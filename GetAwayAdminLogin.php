<?php
// Start the session
session_start();

// Define admin credentials (only these will be accepted)
$admin_email = "admin@gmail.com";
$admin_password = "admin123";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get and sanitize form inputs
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validate credentials
    if ($email === $admin_email && $password === $admin_password) {
        // Set session for the admin
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;

        // Redirect to the admin dashboard
        header("Location: AdminDashboard.php");
        exit;
    } else {
        // Redirect back to login page with an error message
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: GetAway-AdminLogin.html");
        exit;
    }
}
?>
