<?php
// messages.php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages / Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #23272f 0%, #181a20 100%); min-height: 100vh; color: #f1f1f1; }
        .container { background: rgba(34, 39, 47, 0.98); border-radius: 16px; box-shadow: 0 4px 24px 0 rgba(0,0,0,0.25); padding-bottom: 32px; }
        label, .form-label { color: #f1f1f1; }
    </style>
</head>
<body>
<?php include 'adminnavbar.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4"><span class="me-2" style="font-size:1.5em;">✉️</span>Messages / Notifications</h2>
    <form method="post" class="mb-4" action="messages.php">
        <div class="mb-3">
            <label for="recipient_type" class="form-label">Send To</label>
            <select class="form-select" id="recipient_type" name="recipient_type" required onchange="toggleRecipientFields()">
                <option value="">Select Recipient Type</option>
                <option value="student">One Student</option>
                <option value="grade">A Grade / Class</option>
                <option value="all">Whole School</option>
            </select>
        </div>
        <div class="mb-3 d-none" id="studentField">
            <label for="student_id" class="form-label">Student</label>
            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter Student ID or Name">
        </div>
        <div class="mb-3 d-none" id="gradeField">
            <label for="grade" class="form-label">Grade / Class</label>
            <input type="text" class="form-control" id="grade" name="grade" placeholder="Enter Grade or Class">
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Message Subject" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
    <hr class="mb-4">
    <h4>Sent Messages</h4>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Recipient</th>
                    <th>Subject</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display sent messages (demo, replace with DB fetch)
                // Example: $messages = mysqli_query($conn, "SELECT * FROM messages ORDER BY sent_at DESC");
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
function toggleRecipientFields() {
    var type = document.getElementById('recipient_type').value;
    document.getElementById('studentField').classList.toggle('d-none', type !== 'student');
    document.getElementById('gradeField').classList.toggle('d-none', type !== 'grade');
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
