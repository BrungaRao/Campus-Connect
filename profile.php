<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
include("config.php");

$user_id = $_SESSION['user_id'];

// Fetch current user data
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id=$user_id");
$user = mysqli_fetch_assoc($user_query);

// Session message
$message = "";
if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile - CampusConnect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(135deg,#0f2027,#2c5364);
            color: white;
        }

        .glass-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(12px);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .glass-card:hover {
            transform: translateY(-5px);
        }

        .form-control, .btn {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .form-control:focus {
            background: rgba(255,255,255,0.15);
            border-color: #00f2fe;
            color: white;
            box-shadow: none;
        }

        .btn-success {
            background: #00f2fe;
            color: #0f2027;
            border: none;
        }

        select, .form-select {
            background: rgba(255,255,255,0.08); 
            color: white; 
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 10px;
            padding: 6px 12px;
            transition: 0.3s;
        }

        select:focus, .form-select:focus {
            background: rgba(255,255,255,0.15);
            color: white;
            outline: none;
            border-color: #00f2fe; 
        }

        select option {
            background: #0f2027; 
            color: white; 
        }

        select option:hover {
            background: #203a43;
            color: #00f2fe;
        }

        .alert-info {
            background: rgba(0,242,254,0.1);
            border-color: #00f2fe;
            color: #00f2fe;
        }

        h2, h3 {
            color: #00f2fe;
        }
    </style>
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">My Profile</h2>

    <?php if($message != ""): ?>
        <div class="alert alert-info text-center"><?php echo $message; ?></div>
    <?php endif; ?>

    <div class="glass-card">
        <form method="POST" enctype="multipart/form-data" action="update_profile.php">

            <div class="mb-3 text-center">
                <label>Profile Picture</label><br>
                <?php if(!empty($user['profile_pic'])): ?>
                    <img src="<?php echo $user['profile_pic']; ?>" style="width:120px;height:120px;border-radius:50%;margin-bottom:10px;">
                <?php endif; ?>
                <input type="file" name="profile_pic" accept="image/*" class="form-control mt-1">
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Full Name</label>
                    <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>">
                </div>
                <div class="col-md-6">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="<?php echo $user['dob']; ?>">
                </div>
            </div>

            <div class="mb-3">
                <label>Year</label>
                <select name="class_year" class="form-control">
                    <option value="">Select Year</option>
                    <?php
                        $years = ["1", "2", "3"];
                        foreach($years as $year){
                            $selected = ($user['class_year'] == $year) ? "selected" : "";
                            echo "<option value='$year' $selected>$year</option>";
                        }
                    ?>
                </select>
            </div>

            <button type="submit" name="update_profile" class="btn btn-success">Update Profile</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
