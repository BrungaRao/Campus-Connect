<?php
include("config.php");

$message = "";

if(isset($_POST['register'])){
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $department = $_POST['department'];
    $year = $_POST['year'];

    // Password match check
    if($password !== $confirm_password){
        $message = "Passwords do not match!";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if($res->num_rows > 0){
            $message = "Email already registered!";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user securely
            $stmt = $conn->prepare("INSERT INTO users (fullname,email,password,department,year,role) VALUES (?,?,?,?,?,?)");
            $role = "student"; // default role
            $stmt->bind_param("ssssss", $fullname, $email, $hashed_password, $department, $year, $role);

            if($stmt->execute()){
                header("Location: login.php");
                exit();
            } else {
                $message = "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register - CampusConnect</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
background: linear-gradient(135deg,#0f2027,#2c5364);
height:100vh;
color:white;
}
.register-card{
max-width:450px;
margin:auto;
margin-top:6%;
background: rgba(255,255,255,0.08);
backdrop-filter: blur(12px);
border-radius:15px;
padding:30px;
box-shadow:0 8px 25px rgba(0,0,0,0.3);
}
.register-card h3{
font-weight:bold;
color:#00f2fe;
}
.form-control{
background:rgba(255,255,255,0.1);
border:none;
color:white;
}
.form-control::placeholder{
color:#ddd;
}
.form-control:focus{
background:rgba(255,255,255,0.15);
box-shadow:none;
color:white;
}
.btn-register{
background:#00f2fe;
border:none;
color:black;
font-weight:bold;
border-radius:30px;
}
.btn-register:hover{
background:#00c6ff;
}
.login-link{
font-size:0.9rem;
}
a{
color:#00f2fe;
text-decoration:none;
}
a:hover{
text-decoration:underline;
}
select.form-control{
background: rgba(255,255,255,0.1);
color: white;
border: none;
}
select.form-control:focus{
background: rgba(255,255,255,0.15);
color: white;
box-shadow: none;
}
select.form-control option{
background:#0f2027;
color:white;
}
</style>
</head>
<body>

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="register-card">
<h3 class="text-center mb-4">Join CampusConnect</h3>

<?php if($message) echo "<div class='alert alert-danger'>$message</div>"; ?>

<form method="POST">
    <input type="text" name="fullname" class="form-control mb-3" placeholder="Full Name" required>

    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

    <input type="password" name="confirm_password" class="form-control mb-3" placeholder="Confirm Password" required>

    <select name="department" class="form-control mb-3" required>
        <option value="">Select Department</option>
        <option value="BCA">BCA</option>
        <option value="BBA">BBA</option>
        <option value="BCOM">BCOM</option>
        <option value="BSc">BSc</option>
    </select>

    <select name="year" class="form-control mb-3" required>
        <option value="">Select Year</option>
        <option value="1st Year">1st Year</option>
        <option value="2nd Year">2nd Year</option>
        <option value="3rd Year">3rd Year</option>
    </select>

    <button type="submit" name="register" class="btn btn-info w-100">Register</button>
</form>

<p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
</div>
</div>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
