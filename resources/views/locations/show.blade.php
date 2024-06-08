<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الموقع</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hacen+Tunisia&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Hacen Tunisia', Arial, sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin-top: 50px;
        }
        h1 {
            color: #007bff;
            margin-bottom: 30px;
            text-align: center;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 1.5rem;
            color: #333;
        }
        .btn-secondary {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">عرض الموقع</h1>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $location->name }}</h3>
                <a href="{{ route('locations.index') }}" class="btn btn-secondary mt-3">العودة إلى القائمة</a>
            </div>
        </div>
    </div>
</body>
</html>
