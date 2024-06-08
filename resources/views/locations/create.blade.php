<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة موقع جديد</title>
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
        h2 {
            color: #007bff;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-success {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }
        .alert-danger {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>إضافة موقع جديد</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('locations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">اسم الموقع</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">إضافة الموقع</button>
        </form>
    </div>
</body>
</html>
