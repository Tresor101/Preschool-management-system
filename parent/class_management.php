<?php
require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { min-height: 100vh; background: #181a1b; color: #fff; }
        .dark-wrapper { max-width: 900px; margin: 60px auto; background: #23272b; border-radius: 18px; box-shadow: 0 8px 32px rgba(0,0,0,0.32); padding: 2.5rem 2rem; }
        .dark-title { font-weight: 700; color: #ffc107; margin-bottom: 2rem; }
        .table-dark { background: #23272b; color: #fff; border-radius: 12px; }
        .table-dark th { background: #181a1b; color: #ffc107; border: none; }
        .table-dark td { border: none; }
        .table-dark tr:hover { background: #343a40; }
        .btn-dark { background: #ffc107; color: #23272b; border-radius: 8px; font-weight: 600; }
        .btn-dark:hover { background: #e0a800; color: #23272b; }
    </style>
</head>
<body>
    <?php include 'adminnavbar.php'; ?>
    <div class="dark-wrapper">
        <h2 class="dark-title text-center mb-5">Class Management</h2>
        <div class="tabs-container mx-auto mb-5" style="max-width:900px;">
            <ul class="nav nav-pills mb-4 justify-content-center" id="classTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="list-tab" data-bs-toggle="pill" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="true">Class List</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="add-tab" data-bs-toggle="pill" data-bs-target="#add" type="button" role="tab" aria-controls="add" aria-selected="false">Add Class</button>
                </li>
            </ul>
            <div class="tab-content bg-dark rounded-4 shadow-sm p-4" id="classTabsContent">
                <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                    <table class="table table-dark table-striped table-hover rounded-3">
                        <thead>
                            <tr>
                                <th>ID</th><th>Class Name</th><th>Level</th><th>Teachers</th><th>Head Teacher</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="classTableBody">
                            <!-- Example hardcoded classes -->
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
                    <form id="addClassForm" class="mt-3">
                        <div class="mb-3">
                            <label for="className" class="form-label">Class Name</label>
                            <input type="text" class="form-control" id="className" name="className" required>
                        </div>
                        <div class="mb-3">
                            <label for="classLevel" class="form-label">Level</label>
                            <select class="form-select" id="classLevel" name="classLevel" required>
                                <option value="">Select Level</option>
                                <option value="Preschool">Preschool</option>
                                <option value="Primary">Primary</option>
                                <option value="Junior High">Junior High</option>
                                <option value="High School">High School</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Assign Teachers</label>
                            <div id="teacherCheckboxes" class="d-flex flex-wrap gap-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Jane Doe" id="teacherJane">
                                    <label class="form-check-label" for="teacherJane">Jane Doe</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="John Smith" id="teacherJohn">
                                    <label class="form-check-label" for="teacherJohn">John Smith</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Mary Lee" id="teacherMary">
                                    <label class="form-check-label" for="teacherMary">Mary Lee</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="headTeacher" class="form-label">Assign Head Teacher</label>
                            <select class="form-select" id="headTeacher" name="headTeacher">
                                <option value="">Select Head Teacher</option>
                                <option value="Jane Doe">Jane Doe</option>
                                <option value="John Smith">John Smith</option>
                                <option value="Mary Lee">Mary Lee</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Add Class</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for editing class -->
        <div class="modal fade" id="editClassModal" tabindex="-1" aria-labelledby="editClassModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-light rounded-4">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="editClassModalLabel">Edit Class</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editClassForm">
                            <div class="mb-3">
                                <label for="editClassName" class="form-label">Class Name</label>
                                <input type="text" class="form-control" id="editClassName" name="editClassName" required>
                            </div>
                            <div class="mb-3">
                                <label for="editClassLevel" class="form-label">Level</label>
                                <select class="form-select" id="editClassLevel" name="editClassLevel" required>
                                    <option value="">Select Level</option>
                                    <option value="Preschool">Preschool</option>
                                    <option value="Primary">Primary</option>
                                    <option value="Junior High">Junior High</option>
                                    <option value="High School">High School</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Assign Teachers</label>
                                <div id="editTeacherCheckboxes" class="d-flex flex-wrap gap-3 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Jane Doe" id="editTeacherJane">
                                        <label class="form-check-label" for="editTeacherJane">Jane Doe</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="John Smith" id="editTeacherJohn">
                                        <label class="form-check-label" for="editTeacherJohn">John Smith</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Mary Lee" id="editTeacherMary">
                                        <label class="form-check-label" for="editTeacherMary">Mary Lee</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="editHeadTeacher" class="form-label">Assign Head Teacher</label>
                                <select class="form-select" id="editHeadTeacher" name="editHeadTeacher">
                                    <option value="">Select Head Teacher</option>
                                    <option value="Jane Doe">Jane Doe</option>
                                    <option value="John Smith">John Smith</option>
                                    <option value="Mary Lee">Mary Lee</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-3">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .nav-pills .nav-link { border-radius: 2rem; font-size: 1.1rem; padding: 0.5rem 1.5rem; }
            .nav-pills .nav-link.active { background: #2d3a60; color: #fff; }
            .tab-content { min-height: 350px; }
            .table-dark th, .table-dark td { vertical-align: middle; }
            .table-dark tr:hover { background: #23272b !important; }
            .modal-content { box-shadow: 0 8px 32px rgba(0,0,0,0.32); }
        </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Demo class data
        let classes = [
            {id: 301, name: 'P3A', level: 'Primary', teachers: ['Jane Doe'], headTeacher: 'Jane Doe'},
            {id: 302, name: 'G9-Science', level: 'High School', teachers: ['John Smith'], headTeacher: 'John Smith'}
        ];
        function renderClasses() {
            const tbody = document.getElementById('classTableBody');
            tbody.innerHTML = '';
            classes.forEach((c, idx) => {
                tbody.innerHTML += `
                    <tr>
                        <td>${c.id}</td>
                        <td>${c.name}</td>
                        <td>${c.level}</td>
                        <td>${c.teachers && c.teachers.length ? c.teachers.join(', ') : '-'} </td>
                        <td>${c.headTeacher || '-'}</td>
                        <td>
                            <button class="btn btn-dark" onclick="editClass(${idx})">Edit</button>
                            <button class="btn btn-dark" onclick="deleteClass(${idx})">Delete</button>
                        </td>
                    </tr>
                `;
            });
        }
        renderClasses();
        document.getElementById('addClassForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('className').value.trim();
            const level = document.getElementById('classLevel').value;
            const teacherSelect = document.getElementById('classTeacher');
            const teachers = Array.from(teacherSelect.selectedOptions).map(opt => opt.value);
            const headTeacher = document.getElementById('headTeacher').value;
            if (!name || !level || !teachers.length) {
                alert('Please fill all required fields and select at least one teacher.');
                return;
            }
            // Demo: auto-increment ID
            const newId = classes.length ? Math.max(...classes.map(c => c.id)) + 1 : 301;
            classes.push({id: newId, name, level, teachers, headTeacher});
            renderClasses();
            this.reset();
        });
        window.editClass = function(idx) {
            alert('Edit functionality coming soon!');
        }
        window.deleteClass = function(idx) {
            if (confirm('Delete this class?')) {
                classes.splice(idx, 1);
                renderClasses();
            }
        }
    </script>
</body>
</html>
