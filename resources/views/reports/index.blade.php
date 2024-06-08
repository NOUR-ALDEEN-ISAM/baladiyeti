<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحديث استجابة التقارير</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hacen+Tunisia&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Hacen Tunisia', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 900px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            font-size: 1.5rem;
            color: #333;
        }
        .card-text {
            color: #555;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 1.1rem;
            transition: background-color 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .alert {
            border-radius: 15px;
        }
        .form-group label {
            font-weight: bold;
            color: #333;
        }
        .form-control-file {
            border-radius: 8px;
            transition: border-color 0.2s;
        }
        .form-control-file:focus {
            border-color: #007bff;
        }
        .img-thumbnail {
            max-width: 150px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">تحديث استجابة التقارير</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @foreach ($reports as $report)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">معلومات المواطن</h5>
                    @if($report->user)
                        <p class="card-text"><strong>الاسم:</strong> {{ $report->user->name }}</p>
                        <p class="card-text"><strong>رقم الهاتف:</strong> {{ $report->user->phone }}</p>
                    @else
                        <p class="card-text text-danger">معلومات المواطن غير متوفرة</p>
                    @endif
                    <p class="card-text"><strong>النص:</strong> {{ $report->text_1 }}</p>
                    @if($report->photo_1)
                        <p class="card-text"><strong>الصورة:</strong></p>
                        <a href="{{ route('reports.showUpdateResponseForm', ['id' => $report->id]) }}">
                            <img src="{{ asset($report->photo_1) }}" alt="صورة المواطن" class="img-fluid rounded img-thumbnail">
                        </a>
                    @endif
                    <p class="card-text"><strong>حالة الرد:</strong> 
                        @if($report->text_2 || $report->photo_2)
                            <span class="text-success">تم الرد</span>
                        @else
                            <span class="text-danger">لم يتم الرد</span>
                        @endif
                    </p>
                    <a href="{{ route('reports.showUpdateResponseForm', ['id' => $report->id]) }}" class="btn btn-primary">الرد</a>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
