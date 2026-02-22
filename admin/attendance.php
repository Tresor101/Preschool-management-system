<?php
// attendance.php
// Basic Attendance page for school management system
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
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
        .card {
            background: #23272f;
            color: #f1f1f1;
            box-shadow: 0 2px 8px 0 rgba(0,0,0,0.18);
        }
        .table-responsive {
            background: #23272f;
            border-radius: 12px;
            box-shadow: 0 1px 4px 0 rgba(0,0,0,0.12);
        }
        .table {
            color: #f1f1f1;
        }
        .table thead.table-dark th {
            background-color: #181a20;
            color: #f1f1f1;
        }
    </style>
</head>
<body>
    <?php include 'adminnavbar.php'; ?>
    <div class="container mt-5">
        <main aria-label="Attendance main content">
            <h2 class="mb-4"><span class="me-2" style="font-size:1.5em;">🕒</span>Attendance</h2>
            <section class="d-flex justify-content-center mb-4" aria-label="Attendance form">
                <div class="card p-4 shadow-lg" style="max-width: 1100px; width: 100%; background: #23272f; border-radius: 18px;">
                    <form class="row g-2 align-items-end justify-content-center" autocomplete="off">
                        <div class="col-auto d-flex align-items-center">
                            <span class="d-inline-block bg-primary bg-gradient rounded-circle p-2 me-2" aria-hidden="true">
                                <svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='white' class='bi bi-person-check' viewBox='0 0 16 16'><path d='M15.854 5.146a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 .708.708l2.646-2.647 2.646 2.647a.5.5 0 0 0 .708-.708l-3-3z'/><path d='M1 14s-1 0-1-1 1-4 7-4 7 3 7 4-1 1-1 1H1zm7-5c-4.418 0-6 2.239-6 3s1.582 3 6 3 6-2.239 6-3-1.582-3-6-3z'/></svg>
                            </span>
                        </div>
                        <div class="col-md-4">
                            <label for="student_number" class="form-label visually-hidden">Student Number</label>
                            <input type="text" class="form-control form-control-lg" id="student_number" name="student_number" placeholder="Student number" required aria-label="Student Number">
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="form-label visually-hidden">Status</label>
                            <select class="form-select form-select-lg" id="status" name="status" aria-label="Attendance Status">
                                <option value="">-- Select if not Present --</option>
                                <option value="A">A (Absent)</option>
                                <option value="L">L (Late)</option>
                                <option value="AJ">AJ (Absence: Justified Reason)</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-lg btn-success fw-bold shadow" type="submit">Submit</button>
                        </div>
                        <div class="col-12">
                            <div class="form-text text-light text-center">Leave status blank for Present</div>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
    <!-- Search bar and attendance table -->
    <div class="container mt-4">
    <section class="container mt-4" aria-label="Attendance records">
        <div class="row mb-3 justify-content-center">
            <div class="col-md-6">
                <input type="text" id="attendanceSearch" class="form-control form-control-lg" placeholder="Search by student number or status..." aria-label="Search attendance records">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle" id="attendanceTable">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Student Number</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>STU002</td>
                        <td><span class="status-text">A (Absent)</span> <button class="btn btn-sm btn-primary rounded-pill edit-status-btn ms-2 px-3 fw-semibold" type="button" aria-label="Edit status for STU002">Edit</button></td>
                        <td>2026-02-16</td>
                        <td><button class="btn btn-sm btn-danger delete-row-btn" type="button" aria-label="Delete row for STU002">Delete</button></td>
                    </tr>
                    <tr>
                        <td>STU003</td>
                        <td><span class="status-text">L (Late)</span> <button class="btn btn-sm btn-primary rounded-pill edit-status-btn ms-2 px-3 fw-semibold" type="button" aria-label="Edit status for STU003">Edit</button></td>
                        <td>2026-02-16</td>
                        <td><button class="btn btn-sm btn-danger delete-row-btn" type="button" aria-label="Delete row for STU003">Delete</button></td>
                    </tr>
                    <tr>
                        <td>STU004</td>
                        <td><span class="status-text">AJ (Absence: Justified Reason)</span> <button class="btn btn-sm btn-primary rounded-pill edit-status-btn ms-2 px-3 fw-semibold" type="button" aria-label="Edit status for STU004">Edit</button></td>
                        <td>2026-02-16</td>
                        <td><button class="btn btn-sm btn-danger delete-row-btn" type="button" aria-label="Delete row for STU004">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Hide rows with Present status on page load
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#attendanceTable tbody tr').forEach(function(row) {
            var status = row.querySelector('.status-text');
            if (status && status.textContent.trim() === 'Present') {
                row.style.display = 'none';
            }
        });
    });

    // Live search for attendance table
    document.getElementById('attendanceSearch').addEventListener('keyup', function() {
        var filter = this.value.toLowerCase();
        var rows = document.querySelectorAll('#attendanceTable tbody tr');
        rows.forEach(function(row) {
            var text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Inline edit for status column
    document.querySelectorAll('.edit-status-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var td = btn.closest('td');
            var currentText = td.querySelector('.status-text').textContent.trim();
            var select = document.createElement('select');
            select.className = 'form-select form-select-sm d-inline w-auto';
            var options = [
                {value: '', text: 'Present'},
                {value: 'A', text: 'A (Absent)'},
                {value: 'L', text: 'L (Late)'},
                {value: 'AJ', text: 'AJ (Absence: Justified Reason)'}
            ];
            options.forEach(function(opt) {
                var option = document.createElement('option');
                option.value = opt.value;
                option.textContent = opt.text;
                if (currentText === opt.text) option.selected = true;
                if (currentText === 'Present' && opt.value === '') option.selected = true;
                select.appendChild(option);
            });
            td.querySelector('.status-text').style.display = 'none';
            btn.style.display = 'none';
            select.style.marginRight = '8px';
            td.insertBefore(select, td.firstChild);
            // Save button
            var saveBtn = document.createElement('button');
            saveBtn.className = 'btn btn-sm btn-success';
            saveBtn.type = 'button';
            saveBtn.textContent = 'Save';
            td.appendChild(saveBtn);
            saveBtn.addEventListener('click', function(e) {
                e.preventDefault();
                var newText = select.options[select.selectedIndex].text;
                td.querySelector('.status-text').textContent = newText;
                td.querySelector('.status-text').style.display = '';
                select.remove();
                saveBtn.remove();
                btn.style.display = '';
                // Hide row if status is changed to Present
                if (newText === 'Present') {
                    td.closest('tr').style.display = 'none';
                }
            });
        });
    });

    // Delete row with confirmation
    document.querySelectorAll('.delete-row-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this attendance record?')) {
                btn.closest('tr').remove();
            }
        });
    });
    </script>
</body>
</html>
