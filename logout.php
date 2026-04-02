<?php
session_start();
include("config.php"); // Use your DB connection file

$user_id = $_SESSION['user_id'] ?? null;

// Log logout activity if user is logged in
if ($user_id) {
    $stmt = $conn->prepare("INSERT INTO activity_log (user_id, activity) VALUES (?, ?)");
    $activity = "Logged out";
    $stmt->bind_param("is", $user_id, $activity);
    $stmt->execute();
    $stmt->close();
}

// Clear all session data
$_SESSION = [];
session_unset();
session_destroy();

// Redirect to login page with a message
header("Location: login.php?msg=loggedout");
exit();
?>