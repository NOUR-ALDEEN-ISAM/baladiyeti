<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المتاحف والمعالم السياحية</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .attraction {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .attraction:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .attraction img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .attraction h2 {
            font-size: 1.5rem;
            color: #343a40;
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
        .btn-add {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 1.1rem;
            margin-bottom: 20px;
            transition: background-color 0.2s, box-shadow 0.2s;
        }
        .btn-add:hover {
            background-color: #218838;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">المتاحف والمعالم السياحية</h1>
        <div class="text-right mb-4">
            <a href="{{ route('tourism.create') }}" class="btn btn-add">إضافة معلم جديد</a>
        </div>
        <div class="row">
            @foreach ($tourisms as $tourism)
                <div class="col-md-4">
                    <div class="attraction">
                        <img src="{{ $tourism->photo }}" alt="{{ $tourism->name }}">
                        <h2>{{ $tourism->name }}</h2>
                        <p>{{ Str::limit($tourism->description, 100) }}</p>
                        <p><strong>الموقع:</strong> {{ $tourism->location_id }}</p>
                        <a href="{{ route('tourism.show', $tourism->id) }}" class="btn btn-primary">عرض التفاصيل</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
