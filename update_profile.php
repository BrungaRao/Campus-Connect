<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("config.php");

$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){
    $fullname = mysqli_real_escape_string($conn, trim($_POST['fullname']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $dob = $_POST['dob'];
    $class_year = mysqli_real_escape_string($conn, trim($_POST['class_year']));

    // Fetch current data
    $current_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT fullname,email,phone,dob,class_year,profile_pic FROM users WHERE id=$user_id"));

    $changes = [];

    if($fullname != $current_user['fullname']) $changes['fullname'] = $fullname;
    if($email != $current_user['email']) $changes['email'] = $email;
    if($phone != $current_user['phone']) $changes['phone'] = $phone;
    if($dob != $current_user['dob']) $changes['dob'] = $dob;
    if($class_year != $current_user['class_year']) $changes['class_year'] = $class_year;

    // Profile picture
    if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0){
        $allowed_ext = ['jpg','jpeg','png','webp'];
        $file_name = $_FILES['profile_pic']['name'];
        $file_tmp = $_FILES['profile_pic']['tmp_name'];
        $file_size = $_FILES['profile_pic']['size'];
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if(in_array($ext, $allowed_ext)){
            if($file_size <= 5*1024*1024){
                if(!is_dir('uploads/profile_pics')){
                    mkdir('uploads/profile_pics',0755,true);
                }
                $new_name = "uploads/profile_pics/user_$user_id.$ext";
                move_uploaded_file($file_tmp,$new_name);
                if($new_name != $current_user['profile_pic']){
                    $changes['profile_pic'] = $new_name;
                }
            } else {
                $_SESSION['message'] = "Profile picture must be ≤ 2MB.";
                header("Location: profile.php"); exit();
            }
        } else {
            $_SESSION['message'] = "Invalid profile picture format. Allowed: JPG, PNG, WEBP.";
            header("Location: profile.php"); exit();
        }
    }

    if(!empty($changes)){
        $set_parts = [];
        foreach($changes as $col => $val){
            $val_safe = mysqli_real_escape_string($conn,$val);
            $set_parts[] = "$col='$val_safe'";
        }
        $sql = "UPDATE users SET ".implode(',', $set_parts)." WHERE id=$user_id";
        if(mysqli_query($conn,$sql)){
            $_SESSION['message'] = "Profile updated successfully!";
        } else {
            $_SESSION['message'] = "Error updating profile: ".mysqli_error($conn);
        }
    } else {
        $_SESSION['message'] = "No changes were made.";
    }

    header("Location: profile.php");
    exit();
} else {
    header("Location: profile.php");
    exit();
}
?>