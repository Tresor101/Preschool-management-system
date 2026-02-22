<?php
// auth.php - Centralized authentication and session management

// Secure session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
ini_set('session.cookie_samesite', 'Strict');

session_name('school_session');
session_start();

// Session fixation protection
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// Auto logout after 15 minutes inactivity
$timeout = 900; // 15 minutes in seconds
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset();
    session_destroy();
    header('Location: index.php?timeout=1');
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

// Role-Based Access Control (RBAC)
// Database-driven permission check
function require_permission($permission_name) {
    require_once 'db_connect.php';
    $staff_id = $_SESSION['user_id'] ?? null;
    if (!$staff_id) {
        header('Location: index.php?login_required=1');
        exit();
    }
    // Check user override
    $stmt = $conn->prepare("SELECT allow FROM user_permissions WHERE staff_id = ? AND permission_id = (SELECT permission_id FROM permissions WHERE name = ?)");
    $stmt->bind_param('ss', $staff_id, $permission_name);
    $stmt->execute();
    $stmt->bind_result($allow);
    if ($stmt->fetch()) {
        $stmt->close();
        if ($allow) return;
        header('Location: index.php?unauthorized=1');
        exit();
    }
    $stmt->close();
    // Check role permission
    $role = $_SESSION['role'] ?? null;
    if (!$role) {
        header('Location: index.php?unauthorized=1');
        exit();
    }
    $stmt = $conn->prepare("SELECT 1 FROM role_permissions WHERE role = ? AND permission_id = (SELECT permission_id FROM permissions WHERE name = ?)");
    $stmt->bind_param('ss', $role, $permission_name);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->close();
        return;
    }
    $stmt->close();
    header('Location: index.php?unauthorized=1');
    exit();
}

// Check if user is logged in
function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?login_required=1');
        exit();
    }
    // Account lock check
    require_once 'db_connect.php';
    $staff_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT account_locked, lock_time FROM staff WHERE staff_id = ?");
    $stmt->bind_param('s', $staff_id);
    $stmt->execute();
    $stmt->bind_result($locked, $lock_time);
    if ($stmt->fetch() && $locked) {
        $stmt->close();
        // Optionally unlock after a period (e.g., 30 min)
        if ($lock_time && strtotime($lock_time) < time() - 1800) {
            $stmt2 = $conn->prepare("UPDATE staff SET account_locked = 0, failed_logins = 0, lock_time = NULL WHERE staff_id = ?");
            $stmt2->bind_param('s', $staff_id);
            $stmt2->execute();
            $stmt2->close();
        } else {
            header('Location: index.php?locked=1');
            exit();
        }
    }
    $stmt->close();
}

// Call this function after a failed login attempt
function record_failed_login($staff_id) {
    require_once 'db_connect.php';
    $stmt = $conn->prepare("UPDATE staff SET failed_logins = failed_logins + 1 WHERE staff_id = ?");
    $stmt->bind_param('s', $staff_id);
    $stmt->execute();
    $stmt->close();
    // Lock account if failed_logins >= 5
    $stmt2 = $conn->prepare("SELECT failed_logins FROM staff WHERE staff_id = ?");
    $stmt2->bind_param('s', $staff_id);
    $stmt2->execute();
    $stmt2->bind_result($failed);
    if ($stmt2->fetch() && $failed >= 5) {
        $stmt2->close();
        $stmt3 = $conn->prepare("UPDATE staff SET account_locked = 1, lock_time = NOW() WHERE staff_id = ?");
        $stmt3->bind_param('s', $staff_id);
        $stmt3->execute();
        $stmt3->close();
    } else {
        $stmt2->close();
    }
}

// Call this function after a successful login
function reset_failed_logins($staff_id) {
    require_once 'db_connect.php';
    $stmt = $conn->prepare("UPDATE staff SET failed_logins = 0, account_locked = 0, lock_time = NULL WHERE staff_id = ?");
    $stmt->bind_param('s', $staff_id);
    $stmt->execute();
    $stmt->close();
}
?>
