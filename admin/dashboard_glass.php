<?php
session_start();
require_once 'db_connect.php';

// 🔐 Role Protection
if (!isset($_SESSION['role']) || $_SESSION['role'] != "Administration") {
    header("Location: login.php");
    exit();
}

// Get logged in user info
$user_name = $_SESSION['user_name'] ?? "Administrator";
$department = $_SESSION['department'] ?? "";

// 🔹 Example Dynamic Counts (adjust table names if needed)
$students_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM students"))['total'] ?? 0;
$classes_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM classes"))['total'] ?? 0;
$events_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM events"))['total'] ?? 0;
$users_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='Administration'"))['total'] ?? 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration Dashboard - 13ors College</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: linear-gradient(120deg, #f6d365 0%, #fda085 100%); }
        .glass-dashboard { max-width: 1100px; margin: 40px auto; background: rgba(255,255,255,0.85); border-radius: 32px; box-shadow: 0 8px 32px rgba(0,0,0,0.18); padding: 2.5rem 2rem; backdrop-filter: blur(8px); }
        .stat-card { border-radius: 18px; background: rgba(255,255,255,0.7); box-shadow: 0 2px 12px rgba(0,0,0,0.07); text-align: center; padding: 2rem 1rem; margin-bottom: 1.5rem; }
        .stat-icon { font-size: 2.5rem; margin-bottom: 0.5rem; }
        .quick-link { text-decoration: none; color: #ff6f61; font-weight: 500; }
        .quick-link:hover { text-decoration: underline; }
        .recent-activity { background: rgba(255,255,255,0.6); border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 1.5rem; }
    </style>
</head>

<body>

<?php include 'adminnavbar.php'; ?>

<div class="glass-dashboard">

    <!-- Header -->
    <h2 class="mb-2 text-center" style="color:#ff6f61;">
        🏫 13ors College - Administration Dashboard
    </h2>

    <p class="text-center text-muted mb-4">
        Welcome, <strong><?php echo htmlspecialchars($user_name); ?></strong> 
        (<?php echo htmlspecialchars($department); ?>)
    </p>

    <!-- Statistics -->
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">👨‍🎓</div>
                <div class="fs-5">Students</div>
                <div class="fs-3 fw-bold"><?php echo $students_count; ?></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">🏷️</div>
                <div class="fs-5">Classes</div>
                <div class="fs-3 fw-bold"><?php echo $classes_count; ?></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">🎉</div>
                <div class="fs-5">Events</div>
                <div class="fs-3 fw-bold"><?php echo $events_count; ?></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="fs-5">Admin Staff</div>
                <div class="fs-3 fw-bold"><?php echo $users_count; ?></div>
            </div>
        </div>

    </div>

    <!-- Quick Links (ADMIN FOCUSED ONLY) -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="recent-activity mb-4">
                <h5 class="mb-3" style="color:#ff6f61;">Administrative Actions</h5>

                <a class="quick-link d-block mb-2" href="student_registration.php">📝 Register Student</a>
                <a class="quick-link d-block mb-2" href="manage_students.php">👨‍🎓 Manage Students</a>
                <a class="quick-link d-block mb-2" href="manage_classes.php">🏷️ Manage Classes</a>
                <a class="quick-link d-block mb-2" href="events.php">🎉 Manage Events</a>
                <a class="quick-link d-block mb-2" href="finance.php">💰 Finance / Bursar</a>
                <a class="quick-link d-block mb-2" href="discipline.php">⚖️ Discipline Records</a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="recent-activity mb-4">
                <h5 class="mb-3" style="color:#ff6f61;">System</h5>

                <a class="quick-link d-block mb-2" href="profile.php">👤 My Profile</a>
                <a class="quick-link d-block mb-2 text-danger" href="logout.php">🚪 Logout</a>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>