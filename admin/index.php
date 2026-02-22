<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #181a1b; color: #fff; }
        .login-container { max-width: 400px; margin: 80px auto; background: #23272b; border-radius: 18px; box-shadow: 0 8px 32px rgba(0,0,0,0.32); padding: 2.5rem 2rem; }
        .login-title { color: #ffc107; font-weight: 700; margin-bottom: 2rem; }
        .form-label { color: #fff; }
        .form-control { background: #343a40; color: #fff; border: none; }
        .form-control:focus { background: #343a40; color: #fff; border: 1px solid #ffc107; }
        .btn-login { background: #ffc107; color: #23272b; font-weight: 600; border-radius: 8px; padding: 0.75rem; }
        .btn-login:hover { background: #e0a800; color: #23272b; }
    </style>
</head>
<body>
<?php
require_once 'db_connect.php';
session_start();

$error_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staff_id = $conn->real_escape_string($_POST['staff_id']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT password FROM staff WHERE staff_id = '$staff_id'");
    if ($result && $row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['staff_id'] = $staff_id;
            header('Location: dashboard.php');
            exit;
        } else {
            $error_message = 'Incorrect password.';
        }
    } else {
        $error_message = 'Staff ID not found.';
    }
}
?>
<div class="login-container">
    <h2 class="login-title text-center">School Login</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="staff_id" class="form-label">Staff ID</label>
            <input type="text" class="form-control" id="staff_id" name="staff_id" required placeholder="Enter Staff ID">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter Password">
        </div>
        <button type="submit" class="btn btn-login w-100">Login</button>
        <?php if(!empty($error_message)): ?>
            <div class="alert alert-danger mt-3"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
