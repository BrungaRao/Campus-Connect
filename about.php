<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>About - CampusConnect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
body {
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    color: white;
}

.hero {
    text-align: center;
    padding: 60px 20px;
}

.glass-card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 25px;
    transition: 0.3s;
    height: 100%;
}

.glass-card:hover {
    transform: translateY(-5px);
}

.icon-large {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #00f2fe;
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

.counter {
    font-size: 2rem;
    font-weight: bold;
    color: #00f2fe;
}
</style>
</head>

<body>

<?php include('navbar.php'); ?>

<div class="container">

    <!-- Hero Section -->
    <div class="hero">
        <h1 class="fw-bold">About CampusConnect</h1>
        <p class="lead text-light">Connecting Students • Sharing Knowledge • Building Community</p>
        <p class="mt-3">“Learn. Connect. Grow.”</p>
    </div>

    <!-- Mission & Vision -->
    <div class="row mb-5">
        <div class="col-md-6 mb-3">
            <div class="glass-card text-center">
                <i class="bi bi-bullseye icon-large"></i>
                <h4>Our Mission</h4>
                <p>Empowering students through collaboration, academic tools, and community-driven engagement.</p>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="glass-card text-center">
                <i class="bi bi-lightbulb icon-large"></i>
                <h4>Our Vision</h4>
                <p>To create a unified digital ecosystem where every student can thrive academically and socially.</p>
            </div>
        </div>
    </div>

    <!-- Features -->
    <h3 class="text-center mb-4">Why CampusConnect?</h3>

    <div class="row mb-5">

        <div class="col-md-4 mb-3">
            <div class="glass-card text-center">
                <i class="bi bi-calendar-event icon-large"></i>
                <h5>Event Management</h5>
                <p>Stay updated with campus activities and workshops.</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="glass-card text-center">
                <i class="bi bi-people icon-large"></i>
                <h5>Clubs & Communities</h5>
                <p>Join clubs and collaborate with like-minded peers.</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
        <div class="glass-card text-center">
            <i class="bi bi-journal-text icon-large"></i>
            <h5>Academic Resources</h5>
            <p>Access notes, assignments, and study materials easily.</p>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <div class="counter" data-target="400">0</div>
            <p>Active Students</p>
        </div>
        <div class="col-md-4">
            <div class="counter" data-target="15">0</div>
            <p>Events Hosted</p>
        </div>
            <div class="col-md-4">
        <div class="counter" data-target="10">0</div>
        <p>Clubs & Societies</p>
    </div>
    </div>

    <!-- Reviews -->
    <h3 class="text-center mb-4">Student Reviews</h3>

    <div class="glass-card mb-3">
        ⭐⭐⭐⭐⭐  
        <p>“CampusConnect is a game-changer for student life!” – Jane Doe</p>
    </div>

    <div class="glass-card mb-5">
        ⭐⭐⭐⭐⭐  
        <p>“I can track assignments and participate in forums easily.” – John Smith</p>
    </div>

    <!-- Contact -->
    <div class="glass-card text-center mb-5">
        <h4>Contact Us</h4>
        <p><i class="bi bi-envelope"></i> support@campusconnect.com</p>
        <p><i class="bi bi-telephone"></i> +1 234 567 890</p>
    </div>

</div>

<script>
const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {
    counter.innerText = '0';
    const updateCounter = () => {
        const target = +counter.getAttribute('data-target');
        const current = +counter.innerText;
        const increment = target / 100;

        if(current < target){
            counter.innerText = Math.ceil(current + increment);
            setTimeout(updateCounter, 20);
        } else {
            counter.innerText = target;
        }
    };
    updateCounter();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
