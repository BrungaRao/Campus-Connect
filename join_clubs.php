<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id'])) {
    exit('Not logged in');
}

$club_id = intval($_GET['club_id']);
$user_id = $_SESSION['user_id'];

mysqli_query($conn, "INSERT INTO club_members (user_id, club_id) VALUES ($user_id, $club_id)");

$action = "joined_club";
mysqli_query($conn, "INSERT INTO admin_notifications (user_id, action, reference_id) VALUES ($user_id, '$action', $club_id)");

echo "success";
?>
