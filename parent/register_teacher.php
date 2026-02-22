<?php
require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { min-height: 100vh; background: #181a1b; color: #fff; }
        .dark-title { font-weight: 700; color: #ffc107; margin-bottom: 2rem; }
        .form-label { color: #fff; }
        .form-control, .form-select { background: #343a40; color: #fff; border: none; }
        .form-control:focus, .form-select:focus { background: #343a40; color: #fff; border: 1px solid #ffc107; }
        .btn-dark-register { background: #ffc107; color: #23272b; font-weight: 600; border-radius: 8px; padding: 0.75rem; }
        .btn-dark-register:hover { background: #e0a800; color: #23272b; }
        .card-row { display: flex; flex-wrap: wrap; gap: 2rem; margin-bottom: 2rem; }
        .card-dark { background: #23272b; border-radius: 18px; box-shadow: 0 8px 32px rgba(0,0,0,0.32); padding: 2rem 1.5rem; flex: 1 1 320px; margin-bottom: 0; }
        @media (max-width: 900px) {
            .card-row { flex-direction: column; gap: 1.5rem; }
        }
    </style>
</head>
<body>
    <?php include 'adminnavbar.php'; ?>
    <div class="dark-wrapper">
        <h2 class="dark-title text-center">Register Teacher</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $conn->real_escape_string($_POST['name']);
            $gender = $conn->real_escape_string($_POST['gender']);
            $dob = $conn->real_escape_string($_POST['dob']);
            $email = $conn->real_escape_string($_POST['email']);
            $phone = $conn->real_escape_string($_POST['phone']);
            $department = $conn->real_escape_string($_POST['department']);
            $qualification = $conn->real_escape_string($_POST['qualification']);
            $experience = $conn->real_escape_string($_POST['experience']);
            $id_number = $conn->real_escape_string($_POST['id_number']);
            $address = $conn->real_escape_string($_POST['address']);
            $city = $conn->real_escape_string($_POST['city']);
            $state = $conn->real_escape_string($_POST['state']);
            $country = $conn->real_escape_string($_POST['country']);
            $emergency_name = $conn->real_escape_string($_POST['emergency_name']);
            $emergency_relation = $conn->real_escape_string($_POST['emergency_relation']);
            $emergency_phone = $conn->real_escape_string($_POST['emergency_phone']);
            $notes = $conn->real_escape_string($_POST['notes']);
            $class_level = $conn->real_escape_string($_POST['class_level']);
            // Example SQL, adjust table/fields as needed
            $sql = "INSERT INTO teachers (name, gender, dob, email, phone, department, qualification, experience, id_number, address, city, state, country, emergency_name, emergency_relation, emergency_phone, notes, class_level) VALUES ('$name', '$gender', '$dob', '$email', '$phone', '$department', '$qualification', '$experience', '$id_number', '$address', '$city', '$state', '$country', '$emergency_name', '$emergency_relation', '$emergency_phone', '$notes', '$class_level')";
            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success">Teacher registered successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
            }
        }
        ?>
        <form method="post" action="">
            <div class="card-row">
                <div class="card-dark">
                    <h5 class="text-warning mb-3">Personal Details</h5>
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control mb-3" id="name" name="name" required>
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select mb-3" id="gender" name="gender" required>
                        <option value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control mb-3" id="dob" name="dob" required>
                    <label for="email" class="form-label">Email <span class="text-secondary">(optional)</span></label>
                    <input type="email" class="form-control mb-3" id="email" name="email">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control mb-3" id="phone" name="phone" required pattern="[0-9]{10,15}" placeholder="e.g. 1234567890">
                    <label for="id_number" class="form-label">ID Number</label>
                    <input type="text" class="form-control mb-3" id="id_number" name="id_number" required>
                </div>
                <div class="card-dark">
                    <h5 class="text-warning mb-3">Professional Details</h5>
                    <label for="department" class="form-label">Department</label>
                    <select class="form-select mb-3" id="department" name="department" required>
                        <option value="">Select department</option>
                        <option value="Academics">Academics</option>
                        <option value="Head Teacher">Head Teacher</option>
                    </select>
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" class="form-control mb-3" id="qualification" name="qualification" required>
                    <label for="experience" class="form-label">Years of Experience</label>
                    <input type="number" class="form-control mb-3" id="experience" name="experience" min="0" max="50" required>
                    <label for="class_level" class="form-label">Class Level</label>
                    <select class="form-select mb-3" id="class_level" name="class_level">
                        <option value="">Select class level</option>
                        <option value="Preschool/Primary">Preschool/Primary Teacher</option>
                        <option value="High School">High School Teacher</option>
                    </select>
                </div>
                <div class="card-dark">
                    <h5 class="text-warning mb-3">Address</h5>
                    <label for="address" class="form-label">Street Address</label>
                    <input type="text" class="form-control mb-3" id="address" name="address" required>
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control mb-3" id="city" name="city" required>
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control mb-3" id="state" name="state" required>
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control mb-3" id="country" name="country" required>
                </div>
                <div class="card-dark">
                    <h5 class="text-warning mb-3">Emergency Contact</h5>
                    <label for="emergency_name" class="form-label">Contact Name</label>
                    <input type="text" class="form-control mb-3" id="emergency_name" name="emergency_name" required>
                    <label for="emergency_relation" class="form-label">Relationship</label>
                    <input type="text" class="form-control mb-3" id="emergency_relation" name="emergency_relation" required>
                    <label for="emergency_phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control mb-3" id="emergency_phone" name="emergency_phone" required pattern="[0-9]{10,15}" placeholder="e.g. 1234567890">
                </div>
                <div class="card-dark">
                    <h5 class="text-warning mb-3">Optional</h5>
                    <label for="notes" class="form-label">Notes / Comments <span class="text-secondary">(optional)</span></label>
                    <textarea class="form-control mb-3" id="notes" name="notes" rows="2"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-dark-register mt-2 w-100">Register</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
