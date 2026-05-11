<?php
session_start();
include("config.php");

// Only admin can access
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit();
}

// Fetch users securely including profile_pic
$stmt = $conn->prepare("SELECT id, fullname, email, department, year, role, phone, dob, profile_pic FROM users ORDER BY id ASC");
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Users - CampusConnect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
            color: white;
            font-family: Arial,sans-serif;
        }

        h2 {
            color: #00f2fe;
            text-align: center;
            margin-bottom: 30px;
        }

        .glass-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(12px);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            transition: 0.3s;
        }

        .glass-card:hover {
            transform: translateY(-4px);
        }

        /* Profile Thumbnail */
        .profile-thumb {
            width: 50px;
            height: 50px;
            object-fit: fill;
            display: block;
            margin: 0 auto;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255,255,255,0.08);
        }

        table thead th {
            background: rgba(0,242,254,0.1);
            color: #00f2fe;
            border-bottom: 2px solid #00f2fe;
            padding: 12px;
            text-align: center;
        }

        table tbody td {
            padding: 10px;
            color: #e0f7ff;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        table tbody tr:hover {
            background: rgba(0,242,254,0.1);
        }

        .no-users {
            text-align: center;
            padding: 15px;
            color: #f0f0f0;
        }

        /* Responsive */
        @media(max-width: 768px){
            table thead {
                display: none;
            }
            table, table tbody, table tr, table td {
                display: block;
                width: 100%;
            }
            table tr {
                margin-bottom: 15px;
            }
            table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            table td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                text-align: left;
                font-weight: bold;
                color: #00f2fe;
            }
        }
    </style>
</head>
<body>
<?php include('navbar.php'); ?>

<div class="container mt-5 glass-card">
    <h2>Registered Users</h2>
    <table>
        <thead>
            <tr>
                <th>Profile</th>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Year</th>
                <th>Role</th>
                <th>Mobile Number</th>
                <th>Date of Birth</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($users)): ?>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td data-label="Profile">
                            <?php if(!empty($user['profile_pic']) && file_exists($user['profile_pic'])): ?>
                                <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" class="profile-thumb" alt="Profile Picture">
                            <?php else: ?>
                                <img src="assets/default-avatar.png" class="profile-thumb" alt="No Picture">
                            <?php endif; ?>
                        </td>
                        <td data-label="ID"><?php echo htmlspecialchars($user['id']); ?></td>
                        <td data-label="Full Name"><?php echo htmlspecialchars($user['fullname']); ?></td>
                        <td data-label="Email"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td data-label="Department"><?php echo htmlspecialchars($user['department']); ?></td>
                        <td data-label="Year"><?php echo htmlspecialchars($user['year']); ?></td>
                        <td data-label="Role"><?php echo htmlspecialchars($user['role']); ?></td>
                        <td data-label="Mobile Number"><?php echo htmlspecialchars($user['phone']); ?></td>
                        <td data-label="Date of Birth"><?php echo htmlspecialchars($user['dob']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="no-users">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
