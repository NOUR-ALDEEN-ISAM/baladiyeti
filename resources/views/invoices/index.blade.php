<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الفواتير</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hacen+Tunisia&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Hacen Tunisia', Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 900px;
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
        table {
            width: 100%;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        .search-form {
            margin-bottom: 30px;
        }
        .back-button {
            margin-bottom: 20px;
        }
        .btn-danger {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>عرض الفواتير</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('invoices.index') }}" method="GET" class="search-form">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="id_num" placeholder="ابحث عن طريق رقم الهوية" aria-label="ابحث عن طريق رقم الهوية" aria-describedby="button-search">
                <button class="btn btn-primary" type="submit" id="button-search">بحث</button>
            </div>
        </form>

        @if ($invoices->isEmpty())
            <div class="alert alert-warning">
                لا يوجد شخص بهذا الرقم
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>رقم الفاتورة</th>
                        <th>رقم الهوية</th>
                        <th>تاريخ الفاتورة</th>
                        <th>المبلغ الإجمالي</th>
                        <th>الحالة</th>
                        <th>النوع</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->id_num }}</td>
                            <td>{{ $invoice->invoice_date }}</td>
                            <td>{{ $invoice->total_amount }}</td>
                            <td>{{ $invoice->status }}</td>
                            <td>{{ $invoice->type }}</td>
                            <td>
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذه الفاتورة؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="back-button">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">الرجوع</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form[method="POST"]').forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!confirm('هل أنت متأكد أنك تريد حذف هذه الفاتورة؟')) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>
