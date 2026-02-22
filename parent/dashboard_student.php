<?php
// dashboard_student.php
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
        body {
            min-height: 100vh;
            background: linear-gradient(270deg, #2575fc, #6a11cb, #ff6a00, #ffb347);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }
        @keyframes gradientBG {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        </style>
    </head>
    <body>
        <?php include 'studentnavbar.php'; ?>
        <div class="container py-4">
            <div class="row g-4">
                <!-- Left Column: Info, Fees, Messages -->
                <div class="col-12 col-md-4">
                    <div class="d-flex flex-column gap-4">
                        <!-- Student Info Card -->
                        <div class="card h-100 border-0 shadow-lg" style="background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%); color: #fff;">
                            <div class="card-body text-center">
                                <span style="font-size:2.5rem;">🎓</span>
                                <h4 class="card-title mt-2 mb-1 fw-bold">John Doe</h4>
                                <div class="mb-2">Class: <span class="fw-semibold">10A</span></div>
                                <div class="mb-2">Student #: <span class="fw-semibold">20231234</span></div>
                                <div class="mb-2">Gender: <span class="fw-semibold">Male</span></div>
                                <div class="mb-2">Date of Birth: <span class="fw-semibold">2008-05-14</span></div>
                                <div class="mb-2">Guardian: <span class="fw-semibold">Jane Doe</span></div>
                                <div class="mb-2">Admission Date: <span class="fw-semibold">2020-09-01</span></div>
                                <div class="mb-2">Status: <span class="fw-semibold text-success">Active</span></div>
                                <a href="#" class="btn btn-light btn-sm mt-2">Edit Profile</a>
                            </div>
                        </div>
                        <!-- Fees Card -->
                        <div class="card h-100 border-0 shadow-lg" style="background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%); color: #fff;">
                            <div class="card-body text-center">
                                <span style="font-size:2rem;">💵</span>
                                <h5 class="card-title mt-2 mb-3 fw-bold">Fees Summary</h5>
                                <div class="mb-2">Total Fees: <span class="fw-semibold">$1,200</span></div>
                                <div class="mb-2">Paid: <span class="fw-semibold">$900</span></div>
                                <div class="mb-2">Balance Left: <span class="fw-semibold">$300</span></div>
                                <a href="#" class="btn btn-light btn-sm mt-2">Pay Now</a>
                            </div>
                        </div>
                        <!-- Messages Card -->
                        <div class="card h-100 border-0 shadow-lg" style="background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%); color: #fff;">
                            <div class="card-body">
                                <div class="text-center mb-2">
                                    <span style="font-size:2rem;">✉️</span>
                                    <h5 class="card-title mt-2 mb-3 fw-bold text-white">Messages</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item bg-transparent text-white">Exam schedule updated for March 2026.</li>
                                    <li class="list-group-item bg-transparent text-white">Fee payment deadline: Feb 28, 2026.</li>
                                    <li class="list-group-item bg-transparent text-white">Parent-teacher meeting on Feb 20, 2026.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Column: Timetable, Report Card -->
                <div class="col-12 col-md-8">
                    <div class="d-flex flex-column gap-4">
                        <!-- Timetable Card -->
                        <div class="card h-100 border-0 shadow-lg" style="background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%); color: #fff;">
                            <div class="card-body">
                                <div class="text-center">
                                    <span style="font-size:2rem;">📅</span>
                                    <h5 class="card-title mt-2 mb-3 fw-bold">My Timetable</h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered mb-0 bg-white text-dark">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Day</th><th>07:00-08:00</th><th>08:00-09:00</th><th>09:00-10:00</th><th>10:00-11:00</th><th>11:00-12:00</th><th>12:00-13:00</th><th>13:00-14:00</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>Monday</td><td>Math</td><td>English</td><td>Biology</td><td>Chemistry</td><td>History</td><td>PE</td><td>Art</td></tr>
                                            <tr><td>Tuesday</td><td>Physics</td><td>Math</td><td>English</td><td>Biology</td><td>Chemistry</td><td>History</td><td>PE</td></tr>
                                            <tr><td>Wednesday</td><td>Art</td><td>Physics</td><td>Math</td><td>English</td><td>Biology</td><td>Chemistry</td><td>History</td></tr>
                                            <tr><td>Thursday</td><td>PE</td><td>Art</td><td>Physics</td><td>Math</td><td>English</td><td>Biology</td><td>Chemistry</td></tr>
                                            <tr><td>Friday</td><td>Chemistry</td><td>History</td><td>PE</td><td>Art</td><td>Physics</td><td>Math</td><td>English</td></tr>
                                            <tr><td>Saturday</td><td>English</td><td>Biology</td><td>Chemistry</td><td>History</td><td>PE</td><td>Art</td><td>Physics</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Report Card Card -->
                        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);">
                            <div class="card-body p-4">
                                <div class="text-center mb-3">
                                    <span style="font-size:2.5rem;">📊</span>
                                    <h5 class="card-title mt-2 mb-3 fw-bold text-dark">Report Card</h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-0 bg-white rounded" id="reportCardTable">
                                        <thead class="table-warning">
                                            <tr>
                                                <th>Subject</th>
                                                <th>Term 1</th><th>Term 2</th><th>Exam 1</th><th>Term 3</th><th>Term 4</th><th>Exam 2</th><th>Finals</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-secondary">
                                                <th>Max Marks</th>
                                                <td>50</td><td>50</td><td>50</td><td>50</td><td>50</td><td>50</td><td>50</td>
                                            </tr>
                                            <tr><td>Math</td>
                                                <td>45</td><td>48</td><td>25</td><td>37</td><td>49</td><td>50</td><td>47</td>
                                            </tr>
                                            <tr class="table-secondary">
                                                <th>Max Marks</th>
                                                <td>20</td><td>20</td><td>20</td><td>20</td><td>20</td><td>20</td><td>20</td>
                                            </tr>
                                            <tr><td>English</td>
                                                <td>10</td><td>18</td><td>12</td><td>19</td><td>15</td><td>14</td><td>17</td>
                                            </tr>
                                            <tr class="table-secondary">
                                                <th>Max Marks</th>
                                                <td>40</td><td>40</td><td>40</td><td>40</td><td>40</td><td>40</td><td>40</td>
                                            </tr>
                                            <tr><td>Biology</td>
                                                <td>39</td><td>32</td><td>34</td><td>31</td><td>33</td><td>35</td><td>34</td>
                                            </tr>
                                            <tr class="table-secondary">
                                                <th>Max Marks</th>
                                                <td>30</td><td>30</td><td>30</td><td>30</td><td>30</td><td>30</td><td>30</td>
                                            </tr>
                                            <tr><td>Chemistry</td>
                                                <td>22</td><td>25</td><td>15</td><td>24</td><td>26</td><td>28</td><td>27</td>
                                            </tr>
                                            <tr class="table-secondary">
                                                <th>Max Marks</th>
                                                <td>25</td><td>25</td><td>25</td><td>25</td><td>25</td><td>25</td><td>25</td>
                                            </tr>
                                            <tr><td>History</td>
                                                <td>15</td><td>17</td><td>10</td><td>16</td><td>18</td><td>21</td><td>20</td>
                                            </tr>
                                            <tr class="table-secondary">
                                                <th>Max Marks</th>
                                                <td>60</td><td>60</td><td>60</td><td>60</td><td>60</td><td>60</td><td>60</td>
                                            </tr>
                                            <tr><td>Physics</td>
                                                <td>58</td><td>60</td><td>32</td><td>59</td><td>61</td><td>63</td><td>62</td>
                                            </tr>
                                            <tr class="table-secondary">
                                                <th>Max Marks</th>
                                                <td>30</td><td>30</td><td>30</td><td>30</td><td>30</td><td>30</td><td>30</td>
                                            </tr>
                                            <tr><td>PE</td>
                                                <td>29</td><td>30</td><td>27</td><td>30</td><td>29</td><td>30</td><td>30</td>
                                            </tr>
                                            <tr class="table-secondary">
                                                <th>Max Marks</th>
                                                <td>20</td><td>20</td><td>20</td><td>20</td><td>20</td><td>20</td><td>20</td>
                                            </tr>
                                            <tr><td>Art</td>
                                                <td>18</td><td>19</td><td>9</td><td>17</td><td>19</td><td>16</td><td>15</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-info" id="classAvgRow">
                                                <th>Class Avg (%)</th>
                                                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                            </tr>
                                            <tr class="table-success" id="studentAvgRow">
                                                <th>Student Avg (%)</th>
                                                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <script>
                                    // Highlight marks below 50% in red and calculate averages
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var table = document.getElementById('reportCardTable');
                                        var rows = table.querySelectorAll('tbody tr');
                                        var studentTotals = Array(7).fill(0);
                                        var studentMaxTotals = Array(7).fill(0);
                                        var classTotals = Array(7).fill(0);
                                        var classMaxTotals = Array(7).fill(0);
                                        var subjectCount = 0;
                                        for (var i = 0; i < rows.length; i += 2) { // Each subject row follows a max row
                                            var maxRow = rows[i];
                                            var marksRow = rows[i+1];
                                            if (!marksRow) continue;
                                            var maxCells = maxRow.querySelectorAll('td');
                                            var markCells = marksRow.querySelectorAll('td');
                                            subjectCount++;
                                            for (var j = 1; j < markCells.length; j++) {
                                                var mark = parseFloat(markCells[j].textContent);
                                                var max = parseFloat(maxCells[j].textContent);
                                                studentTotals[j-1] += mark;
                                                studentMaxTotals[j-1] += max;
                                                // Example class average: randomize for demo, but should be replaced with real data
                                                var classMark = Math.round((Math.random() * max));
                                                classTotals[j-1] += classMark;
                                                classMaxTotals[j-1] += max;
                                                if (!isNaN(mark) && !isNaN(max) && mark < 0.5 * max) {
                                                    markCells[j].style.color = 'red';
                                                    markCells[j].style.fontWeight = 'bold';
                                                }
                                            }
                                        }
                                        // Calculate and display student avg
                                        var studentAvgRow = document.getElementById('studentAvgRow').children;
                                        for (var k = 1; k <= 7; k++) {
                                            var avg = studentMaxTotals[k-1] ? (studentTotals[k-1] / studentMaxTotals[k-1]) * 100 : 0;
                                            studentAvgRow[k].textContent = avg.toFixed(1);
                                        }
                                        // Calculate and display class avg (demo random values)
                                        var classAvgRow = document.getElementById('classAvgRow').children;
                                        for (var k = 1; k <= 7; k++) {
                                            var avg = classMaxTotals[k-1] ? (classTotals[k-1] / classMaxTotals[k-1]) * 100 : 0;
                                            classAvgRow[k].textContent = avg.toFixed(1);
                                        }
                                    });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>