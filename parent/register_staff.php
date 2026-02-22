<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    header('Content-Type: application/json');
    $name = $conn->real_escape_string($_POST['name']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $phone = $conn->real_escape_string($_POST['phone']);
    $role = $conn->real_escape_string($_POST['role']);
    $department = $conn->real_escape_string($_POST['department']);
    $id_number = $conn->real_escape_string($_POST['id_number']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $country = $conn->real_escape_string($_POST['country']);
    $emergency_name = $conn->real_escape_string($_POST['emergency_name']);
    $emergency_relation = $conn->real_escape_string($_POST['emergency_relation']);
    // Enable error logging for debugging AJAX issues
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $emergency_phone = $conn->real_escape_string($_POST['emergency_phone']);
    $notes = isset($_POST['notes']) ? $conn->real_escape_string($_POST['notes']) : '';
    $password = $conn->real_escape_string($_POST['password']);

    // Password validation: minimum 10 characters, strong password
    if (strlen($password) < 10 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[^A-Za-z0-9]/', $password)) {
        echo json_encode(['status' => 'error', 'message' => 'Password must be at least 10 characters and include uppercase, lowercase, number, and special character.']);
        exit;
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Generate random staff ID in STxxxxxx format
        function generateStaffID() {
            return 'ST' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        }
        $staff_id = generateStaffID();
        $sql = "INSERT INTO staff (staff_id, name, gender, dob, email, phone, role, department, id_number, address, city, state, country, emergency_name, emergency_relation, emergency_phone, password, notes)
            VALUES ('$staff_id', '$name', '$gender', '$dob', '$email', '$phone', '$role', '$department', '$id_number', '$address', '$city', '$state', '$country', '$emergency_name', '$emergency_relation', '$emergency_phone', '$hashed_password', '$notes')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Staff registered successfully!']);
            exit;
        } else {
            // Check for duplicate id_number error
            if (strpos($conn->error, 'id_number') !== false && strpos($conn->error, 'Duplicate') !== false) {
                echo json_encode(['status' => 'error', 'message' => 'This ID Number is already registered.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
            }
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register School Staff</title>
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
        @media (max-width: 900px) { .card-row { flex-direction: column; gap: 1.5rem; } }
    </style>
</head>
<body>
<?php include 'adminnavbar.php'; ?>
<div class="dark-wrapper">
    <h2 class="dark-title text-center">Register School Staff</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        $name = $conn->real_escape_string($_POST['name']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $dob = $conn->real_escape_string($_POST['dob']);
        $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
        $phone = $conn->real_escape_string($_POST['phone']);
        $role = $conn->real_escape_string($_POST['role']);
        $department = $conn->real_escape_string($_POST['department']);
        $id_number = $conn->real_escape_string($_POST['id_number']);
        $address = $conn->real_escape_string($_POST['address']);
        $city = $conn->real_escape_string($_POST['city']);
        $state = $conn->real_escape_string($_POST['state']);
        $country = $conn->real_escape_string($_POST['country']);
        $emergency_name = $conn->real_escape_string($_POST['emergency_name']);
        $emergency_relation = $conn->real_escape_string($_POST['emergency_relation']);
        // Enable error logging for debugging AJAX issues
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $emergency_phone = $conn->real_escape_string($_POST['emergency_phone']);
        $notes = isset($_POST['notes']) ? $conn->real_escape_string($_POST['notes']) : '';
        $password = $conn->real_escape_string($_POST['password']);

        // Password validation: minimum 10 characters, strong password
        if (strlen($password) < 10 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[^A-Za-z0-9]/', $password)) {
            echo json_encode(['status' => 'error', 'message' => 'Password must be at least 10 characters and include uppercase, lowercase, number, and special character.']);
            exit;
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Generate random staff ID in STxxxxxx format
            function generateStaffID() {
                return 'ST' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            }
            $staff_id = generateStaffID();
            $sql = "INSERT INTO staff (staff_id, name, gender, dob, email, phone, role, department, id_number, address, city, state, country, emergency_name, emergency_relation, emergency_phone, password, notes)
                VALUES ('$staff_id', '$name', '$gender', '$dob', '$email', '$phone', '$role', '$department', '$id_number', '$address', '$city', '$state', '$country', '$emergency_name', '$emergency_relation', '$emergency_phone', '$hashed_password', '$notes')";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['status' => 'success', 'message' => 'Staff registered successfully!']);
                exit;
            } else {
                // Check for duplicate id_number error
                if (strpos($conn->error, 'id_number') !== false && strpos($conn->error, 'Duplicate') !== false) {
                    echo json_encode(['status' => 'error', 'message' => 'This ID Number is already registered.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
                }
                exit;
            }
        }
    }
    ?>

    <form id="staffForm" method="post" action="register_staff.php">
        <div class="card-row">
            <!-- Personal Details -->
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

                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control mb-3" id="phone" name="phone" required pattern="[0-9]{10,15}" placeholder="e.g. 1234567890">

                <label for="id_number" class="form-label">ID Number</label>
                <input type="text" class="form-control mb-3" id="id_number" name="id_number" required>
            </div>

            <!-- Address -->
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

            <!-- Professional Details -->
            <div class="card-dark">
                <h5 class="text-warning mb-3">Professional Details</h5>

                <label for="role" class="form-label">Role</label>
                <select class="form-select mb-3" id="role" name="role" required>
                    <option value="">Select role</option>
                    <option value="Executive">Executive</option>
                    <option value="Management">Management</option>
                    <option value="Administration">Administration</option>
                </select>

                <label for="department" class="form-label">Department</label>
                <select class="form-select mb-3" id="department" name="department" required></select>
                
                <h5 class="text-warning mb-3">Set Password</h5>
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control mb-3" id="password" name="password" required minlength="10" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{10,}" autocomplete="new-password">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="showPassword">
                <label class="form-check-label" for="showPassword">Show Password</label>
            </div>
            <div id="passwordHelp" class="form-text text-warning mb-2">Password must be at least 10 characters and include uppercase, lowercase, number, and special character.</div>
            <div id="passwordStrength" class="mb-2"></div>
            </div>
        </div>
        <button type="submit" class="btn btn-dark-register mt-2 w-100">Register</button>
        <div id="formResponse" class="mt-3"></div>
    </form>
</div>

<!-- JS for dynamic department based on role -->
<script>
// Show password toggle
document.getElementById('showPassword').addEventListener('change', function() {
    const pwd = document.getElementById('password');
    pwd.type = this.checked ? 'text' : 'password';
});
const roleSelect = document.getElementById('role');
const departmentSelect = document.getElementById('department');

const departmentMap = {
    Executive: ['Promoter'],
    Management: ['Principal', 'Vice Principal', 'Head of Studies'],
    Administration: ['Administrator', 'Secretary', 'Registrar', 'Bursar', 'Discipline Master']
};

function updateDepartment(role) {
    departmentSelect.innerHTML = '<option value="">Select department</option>';
    (departmentMap[role] || []).forEach(dep => {
        departmentSelect.innerHTML += `<option value="${dep}">${dep}</option>`;
    });
}

roleSelect.addEventListener('change', () => updateDepartment(roleSelect.value));
updateDepartment(roleSelect.value); // Initial load
</script>

<script>
// Password strength checker
const passwordInput = document.getElementById('password');
const passwordStrength = document.getElementById('passwordStrength');
passwordInput.addEventListener('input', function() {
    const val = passwordInput.value;
    let strength = 0;
    if (val.length >= 10) strength++;
    if (/[A-Z]/.test(val)) strength++;
    if (/[a-z]/.test(val)) strength++;
    if (/[0-9]/.test(val)) strength++;
    if (/[^A-Za-z0-9]/.test(val)) strength++;
    let msg = '';
    if (strength === 5) {
        msg = '<span class="text-success">Strong password</span>';
    } else if (strength >= 3) {
        msg = '<span class="text-warning">Medium password</span>';
    } else {
        msg = '<span class="text-danger">Weak password</span>';
    }
    passwordStrength.innerHTML = msg;
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('staffForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    fetch(form.action || window.location.href, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        const respDiv = document.getElementById('formResponse');
        if (data.status === 'success') {
            respDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
            form.reset();
        } else {
            respDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }
    })
    .catch(() => {
        document.getElementById('formResponse').innerHTML = '<div class="alert alert-danger">Submission failed. Please try again.</div>';
    });
});
</script>
</body>
</html>