<?php 
session_start(); 
include("config.php"); 

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id'])) exit('Not logged in');
$user_id = $_SESSION['user_id']; 
$res = mysqli_query($conn, "SELECT role FROM users WHERE id=$user_id");
$role = mysqli_fetch_assoc($res)['role']; 
if ($role !== 'admin') exit('Access denied'); 

// Fetch club notifications grouped by club name
$club_notifications = mysqli_query($conn, " 
    SELECT an.*, u.fullname, c.name AS club_name 
    FROM admin_notifications an 
    LEFT JOIN users u ON u.id = an.user_id 
    LEFT JOIN clubs c ON (an.action = 'joined_club' AND an.reference_id = c.id) 
    WHERE an.action = 'joined_club' 
    ORDER BY c.name, an.created_at DESC 
");

// Fetch event notifications grouped by event title
$event_notifications = mysqli_query($conn, " 
    SELECT an.*, u.fullname, e.title AS event_title 
    FROM admin_notifications an 
    LEFT JOIN users u ON u.id = an.user_id 
    LEFT JOIN events e ON (an.action = 'registered_event' AND an.reference_id = e.id) 
    WHERE an.action = 'registered_event' 
    ORDER BY e.title, an.created_at DESC 
"); 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); 
            color: white; 
            transition: 0.3s; 
        }
        .hero-section { padding: 60px 0; }
        .glass-card { 
            background: rgba(255, 255, 255, 0.08); 
            backdrop-filter: blur(10px); 
            border-radius: 15px; 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            transition: 0.3s ease; 
            padding: 15px; 
        }
        .glass-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3); 
        }
        .notification-header { 
            font-size: 1.5rem; 
            margin-bottom: 20px; 
            color: #00f2fe; 
            text-decoration: underline; 
        }
        .notification-subheader { 
            font-size: 1.2rem; 
            margin-top: 20px; 
            margin-bottom: 10px; 
        }
        .notification-empty { 
            font-size: 1.1rem; 
            color: #bbb; 
        }
        .notification-table th, .notification-table td { 
            vertical-align: middle; 
            text-align: center; 
            padding: 8px 12px; /* Adjust padding for smaller table */
            font-size: 0.9rem; /* Smaller font size */
        }
        .notification-table th { 
            background-color: rgba(255, 255, 255, 0.1); 
            color: white; 
            font-weight: bold; 
        }
        .notification-table td { 
            background-color: rgba(255, 255, 255, 0.08); 
            color: white; 
        }
        .notification-table tbody tr:hover { 
            background-color: rgba(255, 255, 255, 0.12); 
        }
        /* Add more space between the columns */
        .column {
            margin-bottom: 30px;
        }
        .section-spacing {
            margin-right: 30px; /* Adds space between the columns */
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <div class="hero-section text-center">
            <h2>Admin Notifications</h2>
        </div>

        <!-- Display Content Based on Section -->
        <div class="row justify-content-center">
            <!-- Club Notifications Section -->
            <div class="col-md-5 column section-spacing">
                <h4 class="text-center text-light notification-header">Club Notifications</h4>
                <?php 
                if (mysqli_num_rows($club_notifications) > 0): 
                    $current_club = '';
                    while ($n = mysqli_fetch_assoc($club_notifications)):
                        if ($current_club !== $n['club_name']):
                            if ($current_club !== '') { 
                                echo '</tbody></table>'; 
                            }
                            $current_club = $n['club_name'];
                            echo '<h5>' . htmlspecialchars($current_club) . '</h5>';
                            echo '<table class="table table-bordered notification-table">';
                            echo '<thead><tr><th>User</th></tr></thead><tbody>'; // Only "User" column
                        endif;

                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($n['fullname']) . '</td>'; // Display user name only
                        echo '</tr>';
                    endwhile;
                    echo '</tbody></table>';
                else:
                    echo '<p class="notification-empty text-center">No club notifications found.</p>';
                endif; ?>
            </div>

            <!-- Event Notifications Section -->
            <div class="col-md-5 column">
                <h4 class="text-center text-light notification-header">Event Notifications</h4>
                <?php 
                if (mysqli_num_rows($event_notifications) > 0): 
                    $current_event = '';
                    while ($n = mysqli_fetch_assoc($event_notifications)):
                        if ($current_event !== $n['event_title']):
                            if ($current_event !== '') { 
                                echo '</tbody></table>'; 
                            }
                            $current_event = $n['event_title'];
                            echo '<h5>' . htmlspecialchars($current_event) . '</h5>';
                            echo '<table class="table table-bordered notification-table">';
                        endif;

                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($n['fullname']) . '</td>';
                        echo '</tr>';
                    endwhile;
                    echo '</tbody></table>';
                else:
                    echo '<p class="notification-empty text-center">No event notifications found.</p>';
                endif;
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>