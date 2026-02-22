<?php
// timetable.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable</title>
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
        .nav-tabs .nav-link.active {
            background-color: #23272f;
            color: #fff;
            border-bottom: 2px solid #0d6efd;
        }
    </style>
</head>
<body>
    <?php include 'adminnavbar.php'; ?>
    <div class="container mt-5">
        <h2 class="mb-4"><span class="me-2" style="font-size:1.5em;">📅</span>Timetable Management</h2>
        <ul class="nav nav-tabs mb-4" id="timetableTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="class-tab" data-bs-toggle="tab" data-bs-target="#class" type="button" role="tab" aria-controls="class" aria-selected="true">Class Timetable</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="midterm-tab" data-bs-toggle="tab" data-bs-target="#midterm" type="button" role="tab" aria-controls="midterm" aria-selected="false">Midterm Exam Timetable</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="final-tab" data-bs-toggle="tab" data-bs-target="#final" type="button" role="tab" aria-controls="final" aria-selected="false">End of Year Exam Timetable</button>
            </li>
        </ul>
        <div class="tab-content" id="timetableTabsContent">
            <div class="tab-pane fade show active" id="class" role="tabpanel" aria-labelledby="class-tab">
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary" onclick="generateTimetable('class')">Generate Timetable</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle" id="classTimetable">
                        <thead class="table-dark">
                            <tr>
                                <th>Period</th>
                                <th>Grade / Level</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>1</td><td>Grade 7</td><td>Mathematics</td><td>Mr. Smith</td><td>Monday</td></tr>
                            <tr><td>2</td><td>Grade 7</td><td>English</td><td>Ms. Johnson</td><td>Monday</td></tr>
                            <tr><td>3</td><td>Grade 7</td><td>Biology</td><td>Mr. Smith</td><td>Tuesday</td></tr>
                            <tr><td>1</td><td>Grade 8</td><td>Mathematics</td><td>Mr. Smith</td><td>Monday</td></tr>
                            <tr><td>2</td><td>Grade 8</td><td>English</td><td>Ms. Johnson</td><td>Tuesday</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="midterm" role="tabpanel" aria-labelledby="midterm-tab">
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary" onclick="generateTimetable('midterm')">Generate Midterm Timetable</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle" id="midtermTimetable">
                        <thead class="table-dark">
                            <tr>
                                <th>Date</th>
                                <th>Grade / Level</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>2026-03-10</td><td>Grade 7</td><td>Mathematics</td><td>Mr. Smith</td><td>09:00 - 10:30</td></tr>
                            <tr><td>2026-03-11</td><td>Grade 7</td><td>English</td><td>Ms. Johnson</td><td>11:00 - 12:30</td></tr>
                            <tr><td>2026-03-12</td><td>Grade 8</td><td>Biology</td><td>Mr. Smith</td><td>09:00 - 10:30</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="final" role="tabpanel" aria-labelledby="final-tab">
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary" onclick="generateTimetable('final')">Generate Final Timetable</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle" id="finalTimetable">
                        <thead class="table-dark">
                            <tr>
                                <th>Date</th>
                                <th>Grade / Level</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>2026-06-15</td><td>Grade 7</td><td>Mathematics</td><td>Mr. Smith</td><td>09:00 - 10:30</td></tr>
                            <tr><td>2026-06-16</td><td>Grade 8</td><td>English</td><td>Ms. Johnson</td><td>11:00 - 12:30</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Demo: Randomize timetable rows (for now, just shuffle rows)
    function generateTimetable(type) {
        var tableId = type === 'class' ? 'classTimetable' : (type === 'midterm' ? 'midtermTimetable' : 'finalTimetable');
        var table = document.getElementById(tableId).getElementsByTagName('tbody')[0];
        var rows = Array.from(table.rows);
        for (let i = rows.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            table.appendChild(rows[j]);
            rows.splice(j, 1);
        }
    }
    </script>
</body>
</html>
