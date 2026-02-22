<?php
// grades_exams.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades / Exams</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #23272f 0%, #181a20 100%);
            min-height: 100vh;
            color: #f1f1f1;
        }
        .container {
            background: rgba(34, 39, 47, 0.98);
            border-radius: 16px;
            box-shadow: 0 4px 24px 0 rgba(0,0,0,0.25);
            padding-bottom: 32px;
        }
    </style>
</head>
<body>
    <?php include 'adminnavbar.php'; ?>
    <div class="container mt-5">
        <h2 class="mb-4"><span class="me-2" style="font-size:1.5em;">📝</span>Grades / Exams <span class="badge bg-warning text-dark align-middle ms-2">Superadmin</span></h2>
        <form class="row g-2 mb-4 align-items-end" id="gradesFilterForm" autocomplete="off">
            <div class="col-md-3">
                <label for="filterTeacher" class="form-label">Teacher</label>
                <select class="form-select" id="filterTeacher">
                    <option value="">All Teachers</option>
                    <option value="Mr. Smith">Mr. Smith</option>
                    <option value="Ms. Johnson">Ms. Johnson</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="filterGrade" class="form-label">Grade / Level</label>
                <select class="form-select" id="filterGrade">
                    <option value="">All Grades</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="filterSubject" class="form-label">Subject</label>
                <select class="form-select" id="filterSubject">
                    <option value="">All Subjects</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="English">English</option>
                    <option value="Biology">Biology</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="filterExamType" class="form-label">Exam Type</label>
                <select class="form-select" id="filterExamType">
                    <option value="">All Types</option>
                    <option value="Quiz">Quiz</option>
                    <option value="Midterm">Midterm</option>
                    <option value="Final">Final</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="gradesSearch" class="form-label">Search</label>
                <input type="text" id="gradesSearch" class="form-control" placeholder="Student, subject, exam...">
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle" id="gradesTable">
                <thead class="table-dark">
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Grade / Level</th>
                        <th>Teacher</th>
                        <th>Subject</th>
                        <th>Exam Type</th>
                        <th>Exam Name/#</th>
                        <th>Marks</th>
                        <th>Max Marks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>STU001</td>
                        <td>John Doe</td>
                        <td>Grade 7</td>
                        <td>Mr. Smith</td>
                        <td>Mathematics</td>
                        <td>Quiz</td>
                        <td>Quiz 1</td>
                        <td><span class="marks-text">18</span> <button class="btn btn-sm btn-primary rounded-pill edit-marks-btn ms-2 px-3 fw-semibold" type="button">Edit</button></td>
                        <td>20</td>
                        <td><button class="btn btn-sm btn-danger delete-row-btn" type="button">Delete</button></td>
                    </tr>
                    <tr>
                        <td>STU001</td>
                        <td>John Doe</td>
                        <td>Grade 7</td>
                        <td>Mr. Smith</td>
                        <td>Mathematics</td>
                        <td>Quiz</td>
                        <td>Quiz 2</td>
                        <td><span class="marks-text">19</span> <button class="btn btn-sm btn-primary rounded-pill edit-marks-btn ms-2 px-3 fw-semibold" type="button">Edit</button></td>
                        <td>20</td>
                        <td><button class="btn btn-sm btn-danger delete-row-btn" type="button">Delete</button></td>
                    </tr>
                    <tr>
                        <td>STU001</td>
                        <td>John Doe</td>
                        <td>Grade 7</td>
                        <td>Mr. Smith</td>
                        <td>Mathematics</td>
                        <td>Midterm</td>
                        <td>-</td>
                        <td><span class="marks-text">78</span> <button class="btn btn-sm btn-primary rounded-pill edit-marks-btn ms-2 px-3 fw-semibold" type="button">Edit</button></td>
                        <td>100</td>
                        <td><button class="btn btn-sm btn-danger delete-row-btn" type="button">Delete</button></td>
                    </tr>
                    <tr>
                        <td>STU002</td>
                        <td>Jane Smith</td>
                        <td>Grade 8</td>
                        <td>Ms. Johnson</td>
                        <td>English</td>
                        <td>Final</td>
                        <td>-</td>
                        <td><span class="marks-text">85</span> <button class="btn btn-sm btn-primary rounded-pill edit-marks-btn ms-2 px-3 fw-semibold" type="button">Edit</button></td>
                        <td>100</td>
                        <td><button class="btn btn-sm btn-danger delete-row-btn" type="button">Delete</button></td>
                    </tr>
                    <tr>
                        <td>STU003</td>
                        <td>Michael Lee</td>
                        <td>Grade 8</td>
                        <td>Ms. Johnson</td>
                        <td>Biology</td>
                        <td>Quiz</td>
                        <td>Quiz 1</td>
                        <td><span class="marks-text">42</span> <button class="btn btn-sm btn-primary rounded-pill edit-marks-btn ms-2 px-3 fw-semibold" type="button">Edit</button></td>
                        <td>50</td>
                        <td><button class="btn btn-sm btn-danger delete-row-btn" type="button">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="alert alert-info mt-4">As a <strong>Superadmin</strong>, you can edit or delete any grade record.</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Filtering logic for grades table
    function filterGradesTable() {
        var teacher = document.getElementById('filterTeacher').value.toLowerCase();
        var grade = document.getElementById('filterGrade').value.toLowerCase();
        var subject = document.getElementById('filterSubject').value.toLowerCase();
        var examType = document.getElementById('filterExamType').value.toLowerCase();
        var search = document.getElementById('gradesSearch').value.toLowerCase();
        var rows = document.querySelectorAll('#gradesTable tbody tr');
        rows.forEach(function(row) {
            var t = row.cells[3].textContent.toLowerCase(); // Teacher
            var g = row.cells[2].textContent.toLowerCase(); // Grade / Level
            var s = row.cells[4].textContent.toLowerCase(); // Subject
            var e = row.cells[5].textContent.toLowerCase(); // Exam Type
            var text = row.textContent.toLowerCase();
            var show = true;
            if (teacher && t !== teacher) show = false;
            if (grade && g !== grade) show = false;
            if (subject && s !== subject) show = false;
            if (examType && e !== examType) show = false;
            if (search && !text.includes(search)) show = false;
            row.style.display = show ? '' : 'none';
        });
    }
    document.getElementById('filterTeacher').addEventListener('change', filterGradesTable);
    document.getElementById('filterGrade').addEventListener('change', filterGradesTable);
    document.getElementById('filterSubject').addEventListener('change', filterGradesTable);
    document.getElementById('filterExamType').addEventListener('change', filterGradesTable);
    document.getElementById('gradesSearch').addEventListener('keyup', filterGradesTable);

    // Inline edit for marks column
    document.querySelectorAll('.edit-marks-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var td = btn.closest('td');
            var currentText = td.querySelector('.marks-text').textContent.trim();
            var input = document.createElement('input');
            input.type = 'number';
            input.className = 'form-control form-control-sm d-inline w-auto';
            input.value = currentText;
            input.min = 0;
            input.style.marginRight = '8px';
            td.querySelector('.marks-text').style.display = 'none';
            btn.style.display = 'none';
            td.insertBefore(input, td.firstChild);
            // Save button
            var saveBtn = document.createElement('button');
            saveBtn.className = 'btn btn-sm btn-success';
            saveBtn.type = 'button';
            saveBtn.textContent = 'Save';
            td.appendChild(saveBtn);
            saveBtn.addEventListener('click', function(e) {
                e.preventDefault();
                var newText = input.value;
                td.querySelector('.marks-text').textContent = newText;
                td.querySelector('.marks-text').style.display = '';
                input.remove();
                saveBtn.remove();
                btn.style.display = '';
            });
        });
    });

    // Delete row with confirmation
    document.querySelectorAll('.delete-row-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this grade record?')) {
                btn.closest('tr').remove();
            }
        });
    });
    </script>
</body>
</html>
