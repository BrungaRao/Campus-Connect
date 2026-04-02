<?php
session_start();
include("config.php");

// Redirect if not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// Fetch user info from database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT fullname FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Fetch dynamic stats
$upcomingEventsCount = $conn->query("SELECT COUNT(*) AS total FROM events WHERE event_date >= CURDATE()")->fetch_assoc()['total'] ?? 0;
$onlineMembers = 34;

// Fetch upcoming events (next 5)
$upcomingEvents = $conn->query("SELECT title, event_date FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Home - CampusConnect</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
body{
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    color:white;
    transition:0.3s;
}
.light-mode{
    background:#f5f7fa;
    color:#222;
}
.hero-section{
    padding:60px 0;
}
.glass-card{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(10px);
    border-radius:15px;
    border:1px solid rgba(255,255,255,0.1);
    transition:0.3s ease;
}
.glass-card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
}
.feature-btn{
    border-radius:30px;
    font-weight:500;
    padding:10px;
}
.stats-box h3{
    font-weight:bold;
}
.dropdown-menu{
background: rgba(255,255,255,0.08);
backdrop-filter: blur(10px);
border:1px solid rgba(255,255,255,0.1);
}
.dropdown-item{
color:white;
}
.dropdown-item:hover{
background: rgba(255,255,255,0.2);
color:white;
}
</style>
</head>

<body>

<?php include('navbar.php'); ?>

<div class="container hero-section text-center">
<h1>Welcome, <?php echo htmlspecialchars($user['fullname']); ?></h1>
    <p id="greeting" class="fs-5 text-light"></p>
    <p class="text-info">Connecting Students • Sharing Knowledge • Building Community</p>
</div>

<div class="container mb-5">

<!-- Quick Actions -->
<div class="row text-center mb-4">
    <div class="col-md-2 col-6 mb-3">
        <a href="academics.php" class="btn btn-primary w-100 feature-btn">
        <i class="bi bi-book"></i> Academics</a>
    </div>
    <div class="col-md-2 col-6 mb-3">
        <a href="community.php" class="btn btn-success w-100 feature-btn">
        <i class="bi bi-people"></i> Community</a>
    </div>
    <div class="col-md-2 col-6 mb-3">
        <a href="profile.php" class="btn btn-warning w-100 feature-btn">
        <i class="bi bi-person"></i> Profile</a>
    </div>
    <div class="col-md-2 col-6 mb-3">
        <a href="about.php" class="btn btn-danger w-100 feature-btn">
        <i class="bi bi-calendar-event"></i> About</a>
    </div>
    <div class="col-md-2 col-6 mb-3">
        <a href="help.php" class="btn btn-secondary w-100 feature-btn">
        <i class="bi bi-question-circle"></i> Help</a>
    </div>
</div>

<!-- Stats -->
<div class="row text-center mb-5">
    <div class="col-md-4 mb-3">
        <div class="glass-card p-4 stats-box">
            <h3><?php echo $upcomingEventsCount; ?></h3>
            <p>Upcoming Events</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="glass-card p-4 stats-box">
            <h3><?php echo $onlineMembers; ?></h3>
            <p>Community Members Online</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="glass-card p-4 stats-box">
            <?php
            $totalMaterials = $conn->query("SELECT COUNT(*) AS total FROM resources")->fetch_assoc()['total'] ?? 0;
            ?>
            <h3><?php echo $totalMaterials; ?></h3>
            <p>Study Materials</p>
        </div>
    </div>
</div>


<!-- Upcoming Events -->
<div class="glass-card p-4">
    <h4 class="fw-bold"><i class="bi bi-calendar-check"></i> Upcoming Events</h4>
    <?php
    if($upcomingEvents->num_rows > 0){
        while($row = $upcomingEvents->fetch_assoc()){
            echo "<p>📅 " . date('M d', strtotime($row['event_date'])) . " – " . htmlspecialchars($row['title']) . "</p>";
        }
    } else {
        echo "<p>No upcoming events</p>";
    }
    ?>
</div>
</div>

<script>
function updateGreeting(){
    const hour = new Date().getHours();
    let text = "Have a productive day!";
    if(hour < 12) text="Good Morning ";
    else if(hour < 18) text="Good Afternoon ";
    else text="Good Evening ";
    document.getElementById("greeting").innerText = text + " | " + new Date().toDateString();
}
updateGreeting();
</script>
</body>
</html>