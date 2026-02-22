<?php
require_once 'db_connect.php';

// Get staff count
$staff_count = 0;
$result = $conn->query("SELECT COUNT(*) AS count FROM staff");
if ($result && $row = $result->fetch_assoc()) {
    $staff_count = $row['count'];
}

// For now, set students and classes to 0
$student_count = 0;
$class_count = 0;

// Count teachers from staff table (role = 'Teacher')
$teacher_count = 0;
$result = $conn->query("SELECT COUNT(*) AS count FROM staff WHERE role = 'Teacher'");
if ($result && $row = $result->fetch_assoc()) {
    $teacher_count = $row['count'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - 13ors College</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #181a1b; color: #f8f9fa; }
        .dashboard-dark { max-width: 1100px; margin: 40px auto; background: #23272b; border-radius: 32px; box-shadow: 0 8px 32px rgba(0,0,0,0.32); padding: 2.5rem 2rem; }
        .stat-card { border-radius: 18px; background: #343a40; box-shadow: 0 2px 12px rgba(0,0,0,0.12); text-align: center; padding: 2rem 1rem; margin-bottom: 1.5rem; color: #ffc107; }
        .stat-icon { font-size: 2.5rem; margin-bottom: 0.5rem; }
        .quick-link { text-decoration: none; color: #ffc107; font-weight: 500; }
        .quick-link:hover { text-decoration: underline; color: #fffbe7; }
        .recent-activity { background: #23272b; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.10); padding: 1.5rem; }
        .dashboard-title { color: #ffc107; }
    </style>
</head>
<body>
    <?php include 'adminnavbar.php'; ?>
    <div class="dashboard-dark">
        <h2 class="mb-4 text-center dashboard-title">🏫 13ors College Dashboard</h2>
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">👨‍🎓</div>
                        <div class="fs-5">Students</div>
                        <div class="fs-3 fw-bold"><?php echo $student_count; ?></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">🧑‍💼</div>
                        <div class="fs-5">Staff</div>
                        <div class="fs-3 fw-bold"><?php echo $staff_count; ?></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">🏷️</div>
                        <div class="fs-5">Classes</div>
                        <div class="fs-3 fw-bold"><?php echo $class_count; ?></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">👩‍🏫</div>
                        <div class="fs-5">Teachers</div>
                        <div class="fs-3 fw-bold"><?php echo $teacher_count; ?></div>
                    </div>
                </div>
            </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="recent-activity mb-4">
                    <h5 class="mb-3" style="color:#ffc107;">Recent Activity</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent text-light">Student <b>John Doe</b> registered. <span class="text-muted small">2 hours ago</span></li>
                        <li class="list-group-item bg-transparent text-light">Class <b>P3A</b> updated. <span class="text-muted small">5 hours ago</span></li>
                        <li class="list-group-item bg-transparent text-light">Event <b>Science Fair</b> added. <span class="text-muted small">1 day ago</span></li>
                        <li class="list-group-item bg-transparent text-light">Teacher <b>Ms. Smith</b> assigned to <b>P4A</b>. <span class="text-muted small">2 days ago</span></li>
                        <li class="list-group-item bg-transparent text-light">Student <b>Jane Smith</b> transferred. <span class="text-muted small">3 days ago</span></li>
                        <li class="list-group-item bg-transparent text-light">Exam <b>Midterm</b> scheduled. <span class="text-muted small">4 days ago</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="recent-activity mb-4">
                    <h5 class="mb-3" style="color:#ffc107;">Quick Links</h5>
                    <a class="quick-link d-block mb-2" href="student_registration.php">📝 Register a Student</a>
                    <a class="quick-link d-block mb-2" href="manage_students.php">👨‍🎓 Manage Students</a>
                    <a class="quick-link d-block mb-2" href="#">👩‍🏫 Manage Teachers</a>
                    <a class="quick-link d-block mb-2" href="#">🏷️ Manage Classes</a>
                    <a class="quick-link d-block mb-2" href="#">📅 Timetable</a>
                    <a class="quick-link d-block mb-2" href="#">🎉 Events / Calendar</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
