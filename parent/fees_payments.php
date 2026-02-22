<?php
// fees_payments.php
// This page will serve as the Fees / Payments management interface for admins.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees / Payments</title>
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
        .card {
            background: #23272f;
            color: #f1f1f1;
            box-shadow: 0 2px 8px 0 rgba(0,0,0,0.18);
        }
        .table-responsive {
            background: #23272f;
            border-radius: 12px;
            box-shadow: 0 1px 4px 0 rgba(0,0,0,0.12);
        }
        .table {
            color: #f1f1f1;
        }
        .table thead.table-dark th {
            background-color: #181a20;
            color: #f1f1f1;
        }
        .form-control, .form-select {
            background-color: #23272f;
            color: #f1f1f1;
            border: 1px solid #444857;
        }
        .form-control:focus, .form-select:focus {
            background-color: #23272f;
            color: #fff;
            border-color: #0d6efd;
        }
        label, .form-label {
            color: #e0e0e0;
        }
        .btn-success {
            background-color: #198754;
            border-color: #198754;
        }
        .btn-success:hover {
            background-color: #157347;
            border-color: #146c43;
        }
    </style>
</head>
<body>
    <?php include 'adminnavbar.php'; ?>
    <div class="container mt-5">
        <h2 class="mb-4">💵 Fees / Payments</h2>
        <!-- Add Payment Form (frontend only) -->
        <div class="card mb-4 p-4" style="background: #22252b; max-width: 600px; margin: 0 auto;">
            <form id="addPaymentForm">
                <div class="text-center mb-3">
                    <span style="font-size:2.2em;">💵</span>
                    <h4 class="mt-2 mb-0" style="color:#fff;">Add New Payment</h4>
                </div>
                <div class="row mb-3 g-2">
                    <div class="col-md-5">
                        <label for="student_id" class="form-label"><span style="font-size:1.2em">🆔</span> Student ID</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter student ID" required>
                    </div>
                    <div class="col-md-4">
                        <label for="amount" class="form-label"><span style="font-size:1.2em">💰</span> Amount</label>
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="0.00" required style="min-width:120px;">
                            <select class="form-select" id="currency" name="currency" style="min-width: 120px;" required>
                                <option value="USD">USD</option>
                                <option value="FC">FC</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="payment_method" class="form-label"><span style="font-size:1.2em">💳</span> Method</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="Cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="remarks" class="form-label"><span style="font-size:1.2em">📝</span> Remarks / Reason</label>
                    <textarea class="form-control" id="remarks" name="remarks" rows="2" placeholder="Optional"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100 py-2" style="font-size: 1.1em;">➕ Add Payment</button>
            </form>
        </div>
        <div class="table-responsive">
        <div class="mb-3 d-flex justify-content-end">
            <input type="text" id="studentSearch" class="form-control" placeholder="🔍 Search by student ID..." style="max-width: 320px; background: #181a20; color: #f1f1f1; border: 1px solid #444857;">
        </div>
        <table class="table table-bordered table-striped" id="paymentsTable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Amount</th>
                        <th>Currency</th>
                        <th>Method</th>
                        <th>Reference No</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>STU001</td>
                        <td>500.00</td>
                        <td>USD</td>
                        <td>Cash</td>
                        <td>REF12345</td>
                        <td>First installment</td>
                        <td>2026-02-10 09:15:00</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>STU002</td>
                        <td>750.00</td>
                        <td>FC</td>
                        <td>Bank Transfer</td>
                        <td>REF67890</td>
                        <td>Full payment</td>
                        <td>2026-02-12 11:30:00</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>STU003</td>
                        <td>300.00</td>
                        <td>USD</td>
                        <td>Cheque</td>
                        <td>REF24680</td>
                        <td>Second installment</td>
                        <td>2026-02-14 14:45:00</td>
                    </tr>
                </tbody>
            </table>
                           <!-- Edit button removed -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

    // Frontend only: Add new payment row to table
    document.getElementById('addPaymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const table = document.getElementById('paymentsTable').getElementsByTagName('tbody')[0];
        const rowCount = table.rows.length + 1;
        const student_id = document.getElementById('student_id').value;
        const amount = parseFloat(document.getElementById('amount').value).toFixed(2);
        const currency = document.getElementById('currency').value;
        const payment_method = document.getElementById('payment_method').value;
        const reference_no = 'REF' + Date.now() + Math.floor(Math.random() * 1000);
        const remarks = document.getElementById('remarks').value;
        const created_at = new Date().toISOString().slice(0, 19).replace('T', ' ');
        const newRow = table.insertRow(0);
        newRow.innerHTML = `
            <td>${rowCount}</td>
            <td>${student_id}</td>
            <td>${amount}</td>
            <td>${currency}</td>
            <td>${payment_method}</td>
            <td>${reference_no}</td>
            <td>${remarks}</td>
            <td>${created_at}</td>
        `;
        this.reset();
    });

    // Filter payments by student name
    document.getElementById('studentSearch').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const table = document.getElementById('paymentsTable');
        const trs = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        for (let i = 0; i < trs.length; i++) {
            const studentCell = trs[i].getElementsByTagName('td')[1];
            if (studentCell) {
                const studentId = studentCell.textContent || studentCell.innerText;
                trs[i].style.display = studentId.toLowerCase().includes(filter) ? '' : 'none';
            }
        }
    });

    // Edit functionality removed with Action column
    </script>
</body>
</html>
