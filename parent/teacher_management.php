<?php
require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Management</title>
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
        <h2 class="dark-title text-center">Teacher Management</h2>
        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover" id="teacherTable">
                <thead><tr><th>ID</th><th>Name</th><th>Department</th><th>Class Level</th><th>Actions</th></tr></thead>
                <tbody>
                </tbody>
            </table>
            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Teacher</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm">
                                <input type="hidden" id="editId">
                                <div class="mb-3">
                                    <label for="editRole" class="form-label">Department</label>
                                    <select class="form-select" id="editRole">
                                        <option value="Academics">Academics</option>
                                        <option value="Head Teacher">Head Teacher</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="editClassLevel" class="form-label">Class Level</label>
                                    <select class="form-select" id="editClassLevel">
                                        <option value="Preschool/Primary">Preschool/Primary</option>
                                        <option value="High School">High School</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-dark" id="saveEdit">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Hardcoded teacher data
    let teachers = [
        {id: 201, name: 'Jane Doe', department: 'Academics', classLevel: 'High School', teachingClasses: ['P3A', 'P4B']},
        {id: 202, name: 'John Smith', department: 'Head Teacher', classLevel: 'Preschool/Primary', assignedClass: 'P3A', teachingClasses: ['P3A', 'P5C']}
    ];

    function renderTeachers() {
        const tbody = document.querySelector('#teacherTable tbody');
        tbody.innerHTML = '';
        teachers.forEach((t, idx) => {
            tbody.innerHTML += `
                <tr>
                    <td>${t.id}</td>
                    <td>${t.name}</td>
                    <td>${t.department}</td>
                    <td>${t.classLevel}
                        ${t.department === 'Head Teacher' && t.assignedClass ? `<div class='mt-1'><span class='badge bg-warning text-dark'>Head Teacher: ${t.assignedClass}</span></div>` : ''}
                        ${t.teachingClasses && t.teachingClasses.length > 0 ? `<div class='mt-1'><span class='badge bg-info text-dark'>Teaching: ${t.teachingClasses.join(', ')}</span></div>` : ''}
                    </td>
                    <td>
                        <button class="btn btn-dark" onclick="editTeacher(${idx})">Edit</button>
                        <button class="btn btn-dark" onclick="deleteTeacher(${idx})">Delete</button>
                    </td>
                </tr>
            `;
        });
    }

    window.editTeacher = function(idx) {
        const t = teachers[idx];
        document.getElementById('editId').value = idx;
        document.getElementById('editRole').value = t.department;
        document.getElementById('editClassLevel').value = t.classLevel;
        // Show/hide assigned class field
        let assignedClassField = document.getElementById('assignedClassField');
        if (!assignedClassField) {
            assignedClassField = document.createElement('div');
            assignedClassField.className = 'mb-3';
            assignedClassField.id = 'assignedClassField';
            assignedClassField.innerHTML = `
                <label for="editAssignedClass" class="form-label">Assigned Class</label>
                <input type="text" class="form-control" id="editAssignedClass" name="editAssignedClass">
            `;
            document.getElementById('editForm').appendChild(assignedClassField);
        }
        if (t.department === 'Head Teacher') {
            assignedClassField.style.display = 'block';
            document.getElementById('editAssignedClass').value = t.assignedClass || '';
        } else {
            assignedClassField.style.display = 'none';
            document.getElementById('editAssignedClass').value = '';
        }
        // Teaching classes field
        let teachingClassesField = document.getElementById('teachingClassesField');
        if (!teachingClassesField) {
            teachingClassesField = document.createElement('div');
            teachingClassesField.className = 'mb-3';
            teachingClassesField.id = 'teachingClassesField';
            teachingClassesField.innerHTML = `
                <label for="editTeachingClasses" class="form-label">Teaching Classes (comma separated)</label>
                <input type="text" class="form-control" id="editTeachingClasses" name="editTeachingClasses">
            `;
            document.getElementById('editForm').appendChild(teachingClassesField);
        }
        document.getElementById('editTeachingClasses').value = t.teachingClasses ? t.teachingClasses.join(', ') : '';
        var modal = new bootstrap.Modal(document.getElementById('editModal'));
        modal.show();
    }

    document.getElementById('saveEdit').addEventListener('click', function() {
        const idx = document.getElementById('editId').value;
        const newDept = document.getElementById('editRole').value;
        const newClassLevel = document.getElementById('editClassLevel').value;
        const newAssignedClass = document.getElementById('editAssignedClass').value.trim();
        const newTeachingClasses = document.getElementById('editTeachingClasses').value.trim();
        // Validation: Head Teacher can only be assigned to one class, and each class can only have one Head Teacher
        if (newDept === 'Head Teacher') {
            for (let i = 0; i < teachers.length; i++) {
                if (i !== idx && teachers[i].id === teachers[idx].id && teachers[i].department === 'Head Teacher' && teachers[i].assignedClass && teachers[i].assignedClass !== newAssignedClass) {
                    alert('A teacher can only be Head Teacher of one class.');
                    return;
                }
            }
            for (let i = 0; i < teachers.length; i++) {
                if (i !== idx && teachers[i].department === 'Head Teacher' && teachers[i].assignedClass === newAssignedClass && newAssignedClass) {
                    alert('This class already has a Head Teacher.');
                    return;
                }
            }
            teachers[idx].department = newDept;
            teachers[idx].classLevel = newClassLevel;
            teachers[idx].assignedClass = newAssignedClass;
        } else {
            teachers[idx].department = newDept;
            teachers[idx].classLevel = newClassLevel;
            teachers[idx].assignedClass = undefined;
        }
        // Update teaching classes
        teachers[idx].teachingClasses = newTeachingClasses ? newTeachingClasses.split(',').map(c => c.trim()).filter(c => c) : [];
        renderTeachers();
        var modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        modal.hide();
            // Show/hide assigned class field when department changes in modal
            let assignedClassField = document.getElementById('assignedClassField');
            if (this.value === 'Head Teacher') {
                assignedClassField.style.display = 'block';
            } else {
                assignedClassField.style.display = 'none';
                document.getElementById('editAssignedClass').value = '';
            }
    });

    window.deleteTeacher = function(idx) {
        if (confirm('Delete this teacher?')) {
            teachers.splice(idx, 1);
            renderTeachers();
        }
    }

    // Initial render
    renderTeachers();
    </script>
</body>
</html>
