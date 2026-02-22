<?php
// manage_subjects.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Subjects / Modules</title>
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
        <h2 class="mb-4"><span class="me-2" style="font-size:1.5em;">📖</span>Manage Subjects / Modules</h2>
        <div class="card p-4 mb-4" style="background: #23272f;">
            <h5 class="mb-3">Add New Subject</h5>
            <form class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="subject_code" class="form-label">Subject Code</label>
                    <input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="e.g. MATH101" required>
                </div>
                <div class="col-md-3">
                    <label for="subject_name" class="form-label">Subject Name</label>
                    <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="e.g. Mathematics" required>
                </div>
                <div class="col-md-4">
                    <label for="grade_level" class="form-label">Grade / Level</label>
                    <select class="form-select" id="grade_level" name="grade_level" required>
                        <option value="">Select Grade/Level</option>
                        <option value="Grade 1">Grade 1</option>
                        <option value="Grade 2">Grade 2</option>
                        <option value="Grade 3">Grade 3</option>
                        <option value="Grade 4">Grade 4</option>
                        <option value="Grade 5">Grade 5</option>
                        <option value="Grade 6">Grade 6</option>
                        <option value="Grade 7">Grade 7</option>
                        <option value="Grade 8">Grade 8</option>
                        <option value="Grade 9">Grade 9</option>
                        <option value="Grade 10">Grade 10</option>
                        <option value="Grade 11">Grade 11</option>
                        <option value="Grade 12">Grade 12</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="max_marks" class="form-label">Maximum Marks</label>
                    <input type="number" class="form-control" id="max_marks" name="max_marks" placeholder="e.g. 100" min="1" required>
                </div>
                <div class="col-md-1 d-grid">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Grade / Level</th>
                        <th>Maximum Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>MATH101</td>
                        <td>Mathematics</td>
                        <td>Grade 7</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>ENG201</td>
                        <td>English</td>
                        <td>Grade 8</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>BIO301</td>
                        <td>Biology</td>
                        <td>Grade 9</td>
                        <td>70</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
