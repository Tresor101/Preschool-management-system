<?php
// open_ticket.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Ticket (Tech Support)</title>
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
    <h2 class="mb-4"><span class="me-2" style="font-size:1.5em;">🛠️</span>Open Ticket (Tech Support)</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name'] ?? '');
        $email = htmlspecialchars($_POST['email'] ?? '');
        $subject = htmlspecialchars($_POST['subject'] ?? '');
        $message = htmlspecialchars($_POST['message'] ?? '');
        $to = 'admin@ibangu.cloud';
        $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";
        $body = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";
        if (mail($to, "[Tech Support] $subject", $body, $headers)) {
            echo '<div class="alert alert-success">Your ticket has been submitted successfully!</div>';
        } else {
            echo '<div class="alert alert-danger">There was an error sending your ticket. Please try again later.</div>';
        }
    }
    ?>
    <form method="post" action="open_ticket.php" class="mb-4">
        <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Ticket</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
