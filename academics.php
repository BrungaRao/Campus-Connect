<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
include("config.php");

$user_id = $_SESSION['user_id'];

/* Fetch courses */
$courses = mysqli_query($conn, "SELECT * FROM courses ORDER BY course_name ASC");

/* Fetch assignments */
$assignments = mysqli_query($conn, "SELECT * FROM assignments ORDER BY due_date ASC");

/* Fetch submitted assignments */
$submitted_ids = [];
$sub_query = mysqli_query($conn, "SELECT assignment_id FROM assignment_submissions WHERE student_id=$user_id");
while($row = mysqli_fetch_assoc($sub_query)){
    $submitted_ids[] = $row['assignment_id'];
}

// Fetch resources
$resources = mysqli_query($conn, "SELECT * FROM resources ORDER BY id DESC");

/* Fetch results */
$results = mysqli_query($conn, "SELECT * FROM results WHERE student_id=$user_id ORDER BY exam_date DESC");

/* Fetch timetable */
$timetable = [];
$tt_query = mysqli_query($conn, "SELECT * FROM timetable ORDER BY FIELD(day,'Monday','Tuesday','Wednesday','Thursday','Friday'), period ASC");
while($row = mysqli_fetch_assoc($tt_query)){
    $timetable[$row['day']][$row['period']] = $row;
}

/* Period timings */
$start_time = strtotime("09:00 AM");
$periods = [];
for($p=1;$p<=6;$p++){
    $periods[$p] = [];
    $periods[$p]['start'] = $start_time;
    $periods[$p]['end'] = strtotime("+1 hour", $start_time);

    if($p==2) $start_time = strtotime("+15 minutes", $periods[$p]['end']);  // 15-min break
    elseif($p==4) $start_time = strtotime("+45 minutes", $periods[$p]['end']); // 45-min lunch
    else $start_time = $periods[$p]['end'];
}

function format12($time){ return date("g:i A", $time); }

$days = ['Monday','Tuesday','Wednesday','Thursday','Friday'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Academics - CampusConnect</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
/* ===== Base Page Style (from index.php) ===== */
body {
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    color: white;
    font-family: 'Poppins', Arial, sans-serif;
    transition: 0.3s;
}
h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', Arial, sans-serif; font-weight:600; }

/* Glass cards */
.glass-card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    transition: 0.3s;
}
.glass-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

/* Stat boxes */
.stat-box {
    font-size: 2rem;
    font-weight: bold;
    color: #00f2fe;
}

