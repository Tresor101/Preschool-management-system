<?php
// dashboard_teacher.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0e7ff 0%, #f1f5f9 100%);
        }
        .dashboard-card {
            border-radius: 1rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            transition: transform 0.1s;
        }
        .dashboard-card:hover {
            transform: translateY(-4px) scale(1.02);
        }
        .dashboard-icon {
            font-size: 2.5rem;
        }
        .quick-link {
            text-decoration: none;
            color: #212529;
        }
        .quick-link:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <?php include 'teachernavbar.php'; ?>
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2 class="mb-2">Welcome back, <span class="text-primary">Jane Smith</span>!</h2>
                <div class="mb-3 text-muted">Science Department | ID: T2023123</div>
                <div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
                    <span class="me-2">⚠️</span>
                    <div>You have 2 assignments to review and 1 attendance not marked today.</div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card dashboard-card text-center p-3 h-100">
                    <div class="dashboard-icon mb-2">🕒</div>
                    <h6>Mark Attendance</h6>
                    <a href="attendance.php" class="quick-link">Go</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card text-center p-3 h-100">
                    <div class="dashboard-icon mb-2">📝</div>
                    <h6>Enter Grades</h6>
                    <a href="grades_exams.php" class="quick-link">Go</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card text-center p-3 h-100">
                    <div class="dashboard-icon mb-2">💬</div>
                    <h6>Messages</h6>
                    <a href="messages.php" class="quick-link">Inbox</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card text-center p-3 h-100">
                    <div class="dashboard-icon mb-2">📅</div>
                    <h6>Timetable</h6>
                    <a href="timetable.php" class="quick-link">View</a>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card dashboard-card p-3 h-100">
                    <h5 class="mb-3">My Classes</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Grade 10A <span><a href="#" class="btn btn-sm btn-outline-primary">Manage</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Grade 11B <span><a href="#" class="btn btn-sm btn-outline-primary">Manage</a></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card dashboard-card p-3 h-100">
                    <h5 class="mb-3">Upcoming Events</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Parent-Teacher Meeting - Feb 20, 2026</li>
                        <li class="list-group-item">Science Fair - Mar 5, 2026</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card dashboard-card p-3 h-100">
                    <h5 class="mb-3">Recent Messages</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Reminder: Submit grades by Feb 18</li>
                        <li class="list-group-item">Staff meeting at 3:00 PM today</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
