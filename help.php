<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Help & Support - CampusConnect</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
body {
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    color: white;
    font-family: 'Arial', sans-serif;
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
    margin-bottom: 25px;
    transition: 0.3s ease;
    border:1px solid rgba(255,255,255,0.1);
}

.glass-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

.icon-large {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #00f2fe;
}

.accordion-button {
    background: rgba(255,255,255,0.08);
    color: white;
    font-weight: 500;
}

.accordion-body {
    color: white;
}

.accordion-button:not(.collapsed) {
    background: rgba(255,255,255,0.15);
    color: #00f2fe;
}

.form-control, textarea {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1);
    color: white;
}

.form-control::placeholder, textarea::placeholder {
    color: #ddd;
}

.btn-light {
    background: rgba(255,255,255,0.1);
    color: #00f2fe;
    border: 1px solid rgba(255,255,255,0.2);
    transition:0.3s;
}

.btn-light:hover {
    background: rgba(255,255,255,0.2);
    color: #0f2027;
    border-color: #00f2fe;
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

.text-info {
    color: #00f2fe !important;
}
</style>
</head>

<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">

    <!-- Hero Section -->
    <div class="hero">
        <h1 class="fw-bold"><i class="bi bi-life-preserver"></i> Help & Support</h1>
        <p class="fs-5 text-info">We're here to help you succeed at CampusConnect</p>
    </div>

    <!-- Quick Help Categories -->
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <div class="glass-card">
                <i class="bi bi-person-lock icon-large"></i>
                <h5>Account Issues</h5>
                <p>Password reset, profile updates, login help</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card">
                <i class="bi bi-journal-check icon-large"></i>
                <h5>Assignments</h5>
                <p>Submitting work, checking deadlines, grades</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card">
                <i class="bi bi-people icon-large"></i>
                <h5>Community</h5>
                <p>Joining clubs, posting topics, events</p>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <h3 class="text-center mb-3 text-info">Frequently Asked Questions</h3>

    <div class="accordion mb-5" id="faqAccordion">

        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq1">
                    How do I reset my password?
                </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Contact support@campusconnect.com for password reset assistance.
                </div>
            </div>
        </div>

        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">
                    How do I submit an assignment?
                </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Visit the Academics section → Assignments → Upload File → Click Submit.
                </div>
            </div>
        </div>

        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">
                    How do I join a club or event?
                </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Navigate to Community → Clubs or Events → Click Join/Register.
                </div>
            </div>
        </div>

        <!-- New FAQ Items -->
<div class="accordion-item bg-transparent border-0 faq-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq4">
            How can I update my profile information?
        </button>
    </h2>
    <div id="faq4" class="accordion-collapse collapse">
        <div class="accordion-body">
            Go to Profile → Edit Profile to update your personal details, profile picture, and preferences → Update Profile
        </div>
    </div>
</div>

<div class="accordion-item bg-transparent border-0 faq-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq5">
            How do I track upcoming campus events?
        </button>
    </h2>
    <div id="faq5" class="accordion-collapse collapse">
        <div class="accordion-body">
            Navigate to the Events section on the homepage.
        </div>
    </div>
</div>

<div class="accordion-item bg-transparent border-0 faq-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq6">
            Can I submit multiple assignments for the same course?
        </button>
    </h2>
    <div id="faq6" class="accordion-collapse collapse">
        <div class="accordion-body">
            Only one submission per assignment is allowed. 
        </div>
    </div>
</div>

<div class="accordion-item bg-transparent border-0 faq-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq9">
            How do I download study materials or resources?
        </button>
    </h2>
    <div id="faq9" class="accordion-collapse collapse">
        <div class="accordion-body">
            Go to Academics → Resources, select the file you need, and click the “Download PDF” button.
        </div>
    </div>
</div>

    </div>

    <!-- Contact Info -->
    <div class="glass-card text-center mb-5">
        <h3 class="text-center mb-3 text-info">Contact Support</h3>
        <p><i class="bi bi-envelope"></i> support@campusconnect.com</p>
        <p><i class="bi bi-telephone"></i> +1 234 567 890</p>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>