/* Tabs */
.nav-tabs .nav-link {
    background: rgba(255,255,255,0.08);
    border:none;
    color:white;
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

/* Tables */
.table-glass {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: rgba(255,255,255,0.05);
    border-radius: 15px;
    overflow: hidden;
    font-size: 14px;
    text-align: center;
}
.table-glass th {
    background: rgba(255,255,255,0.12);
    padding: 12px 10px;
    font-weight: 600;
    color: white;
}
.table-glass tbody td:first-child {
    padding: 14px 10px;
    font-weight: bold;
    border-bottom: 1px solid rgba(255,255,255,0.15);
    color:white;
}
.table-glass tr:hover td { 
    background: rgba(255,255,255,0.12); 
    cursor:pointer; 
}
.break-col { 
    background: rgba(0,0,0,0.2); 
    color: #ffffffff; 
    font-weight:bold; }

/* Buttons */
.btn, .feature-btn {
    font-family: 'Poppins', Arial, sans-serif;
    border-radius: 30px;
    padding: 8px 20px;
    transition:0.3s;
}
.btn-primary, .btn-sm.btn-primary {
    background: rgba(255,255,255,0.1);
    color: #00f2fe;
    border: 1px solid rgba(0,242,254,0.3);
    border-radius: 8px;
    transition: 0.3s;
}
.btn-primary:hover, .btn-sm.btn-primary:hover {
    background: rgba(255,255,255,0.2);
    color: #0f2027;
}

.btn:hover { opacity:0.9; }

/* Modals */
.modal-content { 
    background: rgba(255,255,255,0.08); 
    backdrop-filter: blur(12px); 
    border-radius: 15px; 
    border:1px solid rgba(255,255,255,0.1); 
    color:white;
}
.modal-header, .modal-body, .modal-footer { border:none; }

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

/* List groups */
.list-group-item {
    background: rgba(255,255,255,0.08);
    color:white;
    border:none;
    margin-bottom:5px;
    border-radius:10px;
    transition:0.3s;
}
.list-group-item:hover { background: rgba(0,242,254,0.15); color:#00f2fe; }

</style>
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
<h2 class="text-center mb-4"><i class="bi bi-journal-bookmark-fill"></i> Academic Dashboard</h2>

<!-- STATISTICS -->
<div class="row text-center mb-4">
    <div class="col-md-4">
        <div class="glass-card">
            <div id="totalCourses" class="stat-box" style="cursor:pointer;" title="Click to view all courses">
                <?php echo mysqli_num_rows($courses); ?>
            </div>
            <p>Total Courses</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card">
            <div class="stat-box"><?php echo mysqli_num_rows($assignments); ?></div>
            <p>Total Assignments</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card">
            <div class="stat-box"><?php echo mysqli_num_rows($resources); ?></div>
            <p>Total Resources</p>
        </div>
    </div>
</div>

<!-- COURSES MODAL -->
<div class="modal fade" id="coursesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <h5>All Courses</h5>
            <div class="table-responsive mt-3">
                <table class="table-glass">
                    <thead>
                        <tr><th>Course Name</th><th>Instructor</th></tr>
                    </thead>
                    <tbody>
                    <?php
                    $courses_modal = mysqli_query($conn, "SELECT * FROM courses ORDER BY course_name ASC");
                    while($c = mysqli_fetch_assoc($courses_modal)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($c['course_name']); ?></td>
                            <td><?php echo htmlspecialchars($c['instructor']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-light mt-3" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<!-- TABS -->
<ul class="nav nav-tabs mb-3">
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#timetable">Timetable</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#assignments">Assignments</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#resources">Resources</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#results">Results</button></li>
</ul>

<div class="tab-content">
<!-- TIMETABLE -->
<div class="tab-pane fade show active" id="timetable">
    <div class="glass-card table-responsive">
        <table class="table-glass">
            <thead>
                <tr>
                    <th>Day / Period</th>
                    <th>1</th>
                    <th>2</th>
                    <th class="break-col">Short Break</th>
                    <th>3</th>
                    <th>4</th>
                    <th class="break-col">Lunch Break</th>
                    <th>5</th>
                    <th>6</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($days as $day){
                echo "<tr><td>$day</td>";
                for($p=1;$p<=6;$p++){
                    if(isset($timetable[$day][$p])){
                        $sub = $timetable[$day][$p];
                        $sub['start_time'] = format12($periods[$p]['start']);
                        $sub['end_time'] = format12($periods[$p]['end']);
                        echo "<td class='tt-period' data-sub='".htmlspecialchars(json_encode($sub),ENT_QUOTES)."'>".$sub['subject']."</td>";
                    } else echo "<td>-</td>";
                    if($p==2) echo "<td class='break-col'>15 min</td>";
                    if($p==4) echo "<td class='break-col'>45 min</td>";
                }
                echo "</tr>";
            } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ASSIGNMENTS TAB -->
<div class="tab-pane fade" id="assignments">
    <div class="glass-card table-responsive">
        <table class="table-glass">
            <thead><tr><th>Title</th><th>Due Date</th><th>Status / Action</th></tr></thead>
            <tbody>
            <?php while($a = mysqli_fetch_assoc($assignments)):
                $submitted = in_array($a['id'],$submitted_ids);
                $due = strtotime($a['due_date']);
                $days_left = ceil(($due - time())/(60*60*24));
            ?>
            <tr>
                <td><?php echo htmlspecialchars($a['title']); ?></td>
                <td>
                    <?php echo $a['due_date']; ?>
                    <?php if(!$submitted && $days_left >= 0){ ?>
                        <span class="badge bg-info"><?php echo $days_left; ?> days left</span>
                    <?php } ?>
                </td>
               <td>
<?php if($submitted): ?>
    <span class='badge bg-success'>Submitted</span>
<?php elseif($days_left < 0): ?>
    <span class='badge bg-secondary'>Past Due</span>
<?php else: ?>
    <div class="d-flex flex-column align-items-center">
        <input type="file" name="assignment_file" accept="application/pdf" required class="form-control form-control-sm mb-1" style="width:150px;" data-assignment="<?php echo $a['id']; ?>">
        <button class="btn btn-sm btn-primary submit-assignment" data-assignment="<?php echo $a['id']; ?>">Submit</button>
        <small class="mt-1 text-light message" style="font-size:0.85em;"></small>
    </div>
<?php endif; ?>
</td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- RESOURCES TAB -->
<div class="tab-pane fade" id="resources">
    <div class="row">
        <?php while($r = mysqli_fetch_assoc($resources)): ?>
            <div class="col-md-4 mb-3">
                <div class="glass-card text-center p-3">
                    <h5><?php echo htmlspecialchars($r['title']); ?></h5>
                    <a href="<?php echo htmlspecialchars($r['file']); ?>" target="_blank" class="btn btn-sm btn-primary mt-2">📄 Download PDF</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- RESULTS TAB -->
<div class="tab-pane fade" id="results">
    <div class="glass-card text-center p-4">
        <h5 style="color: #00f2fe;">Results will be published soon</h5>
        <p>Please check back later for your exam results.</p>
    </div>
</div>

</div>

<!-- MODAL FOR PERIOD DETAILS -->
<div class="modal fade" id="periodModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <h5 id="modal-subject"></h5>
            <p id="modal-instructor"></p>
            <p id="modal-room"></p>
            <p id="modal-time"></p>
            <button type="button" class="btn btn-light mt-2" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('totalCourses').addEventListener('click', () => {
    new bootstrap.Modal(document.getElementById('coursesModal')).show();
});

document.querySelectorAll('.tt-period').forEach(td=>{
    td.addEventListener('click',()=>{
        let data = JSON.parse(td.getAttribute('data-sub'));
        document.getElementById('modal-subject').innerText = "Subject: "+data.subject;
        document.getElementById('modal-instructor').innerText = "Instructor: "+data.instructor;
        document.getElementById('modal-room').innerText = "Room: "+data.room;
        document.getElementById('modal-time').innerText = "Time: "+data.start_time+" - "+data.end_time;
        new bootstrap.Modal(document.getElementById('periodModal')).show();
    });
});
</script>

<script>
document.querySelectorAll(".submit-assignment").forEach(button => {
    button.addEventListener("click", function(e){
        e.preventDefault();

        const assignment_id = this.dataset.assignment;
        const container = this.parentElement; // the div containing input + button + message
        const fileInput = container.querySelector('input[type="file"]');
        const message = container.querySelector(".message");

        if(fileInput.files.length === 0){
            message.textContent = "Please select a PDF file.";
            message.style.color = "red";
            return;
        }

        const formData = new FormData();
        formData.append("assignment_id", assignment_id);
        formData.append("pdf_file", fileInput.files[0]);
        formData.append("ajax_upload", 1);

        fetch("submit_assignment.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            if(data.toLowerCase().includes("successfully")){
                // Replace entire input/button container with "Submitted" badge
                container.innerHTML = '<span class="badge bg-success">Submitted</span>';
            } else {
                message.textContent = data;
                message.style.color = "red";
            }
        })
        .catch(err => {
            message.textContent = "Upload failed.";
            message.style.color = "red";
        });
    });
});
</script>

</body>
</html>