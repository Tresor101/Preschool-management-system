<?php
// adminnavbar.php
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Brand removed as requested -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav" aria-controls="adminNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="dashboard_dark.php">🏠 Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="managementDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">🗂️ Management</a>
                    <ul class="dropdown-menu" aria-labelledby="managementDropdown">
                        <!--<li><a class="dropdown-item" href="student_registration.php">📝 Student Registration</a></li>
                        <li><a class="dropdown-item" href="manage_students.php">👨‍🎓 Manage Students</a></li>-->
                        <li><a class="dropdown-item" href="register_staff.php">🧑‍🏫 Register Staff</a></li>
                        <!--<li><a class="dropdown-item" href="register_teacher.php">🧑‍🏫 Register Teacher</a></li>
                        <li><a class="dropdown-item" href="teacher_management.php">👩‍🏫 Teacher Management</a></li>
                        <li><a class="dropdown-item" href="class_management.php">🏷️ Class Management</a></li>-->
                    </ul>
                </li>
                <!--<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="academicsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">📚 Academics</a>
                    <ul class="dropdown-menu" aria-labelledby="academicsDropdown">
                        <li><a class="dropdown-item" href="attendance.php">🕒 Attendance</a></li>
                        <li><a class="dropdown-item" href="grades_exams.php">📝 Grades / Exams</a></li>
                        <li><a class="dropdown-item" href="manage_subjects.php">📖 Manage Subjects / Modules</a></li>
                        <li><a class="dropdown-item" href="fees_payments.php">💵 Fees / Payments</a></li>
                        <li><a class="dropdown-item" href="timetable.php">📅 Timetable</a></li>
                    </ul>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="communicationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">💬 Communication</a>
                    <ul class="dropdown-menu" aria-labelledby="communicationDropdown">
                        <li><a class="dropdown-item" href="messages.php">✉️ Messages / Notifications</a></li>
                        <li><a class="dropdown-item" href="open_ticket.php">🛠️ Open Ticket (Tech Support)</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                        <a class="nav-link text-white" href="#">⚙️ Settings</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link text-white" href="#">📊 Reports</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link text-white" href="#">🚪 Logout</a>
                </li>-->
            </ul>
        </div>
    </div>
</nav>
