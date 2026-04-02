<?php
include('config.php');
session_start();

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statement
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    if(!$stmt){
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        if(password_verify($password, $hashed_password)){
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;

            if($role == 'admin'){
                header("Location: user.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Email not registered!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - CampusConnect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Add Bootstrap Icons -->
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #2c5364);
            height: 100vh;
            color: white;
        }
        .login-card {
            max-width: 400px;
            margin: auto;
            margin-top: 10%;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
        .login-card h3 {
            font-weight: bold;
            color: #00f2fe;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
        }
        .form-control::placeholder {
            color: #ddd;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            box-shadow: none;
            color: white;
        }
        .btn-login {
            background: #00f2fe;
            border: none;
            color: black;
            border-radius: 30px;
        }
        .btn-login:hover {
            background: #00c6ff;
        }
        .register-link {
            font-size: 0.9rem;
        }
        a {
            color: #00f2fe;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .modal-content {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            border-radius: 15px;
            color: white;
            border: none;
        }
        .modal-title {
            color: #00f2fe;
            font-weight: bold;
        }
        .btn-close {
            filter: invert(1);
        }

        /* Custom Styling for the Toggle Icon */
        .password-toggle {
            cursor: pointer;
            color: #00f2fe;
        }
        .password-toggle i {
            font-size: 0.8rem;
        }

        /* Remove border for input and icon merge */
        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.08) !important;
            border: none;
            color: white;
            cursor: pointer;
        }

        .input-group .form-control {
            border: none;
            border-radius: 0.375rem;
        }

        /* Adjust icon to look merged with input */
        .input-group .password-toggle {
            padding: 0.5rem;
        }

        .form-control:focus {
            box-shadow: none;
        }

    </style>
</head>
<body>

<div class="login-card">
    <h3 class="text-center mb-4">CampusConnect Login</h3>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                <span class="input-group-text password-toggle" id="togglePassword">
                    <i class="bi bi-eye-slash" id="eyeIcon"></i> <!-- Eye Icon for Password Visibility -->
                </span>
            </div>
        </div>
        <button type="submit" name="login" class="btn btn-login w-100">Login</button>
    </form>

    <p class="text-center mt-3 register-link">
        Don't have an account? <a href="register.php">Register here</a>
    </p>

    <!-- Forgot Password Link -->
    <div class="mt-2 text-center">
        <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" class="text-decoration-none">Forgot Password?</a>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content forgot-card">

      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold" id="forgotPasswordLabel">Forgot Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        <p>Contact the administrator.</p>
        <p>admin@campusconnect.com</p>
      </div>

      <div class="modal-footer border-0">
        <button type="button" class="btn btn-login w-100" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function() {
        // Toggle the type of the password field
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;

        // Toggle the icon
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
    });
</script>

</body>
</html>