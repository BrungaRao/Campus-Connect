<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
include("config.php");

// Fetch clubs
$clubs = mysqli_query($conn, "SELECT * FROM clubs");
$joined_clubs_res = mysqli_query($conn, "SELECT club_id FROM club_members WHERE user_id=".$_SESSION['user_id']);
$joined_clubs = [];
while($jc = mysqli_fetch_assoc($joined_clubs_res)){
    $joined_clubs[] = $jc['club_id'];
}

// Fetch events
$events = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date ASC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Community - CampusConnect</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
body {
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364); 
    color:white; 
    font-family: Arial,sans-serif;
}
.glass-card {
    background: rgba(255,255,255,0.08); 
    backdrop-filter: blur(10px);   
    border-radius:15px; 
    padding:25px;
}
.stat-box {
    font-size: 32px; 
    font-weight:bold; 
    color:#00f2fe; 
    margin-bottom:5px;
}
.nav-tabs .nav-link {
    background: rgba(255,255,255,0.08); 
    border:none; color:white; 
    margin-right:8px; 
    border-radius:10px; 
    transition:0.3s;
}
.nav-tabs .nav-link:hover {
    background: rgba(255,255,255,0.2);
}
.nav-tabs .nav-link.active {
    background: rgba(255,255,255,0.25); 
    color:#00f2fe; 
    font-weight:bold;
}
.table-glass {
    width:100%; 
    border-collapse: separate; 
    border-spacing: 0; 
    background: rgba(255,255,255,0.05); 
    border-radius: 15px; 
    overflow:hidden; 
    font-size:14px; 
    text-align:center;
}
.table-glass thead th {
    background: rgba(255,255,255,0.12); 
    padding: 12px 10px; 
    font-weight:600; 
    color:white;
}
.table-glass tbody td {
    padding:14px 10px; 
    border-bottom:1px solid rgba(255,255,255,0.15); 
    vertical-align: middle; 
    color:white; 
    transition:0.2s;
}
.table-glass tbody tr:hover td {
    background: rgba(255,255,255,0.12); 
    cursor:pointer;
}
.table-glass tbody td:first-child {
    font-weight:bold; 
    background: rgba(255,255,255,0.08);
}
.badge {
    font-size:12px; 
    padding:4px 8px;
}
.break-col {
    background: rgba(0,0,0,0.2); 
    color:#00f2fe; 
    font-weight:bold;
}
.modal-content {
    background: rgba(255,255,255,0.08); 
    backdrop-filter: blur(10px); 
    border-radius:15px; 
    border:1px solid rgba(255,255,255,0.1); 
    color:white;
}
.modal-header, .modal-body, .modal-footer {
    border:none;
}
.glass-card .btn {
    background: rgba(255,255,255,0.1);
    color: white;
    border: 1px solid rgba(255,255,255,0.2);
    transition: 0.3s;
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

.glass-card .btn:hover {
    background: rgba(255,255,255,0.2);
    color: #00f2fe;
    border-color: #00f2fe;
}
.btn-success {
    background: #00f2fe !important;
    color: #0f2027 !important;
    border: none !important;
}
.list-group-item {
    background: rgba(255,255,255,0.08);
    color: white;
    border: none;
    margin-bottom: 5px;
    border-radius: 10px;
    transition: 0.3s;
}

.list-group-item:hover {
    background: rgba(255,255,255,0.15);
    color: #00f2fe;
}
.glass-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}
</style>

</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">

<h2 class="text-center mb-4">
<i class="bi bi-people-fill"></i> Student Community Hub
</h2>

<!-- TABS -->
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#clubs">Clubs</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#events">Events</button>
    </li>

</ul>

<div class="tab-content">

    <!-- CLUBS -->
    <div class="tab-pane fade show active" id="clubs">
        <div class="row">
            <?php while($c=mysqli_fetch_assoc($clubs)): 
                $joined = in_array($c['id'], $joined_clubs);
            ?>
            <div class="col-md-4 mb-3">
                <div class="glass-card p-3 text-center">
                    <h5><?php echo htmlspecialchars($c['name']); ?></h5>
                    <p><?php echo htmlspecialchars($c['description']); ?></p>
                    <button class="btn btn-sm <?php echo $joined ? 'btn-success' : 'btn-warning'; ?> join-btn"
                        data-club-id="<?php echo $c['id']; ?>"
                        <?php echo $joined ? 'disabled' : ''; ?>>
                        <?php echo $joined ? 'Joined ✓' : 'Join Club'; ?>
                    </button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- EVENTS -->
    <div class="tab-pane fade" id="events">
        <div class="row">

        <?php 
        $registered_events_res = mysqli_query($conn, "SELECT event_id FROM event_registrations WHERE student_id=".$_SESSION['user_id']);
        $registered_events = [];

        while($re = mysqli_fetch_assoc($registered_events_res)){
            $registered_events[] = $re['event_id'];
        }

        while($e=mysqli_fetch_assoc($events)){ 
            $registered = in_array($e['id'], $registered_events);
        ?>

        <div class="col-md-4 mb-3">
            <div class="glass-card p-3 text-center">
                <h5><?php echo htmlspecialchars($e['title']); ?></h5>

                <p class="mb-2">
                    <i class="bi bi-calendar"></i> <?php echo htmlspecialchars($e['event_date']); ?><br>
                    <i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($e['location']); ?>
                </p>

                <p><?php echo htmlspecialchars($e['description']); ?></p>

                <button class="btn btn-sm <?php echo $registered ? 'btn-success' : 'btn-primary'; ?> register-btn mt-2"
                    data-event-id="<?php echo $e['id']; ?>">
                    <?php echo $registered ? 'Registered ✓' : 'Register'; ?>
                </button>

            </div>
        </div>

        <?php } ?>

        </div>
    </div>

</div>

<!-- AJAX for Join Club -->
<script>
document.querySelectorAll(".join-btn").forEach(btn => {
    btn.addEventListener("click", function() {
        let clubId = this.getAttribute("data-club-id");
        let button = this;

        if(!button.innerText.includes("Joined")){
            fetch("join_clubs.php?club_id=" + clubId)
            .then(res => res.text())
            .then(data => {
                button.innerText = "Joined ✓";
                button.classList.remove("btn-warning");
                button.classList.add("btn-success");
                button.disabled = true; // disable after joining
            })
            .catch(err => console.log(err));
        }
    });
});

// AJAX for Register Event
document.querySelectorAll(".register-btn").forEach(btn => {
    btn.addEventListener("click", function() {
        let eventId = this.getAttribute("data-event-id");
        let button = this;

        if(!button.innerText.includes("Registered")){
            fetch("register_event.php?event_id=" + eventId)
            .then(res => res.text())
            .then(data => {
                button.innerText = "Registered ✓";
                button.classList.remove("btn-primary");
                button.classList.add("btn-success");
                button.disabled = true;
            })
            .catch(err => console.log(err));
        }
    });
});

</script>

</body>
</html>