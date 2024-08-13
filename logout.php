<?php
session_start(); // Start the session

// Check if a session exists
if (isset($_SESSION['sid'])) {
    // Clear all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to login page
    header("Location: login.php");
    exit(); // Ensure no further code is executed
}

// Check if the role is admin and the session exists
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    // Clear all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to login page
    header("Location: login.php");
    exit(); // Ensure no further code is executed
}

// If no session exists or role is not admin, redirect to login page
header("Location: login.php");
exit(); // Ensure no further code is executed
?>
