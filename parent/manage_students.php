<?php
require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students - Dark Mode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background: #181a1b; color: #f8f9fa; }
        .main-wrapper { max-width: 1100px; margin: 60px auto; padding: 2.5rem 2rem; }
        .modern-card { background: #23272b; border-radius: 18px; box-shadow: 0 8px 32px rgba(0,0,0,0.32); padding: 2rem 1.5rem; margin-bottom: 2rem; }
        .modern-title { font-weight: 700; color: #ffc107; margin-bottom: 2rem; letter-spacing: 1px; }
        .search-bar { background: #181a1b; border-radius: 12px; border: 1px solid #343a40; color: #fff; }
        .search-bar:focus { border: 1px solid #ffc107; background: #23272b; color: #fff; }
        .table-modern { background: #23272b; color: #fff; border-radius: 12px; overflow: hidden; }
        .table-modern th { background: #181a1b; color: #ffc107; border: none; }
        .table-modern td { border: none; }
        .table-modern tr { transition: background 0.2s; }
        .table-modern tr:hover { background: #343a40; }
        .modern-btn { border-radius: 8px; font-weight: 600; padding: 0.5rem 1rem; }
        .modern-btn-update { background: #ffc107; color: #23272b; border: none; }
        .modern-btn-update:hover { background: #e0a800; color: #23272b; }
        .modern-btn-delete { background: #dc3545; color: #fff; border: none; }
        .modern-btn-delete:hover { background: #b02a37; color: #fff; }
        @media (max-width: 767px) {
            .main-wrapper { padding: 1rem 0.5rem; }
            .modern-card { padding: 1rem 0.5rem; }
            .table-modern th, .table-modern td { font-size: 0.95rem; }
        }
    </style>
</head>
<body>
    <?php include 'adminnavbar.php'; ?>
    <div class="main-wrapper">
        <div class="modern-card mb-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3 gap-3">
                <h3 class="modern-title mb-3 mb-md-0"><i class="bi bi-people-fill me-2"></i>Student Management</h3>
                <form id="searchForm" class="d-flex" style="max-width:400px;">
                    <input type="text" class="form-control search-bar me-2" id="searchInput" placeholder="Search by name, class, or ID">
                    <button class="btn modern-btn modern-btn-update" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <div class="d-flex align-items-center gap-2" style="min-width:220px;">
                    <label for="sortGender" class="form-label mb-0 text-warning">Sort by:</label>
                    <select class="form-select search-bar" id="sortGender" style="width:110px;">
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <select class="form-select search-bar" id="sortClass" style="width:110px;">
                        <option value="">Class</option>
                        <option value="P3A">P3A</option>
                        <option value="G7">G7</option>
                        <option value="P6A">P6A</option>
                        <option value="G9-Science">G9-Science</option>
                        <option value="G12-Commerce">G12-Commerce</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-modern table-striped table-hover" id="studentsTable">
                    <thead><tr><th><i class="bi bi-hash"></i> ID</th><th><i class="bi bi-person"></i> Name</th><th><i class="bi bi-journal"></i> Class</th><th><i class="bi bi-gender-ambiguous"></i> Gender</th><th>Actions</th></tr></thead>
                    <tbody>
                    <!-- Student rows will be rendered by JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    // Hardcoded student list
    const students = [
        {id: 101, name: 'Alice Johnson', class: 'P3A', gender: 'Female'},
        {id: 102, name: 'Bob Smith', class: 'G7', gender: 'Male'},
        {id: 103, name: 'Carla Gomez', class: 'P6A', gender: 'Female'},
        {id: 104, name: 'David Lee', class: 'G9-Science', gender: 'Male'},
        {id: 105, name: 'Eva Brown', class: 'G12-Commerce', gender: 'Female'}
    ];

    function renderStudents(list) {
        const tbody = document.querySelector('#studentsTable tbody');
        tbody.innerHTML = '';
        if (list.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center">No students found.</td></tr>';
            return;
        }
        list.forEach(student => {
            tbody.innerHTML += `
                <tr>
                    <td><span class="fw-bold">${student.id}</span></td>
                    <td>${student.name}</td>
                    <td>${student.class}</td>
                    <td>${student.gender}</td>
                    <td>
                        <button class="modern-btn modern-btn-update me-2 mb-1" onclick="alert('Update feature coming soon!')"><i class="bi bi-pencil-square"></i> Update</button>
                        <button class="modern-btn modern-btn-delete mb-1" onclick="if(confirm('Delete this student?')) alert('Delete feature coming soon!')"><i class="bi bi-trash"></i> Delete</button>
                    </td>
                </tr>
            `;
        });
    }

    // Filtering and sorting
    function filterAndSortStudents() {
        const query = document.getElementById('searchInput').value.trim().toLowerCase();
        const gender = document.getElementById('sortGender').value;
        const classVal = document.getElementById('sortClass').value;
        let filtered = students.filter(s =>
            (s.name.toLowerCase().includes(query) ||
            s.class.toLowerCase().includes(query) ||
            String(s.id).includes(query)) &&
            (gender === '' || s.gender === gender) &&
            (classVal === '' || s.class === classVal)
        );
        renderStudents(filtered);
    }

    // Initial render
    renderStudents(students);

    // Search functionality
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        filterAndSortStudents();
    });

    // Sort functionality
    document.getElementById('sortGender').addEventListener('change', filterAndSortStudents);
    document.getElementById('sortClass').addEventListener('change', filterAndSortStudents);
    </script>
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
