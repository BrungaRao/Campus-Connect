<?php
session_start();
include("config.php");

// Only admin can access
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit();
}

// Example: delete resource by id
if(isset($_GET['delete_id'])){
    $id = intval($_GET['delete_id']);
    $res = mysqli_query($conn, "SELECT file FROM resources WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    if($row && file_exists($row['file'])){
        unlink($row['file']); // deletes the actual PDF
    }
    mysqli_query($conn, "DELETE FROM resources WHERE id=$id"); // deletes DB record
    header("Location: add_resources.php");
    exit();
}

// Increase PHP limits (works if allowed in php.ini)
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '55M');
ini_set('memory_limit', '128M');
ini_set('max_execution_time', '300');
ini_set('max_input_time', '300');

// Initialize message

if(isset($_SESSION['message'])){
    echo '<div class="alert alert-info">'.$_SESSION['message'].'</div>';
    unset($_SESSION['message']);
}


// Handle PDF upload
if(isset($_POST['upload_resource'])){
    $title = trim(mysqli_real_escape_string($conn, $_POST['title']));

    if(isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === 0){
        $allowed = ['pdf'];
        $ext = strtolower(pathinfo($_FILES['pdf_file']['name'], PATHINFO_EXTENSION));

        if(in_array($ext, $allowed)){
            if(!is_dir('studymaterials')) mkdir('studymaterials', 0755, true);

            $new_name = 'studymaterials/' . time() . '_' . basename($_FILES['pdf_file']['name']);

            if(move_uploaded_file($_FILES['pdf_file']['tmp_name'], $new_name)){
                $sql = "INSERT INTO resources (title, file) VALUES ('$title', '$new_name')";
                if(mysqli_query($conn, $sql)){
                    $_SESSION['message'] = " PDF uploaded successfully!";
                } else {
                    $_SESSION['message'] = "Error saving to database: " . mysqli_error($conn);
                }
            } else {
                $_SESSION['message'] = "Error: Could not move file. Check folder permissions.";
            }
        } else {
            $_SESSION['message'] = "Only PDF files are allowed.";
        }
    } else {
        $_SESSION['message'] = "Error: No file selected or upload error.";
    }

    // Redirect to avoid duplicate submission
    header("Location: add_resources.php");
    exit();
}
// Fetch uploaded PDFs
$resources = mysqli_query($conn, "SELECT * FROM resources ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Study Material</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {background: linear-gradient(135deg,#0f2027,#2c5364); color:white;}
        .glass-card {background: rgba(255,255,255,0.08); backdrop-filter: blur(12px); border-radius:15px; padding:25px; margin-bottom:20px;}
        .form-control, .btn {background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2);}
        .form-control { background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2);}
        .btn-success {background: rgba(255,255,255,0.1); color:white; border:none;}
        .btn-primary {background: rgba(255,255,255,0.1); color:white; border:none;}
        .list-group-item {background: rgba(255,255,255,0.08); color:white; border:none; margin-bottom:5px; border-radius:10px;}
        .list-group-item:hover {background: rgba(255,255,255,0.15); color:white;}
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
<div class="container mt-5">
    <div class="glass-card">
        <h2>Upload Study Material (PDF)</h2>

        <?php if(!empty($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" name="title" class="form-control" placeholder="Enter PDF title" required>
            </div>
            <div class="mb-3">
                <input type="file" name="pdf_file" class="form-control" accept="application/pdf" required>
            </div>
            <button type="submit" name="upload_resource" class="btn btn-success">Upload PDF</button>
        </form>
    </div>

    <h3>Uploaded PDFs</h3>
    <div class="row">
        <?php while($r = mysqli_fetch_assoc($resources)): ?>
            <div class="col-md-4">
    <div class="glass-card text-center">
        <h4><?php echo htmlspecialchars($r['title']); ?></h4>
        <a href="<?php echo htmlspecialchars($r['file']); ?>" target="_blank" class="btn btn-primary mt-2">Download PDF</a>
        <a href="add_resources.php?delete_id=<?php echo $r['id']; ?>" class="btn btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this resource?');">Delete</a>
    </div>
</div>
        <?php endwhile; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
