<!-- Responsive Sidebar for Teacher Portal -->
<style>
.teacher-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 230px;
    background: linear-gradient(180deg, #2563eb 0%, #1e40af 100%);
    color: #fff;
    z-index: 1040;
    transition: transform 0.3s ease;
    box-shadow: 2px 0 12px rgba(30,64,175,0.10);
}
.teacher-sidebar .sidebar-header {
    font-size: 1.3rem;
    font-weight: 600;
    padding: 1.2rem 1.5rem 1rem 1.5rem;
    border-bottom: 1px solid #334155;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.teacher-sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.teacher-sidebar li {
    width: 100%;
}
.teacher-sidebar a {
    display: flex;
    align-items: center;
    gap: 0.7rem;
    color: #fff;
    text-decoration: none;
    padding: 0.85rem 1.5rem;
    font-size: 1.05rem;
    transition: background 0.15s;
}
.teacher-sidebar a:hover, .teacher-sidebar .active {
    background: #1e293b;
    color: #60a5fa;
}
.teacher-sidebar .sidebar-profile {
    margin-top: auto;
    padding: 1.2rem 1.5rem 1.5rem 1.5rem;
    border-top: 1px solid #334155;
}
.teacher-sidebar .badge {
    margin-left: auto;
}
@media (max-width: 991.98px) {
    .teacher-sidebar {
        transform: translateX(-100%);
    }
    .teacher-sidebar.show {
        transform: translateX(0);
    }
    .sidebar-backdrop {
        display: block;
        position: fixed;
        top: 0; left: 0; width: 100vw; height: 100vh;
        background: rgba(30,40,60,0.3);
        z-index: 1039;
    }
}
@media (min-width: 992px) {
    .teacher-sidebar { transform: none; }
    .sidebar-backdrop { display: none !important; }
    body { margin-left: 230px !important; }
}
</style>
<div class="teacher-sidebar" id="teacherSidebar">
    <div class="sidebar-header">
        <span style="font-size:1.5em;">👩‍🏫</span> Teacher Portal
    </div>
    <ul>
        <li><a href="dashboard_teacher.php"><span>🏠</span> Dashboard</a></li>
        <li><a href="#"><span>🕒</span> Attendance</a></li>
        <li><a href="#"><span>📝</span> Grades</a></li>
        <li><a href="#"><span>📅</span> Timetable</a></li>
        <li><a href="#" class="d-flex align-items-center"><span>💬</span> Messages <span class="badge bg-danger ms-auto">2</span></a></li>
        <li><a href="#" class="d-block mb-1">✏️ Edit Profile</a></li>
        <li><a href="#" class="d-block text-danger">Logout</a></li>
        
    </ul>
    <div class="sidebar-profile mt-auto">
        <div class="fw-bold mb-1">👤 Jane Smith</div>
        <div class="small mb-2">🧪Science Department</div>
    </div>
</div>
<!-- Sidebar toggle button for mobile -->
<button class="btn btn-primary d-lg-none position-fixed" style="top:1rem;left:1rem;z-index:1100;" id="sidebarToggleBtn">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="sidebar-backdrop d-lg-none" id="sidebarBackdrop" style="display:none;"></div>
<script>
// Sidebar toggle logic
const sidebar = document.getElementById('teacherSidebar');
const toggleBtn = document.getElementById('sidebarToggleBtn');
const backdrop = document.getElementById('sidebarBackdrop');
toggleBtn.addEventListener('click', function() {
    sidebar.classList.toggle('show');
    backdrop.style.display = sidebar.classList.contains('show') ? 'block' : 'none';
});
backdrop.addEventListener('click', function() {
    sidebar.classList.remove('show');
    backdrop.style.display = 'none';
});
</script>
