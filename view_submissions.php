<?php
session_start();
include("config.php");

// Only admin
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    die("Access denied. Admins only.");
}

$query = "SELECT s.*, a.title AS assignment_title, u.fullname AS student_name
          FROM assignment_submissions s
          JOIN assignments a ON s.assignment_id = a.id
          JOIN users u ON s.student_id = u.id
          ORDER BY s.submitted_at DESC";

$result = mysqli_query($conn, $query);
if(!$result) die("Database query failed: " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Submitted Assignments</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {background: linear-gradient(135deg,#0f2027,#203a43,#2c5364); color:white; font-family: Arial, sans-serif;}
.container {margin-top:50px;}
.glass-card {background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); border-radius:15px; padding:25px; border:1px solid rgba(255,255,255,0.1);}
.table-glass {width:100%; border-collapse: separate; border-spacing:0; background: rgba(255,255,255,0.05); border-radius:15px; overflow:hidden; text-align:center;}
.table-glass th, .table-glass td {padding:10px; color:white;}
.table-glass thead th {background: rgba(255,255,255,0.12);}
.table-glass tbody tr:hover td {background: rgba(255,255,255,0.12);}
.btn-light, .btn-info {font-size:13px; padding:5px 10px; margin:2px;}
h2 {text-align:center; margin-bottom:30px;}
</style>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container">
    <h2>All Submitted Assignments</h2>
    <div class="glass-card table-responsive">
        <table class="table-glass">
            <thead>
                <tr>
                    <th>Assignment</th>
                    <th>Student</th>
                    <th>File</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['assignment_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                            <td>
                                <?php if(!empty($row['file_path']) && file_exists($row['file_path'])): ?>
                                    <a href="<?php echo htmlspecialchars($row['file_path']); ?>" target="_blank" class="btn btn-light btn-sm">View PDF</a>
                                    <a href="<?php echo htmlspecialchars($row['file_path']); ?>" download class="btn btn-info btn-sm">Download PDF</a>
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td><?php echo !empty($row['submitted_at']) ? date("d M Y, h:i A", strtotime($row['submitted_at'])) : 'N/A'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">No submissions yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>