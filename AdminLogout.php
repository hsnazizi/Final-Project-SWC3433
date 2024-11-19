<?php
session_start();
session_unset(); // Clear session variables
session_destroy(); // Destroy the session
header("Location: Get Away - AdminLogin.html");
exit;
?>
