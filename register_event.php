<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id'])) {
    exit('Not logged in');
}

$event_id = intval($_GET['event_id']);
$user_id = $_SESSION['student_id'];

mysqli_query($conn, "INSERT INTO event_registrations (student_id, event_id) VALUES ($user_id, $event_id)");

$action = "registered_event";
mysqli_query($conn, "INSERT INTO admin_notifications (user_id, action, reference_id) VALUES ($user_id, '$action', $event_id)");

echo "success";
?>
