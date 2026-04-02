<?php
if (session_status() == PHP_SESSION_NONE) session_start();

$currentPage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$username = htmlspecialchars($_SESSION['username'] ?? "Student", ENT_QUOTES, 'UTF-8');
$role = $_SESSION['role'] ?? "user";
?>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top shadow">
  <div class="container">
    <a class="navbar-brand fw-bold text-info" href="index.php">
        <i class="bi bi-mortarboard-fill"></i> CampusConnect
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link <?= ($currentPage=="index.php")?'active-link':'' ?>" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage=="academics.php")?'active-link':'' ?>" href="academics.php">Academics</a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage=="community.php")?'active-link':'' ?>" href="community.php">Community</a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage=="about.php")?'active-link':'' ?>" href="about.php">About</a></li>
      </ul>

<ul class="navbar-nav align-items-center">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
      <i class="bi bi-person-circle me-1"></i> <?= $username ?>
      <?php if($role=="admin"): ?>
        <span class="badge bg-warning text-dark ms-1" title="Administrator">Admin</span>
      <?php endif; ?>
    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow">
      <!-- Visible to all users -->
      <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
      <li><a class="dropdown-item" href="help.php">Help Center</a></li>

      <!-- Only for admins -->
      <?php if($role=="admin"): ?>
        <li><a class="dropdown-item" href="user.php">Manage Users</a></li>
        <li><a class="dropdown-item" href="admin_notifications.php">Notifications</a></li>
        <li><a class="dropdown-item" href="add_resources.php">Manage Resources</a></li>
        <li><a class="dropdown-item" href="view_submissions.php">View Submissions</a></li>

      <?php endif; ?>

      <li><hr class="dropdown-divider"></li>

      <!-- Logout for all users -->
      <li><a class="dropdown-item" href="logout.php">Logout</a></li>
    </ul>
  </li>
</ul>

    </div>
  </div>
</nav>