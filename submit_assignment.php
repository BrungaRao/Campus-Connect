<?php
session_start();
include("config.php");

// Only logged-in students
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student'){
    die("Please login first.");
}

$student_id = $_SESSION['user_id'];

if(isset($_POST['ajax_upload'])) {
    $assignment_id = intval($_POST['assignment_id']);

    // Prevent duplicate submission
    $check = $conn->prepare("SELECT id FROM assignment_submissions WHERE assignment_id=? AND student_id=?");
    $check->bind_param("ii", $assignment_id, $student_id);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){
        echo "You already submitted this assignment.";
        exit();
    }

    if(isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === 0) {
        // Only check extension (no finfo)
        $ext = strtolower(pathinfo($_FILES['pdf_file']['name'], PATHINFO_EXTENSION));
        if($ext !== "pdf"){ echo "Only PDF files allowed."; exit(); }

        // Ensure folder exists
        if(!is_dir("uploads/assignments")) mkdir("uploads/assignments", 0755, true);

        // Unique filename
        $file = "uploads/assignments/student_{$student_id}_assignment_{$assignment_id}_" . time() . ".pdf";

        if(move_uploaded_file($_FILES['pdf_file']['tmp_name'], $file)){
            $stmt = $conn->prepare("INSERT INTO assignment_submissions (assignment_id, student_id, file_path) VALUES (?,?,?)");
            $stmt->bind_param("iis", $assignment_id, $student_id, $file);
            $stmt->execute();
            $stmt->close();
            echo "Assignment uploaded successfully!";
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "Please select a PDF file.";
    }
    exit();
}

// Fetch assignments for dropdown (if used standalone)
$assignments = mysqli_query($conn,"SELECT * FROM assignments ORDER BY id DESC");
?>