<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tourism->name }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .attraction img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .attraction h1 {
            font-size: 2rem;
            color: #343a40;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 1.1rem;
            transition: background-color 0.2s, box-shadow 0.2s;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="attraction">
            <img src="{{ $tourism->photo }}" alt="{{ $tourism->name }}">
            <h1>{{ $tourism->name }}</h1>
            <p>{{ $tourism->description }}</p>
            <p><strong>الموقع:</strong> {{ $tourism->location }}</p>
            <a href="{{ route('tourism.index') }}" class="btn btn-secondary">الرجوع إلى القائمة</a>
        </div>
    </div>
</body>
</html>
