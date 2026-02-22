<?php
require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>13ors College - Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background: #343a40; color: #fff; }
        .dark-wrapper { max-width: 1200px; margin: 60px auto; background: transparent; padding: 2.5rem 2rem; }
        .dark-title { font-weight: 700; color: #ffc107; margin-bottom: 2rem; }
        .form-label { color: #fff; }
        .form-control, .form-select { background: #495057; color: #fff; border: none; }
        .form-control:focus, .form-select:focus { background: #495057; color: #fff; border: 1px solid #ffc107; }
        .btn-dark-register { background: #ffc107; color: #212529; font-weight: 600; border-radius: 8px; padding: 0.75rem; }
        .btn-dark-register:hover { background: #e0a800; color: #212529; }
        .card-dark { background: #212529; border-radius: 18px; box-shadow: 0 8px 32px rgba(0,0,0,0.32); padding: 2rem 1.5rem; margin-bottom: 2rem; }
        @media (min-width: 768px) {
            .card-row { display: flex; gap: 2rem; }
            .card-dark { flex: 1; margin-bottom: 0; }
        }
        @media (max-width: 767px) {
            .card-row { display: block; }
        }
    </style>
</head>
<body>
    <?php include 'adminnavbar.php'; ?>
    <div class="dark-wrapper">
        <h2 class="dark-title text-center">Student Registration</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $conn->real_escape_string($_POST['name']);
            $dob = $conn->real_escape_string($_POST['dob']);
            $class = $conn->real_escape_string($_POST['class']);
            $gender = $conn->real_escape_string($_POST['gender']);
            $address1 = $conn->real_escape_string($_POST['guardian1_address']);
            $guardian1_name = $conn->real_escape_string($_POST['guardian1_name']);
            $guardian1_phone = $conn->real_escape_string($_POST['guardian1_phone']);
            $guardian1_id = $conn->real_escape_string($_POST['guardian1_id']);
            $guardian1_email = $conn->real_escape_string($_POST['guardian1_email']);
            $address2 = $conn->real_escape_string($_POST['guardian2_address']);
            $guardian2_name = $conn->real_escape_string($_POST['guardian2_name']);
            $guardian2_phone = $conn->real_escape_string($_POST['guardian2_phone']);
            $guardian2_id = $conn->real_escape_string($_POST['guardian2_id']);
            $guardian2_email = $conn->real_escape_string($_POST['guardian2_email']);
            $notes = $conn->real_escape_string($_POST['notes']);

            // You may need to update your database schema and SQL logic to handle multiple guardians
            $sql = "INSERT INTO students (name, dob, class, gender, notes) VALUES ('$name', '$dob', '$class', '$gender', '$notes')";
            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success">Student registered successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
            }
        }
        ?>
        <form method="post" action="">
            <div class="card-row">
                <div class="card-dark">
                    <h5 class="text-warning mb-3" id="student-info"><i class="bi bi-person-fill me-2" aria-hidden="true"></i>Student Information</h5>
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control mb-3" id="name" name="name" required aria-label="Full Name">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control mb-3" id="dob" name="dob" required aria-label="Date of Birth">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select mb-3" id="gender" name="gender" required aria-label="Gender">
                        <option value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label for="level" class="form-label">Level</label>
                    <select class="form-select mb-3" id="level" name="level" required aria-label="Level">
                        <option value="">Select level</option>
                        <option value="Preschool">Preschool (Maternelle)</option>
                        <option value="Primary">Primary</option>
                        <option value="Secondary">Secondary (Cycle court)</option>
                        <option value="Highschool">Highschool</option>
                    </select>
                    <label for="class" class="form-label">Class</label>
                    <select class="form-select mb-3" id="class" name="class" required aria-label="Class">
                        <option value="">Select class/level</option>
                    </select>
                </div>
                <div class="card-dark">
                    <h5 class="text-warning mb-3"><i class="bi bi-person-fill me-2" aria-hidden="true"></i>Guardian 1 Information</h5>
                    <label for="guardian1_id" class="form-label">Guardian 1 ID Number</label>
                    <input type="text" class="form-control mb-3" id="guardian1_id" name="guardian1_id" required aria-label="Guardian 1 ID Number">
                    <label for="guardian1_name" class="form-label">Guardian 1 Name</label>
                    <input type="text" class="form-control mb-3" id="guardian1_name" name="guardian1_name" required aria-label="Guardian 1 Name">
                    <label for="guardian1_email" class="form-label">Guardian 1 Email <span class="text-secondary">(optional)</span></label>
                    <input type="email" class="form-control mb-3" id="guardian1_email" name="guardian1_email" aria-label="Guardian 1 Email">
                    <label for="guardian1_phone" class="form-label">Guardian 1 Phone</label>
                    <input type="tel" class="form-control mb-3" id="guardian1_phone" name="guardian1_phone" pattern="[0-9]{10,15}" required aria-label="Guardian 1 Phone" placeholder="e.g. 1234567890">
                    <label for="guardian1_address" class="form-label">Guardian 1 Address</label>
                    <input type="text" class="form-control mb-3" id="guardian1_address" name="guardian1_address" required aria-label="Guardian 1 Address" pattern=".{5,}" placeholder="Street, City, Country">
                </div>
                <div class="card-dark">
                    <h5 class="text-warning mb-3"><i class="bi bi-person-fill me-2" aria-hidden="true"></i>Guardian 2 Information <span class="text-secondary">(optional)</span></h5>
                    <label for="guardian2_id" class="form-label">Guardian 2 ID Number <span class="text-secondary">(optional)</span></label>
                    <input type="text" class="form-control mb-3" id="guardian2_id" name="guardian2_id" aria-label="Guardian 2 ID Number">
                    <label for="guardian2_name" class="form-label">Guardian 2 Name <span class="text-secondary">(optional)</span></label>
                    <input type="text" class="form-control mb-3" id="guardian2_name" name="guardian2_name" aria-label="Guardian 2 Name">
                    <label for="guardian2_email" class="form-label">Guardian 2 Email <span class="text-secondary">(optional)</span></label>
                    <input type="email" class="form-control mb-3" id="guardian2_email" name="guardian2_email" aria-label="Guardian 2 Email">
                    <label for="guardian2_phone" class="form-label">Guardian 2 Phone <span class="text-secondary">(optional)</span></label>
                    <input type="tel" class="form-control mb-3" id="guardian2_phone" name="guardian2_phone" pattern="[0-9]{10,15}" aria-label="Guardian 2 Phone" placeholder="e.g. 1234567890">
                    <label for="guardian2_address" class="form-label">Guardian 2 Address <span class="text-secondary">(optional)</span></label>
                    <input type="text" class="form-control mb-3" id="guardian2_address" name="guardian2_address" aria-label="Guardian 2 Address" pattern=".{5,}" placeholder="Street, City, Country">
                </div>
            </div>
            <label for="notes" class="form-label">Notes / Comments</label>
            <textarea class="form-control mb-3" id="notes" name="notes" rows="2" aria-label="Notes"></textarea>
            <button type="submit" class="btn btn-dark-register mt-4 w-100">Register Student</button>
        </form>
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const levelSelect = document.getElementById('level');
    const classSelect = document.getElementById('class');
    const classOptions = {
        'Preschool': [
            { value: 'R1', text: 'R1' },
            { value: 'R2', text: 'R2' },
            { value: 'R3', text: 'R3' }
        ],
        'Primary': [
            { value: 'P1A', text: 'P1A' },
            { value: 'P2A', text: 'P2A' },
            { value: 'P3A', text: 'P3A' },
            { value: 'P4A', text: 'P4A' },
            { value: 'P5A', text: 'P5A' },
            { value: 'P6A', text: 'P6A' }
        ],
        'Secondary': [
            { value: 'G7', text: 'Grade 7' },
            { value: 'G8', text: 'Grade 8' }
        ],
        'Highschool': [
            { value: 'G9-Science', text: 'Grade 9 - Science' },
            { value: 'G9-Literature', text: 'Grade 9 - Literature' },
            { value: 'G9-Pedagogy', text: 'Grade 9 - Pedagogy' },
            { value: 'G9-Commerce', text: 'Grade 9 - Commerce' },
            { value: 'G10-Science', text: 'Grade 10 - Science' },
            { value: 'G10-Literature', text: 'Grade 10 - Literature' },
            { value: 'G10-Pedagogy', text: 'Grade 10 - Pedagogy' },
            { value: 'G10-Commerce', text: 'Grade 10 - Commerce' },
            { value: 'G11-Science', text: 'Grade 11 - Science' },
            { value: 'G11-Literature', text: 'Grade 11 - Literature' },
            { value: 'G11-Pedagogy', text: 'Grade 11 - Pedagogy' },
            { value: 'G11-Commerce', text: 'Grade 11 - Commerce' },
            { value: 'G12-Science', text: 'Grade 12 - Science' },
            { value: 'G12-Literature', text: 'Grade 12 - Literature' },
            { value: 'G12-Pedagogy', text: 'Grade 12 - Pedagogy' },
            { value: 'G12-Commerce', text: 'Grade 12 - Commerce' }
        ]
    };
    function updateClassOptions() {
        const level = levelSelect.value;
        let options = [];
        if (level && classOptions[level]) {
            options = classOptions[level];
        }
        classSelect.innerHTML = '<option value="">Select class/level</option>';
        options.forEach(opt => {
            const option = document.createElement('option');
            option.value = opt.value;
            option.text = opt.text;
            classSelect.appendChild(option);
        });
    }
    levelSelect.addEventListener('change', updateClassOptions);
    if (levelSelect.value) updateClassOptions();
    </script>
</body>
</html>
