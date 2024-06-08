<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hacen+Tunisia&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Hacen Tunisia', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-title {
            font-size: 1.5rem;
            color: #333;
        }
        .card-text {
            color: #777;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 50px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $news->title }}</h1>
        <div class="card mx-auto" style="max-width: 800px;">
            @if($news->photo)
                <img src="{{ $news->photo }}" class="card-img-top" alt="{{ $news->title }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $news->title }}</h5>
                <p class="card-text">{{ $news->content }}</p>
                <p class="card-text"><small class="text-muted">نشر في: {{ $news->published_at }}</small></p>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('news.index') }}" class="btn btn-secondary">عودة إلى الأخبار</a>
        </div>
        <div class="back-button text-center mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">الرجوع</a>
        </div>
    </div>
</body>
</html>
