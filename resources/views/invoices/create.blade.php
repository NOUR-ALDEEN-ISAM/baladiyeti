<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء فاتورة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hacen+Tunisia&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Hacen Tunisia', sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
            padding: 10px;
            font-size: 1.2rem;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .alert {
            margin-top: 20px;
        }
        .form-control {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>إنشاء فاتورة</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('invoices.store') }}" method="POST" id="invoiceForm">
            @csrf
            <div class="mb-3">
                <label for="id_num" class="form-label">رقم الهوية</label>
                <input type="text" class="form-control" id="id_num" name="id_num" required>
            </div>
            <div class="mb-3">
                <label for="invoice_date" class="form-label">تاريخ الفاتورة</label>
                <input type="date" class="form-control" id="invoice_date" name="invoice_date" required>
            </div>
            <div class="mb-3">
                <label for="total_amount" class="form-label">المبلغ الإجمالي</label>
                <input type="number" class="form-control" id="total_amount" name="total_amount" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">الحالة</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="مدفوعة">مدفوعة</option>
                    <option value="غير مدفوعة">غير مدفوعة</option>
                    <option value="مؤجلة">مؤجلة</option>
                    <option value="ملغية">ملغية</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">النوع</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="مياه">مياه</option>
                    <option value="كهرباء">كهرباء</option>
                    <option value="خدمات البلدية">خدمات البلدية</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">إنشاء الفاتورة</button>
        </form>
        
        <div class="back-button mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">الرجوع</a>
        </div>
    </div>

    <script>
        document.getElementById('invoiceForm').addEventListener('submit', function(event) {
            var invoiceDate = new Date(document.getElementById('invoice_date').value);
            var today = new Date();
            today.setHours(0, 0, 0, 0); // Reset time to start of day
            if (invoiceDate > today) {
                alert('لا يمكن أن يكون تاريخ الفاتورة في المستقبل.');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
