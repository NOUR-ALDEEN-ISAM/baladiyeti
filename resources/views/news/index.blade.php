<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الأخبار</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hacen+Tunisia&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Hacen Tunisia', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .news-card {
            margin-bottom: 20px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .news-card:hover {
            transform: translateY(-10px);
        }
        .news-image {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .news-content {
            height: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #777;
        }
        .card-title {
            font-size: 1.25rem;
            color: #333;
        }
        .btn-primary, .btn-secondary, .btn-danger, .btn-success {
            border-radius: 50px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">آخر الأخبار</h1>
        <div class="text-right mb-3">
            <a href="{{ route('news.create') }}" class="btn btn-success">إضافة خبر جديد</a>
        </div>
        <div class="row">
            @foreach($news as $newsItem)
                <div class="col-md-4">
                    <div class="card news-card">
                        @if($newsItem->photo)
                            <img src="{{ $newsItem->photo }}" class="card-img-top news-image" alt="{{ $newsItem->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $newsItem->title }}</h5>
                            <p class="card-text news-content">{{ Str::limit($newsItem->content, 150) }}</p>
                            <a href="{{ route('news.show', $newsItem->id) }}" class="btn btn-primary">اقرأ المزيد</a>
                            <a href="{{ route('news.edit', $newsItem->id) }}" class="btn btn-secondary">تعديل</a>
                            <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="back-button mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">الرجوع</a>
        </div>
    </div>
</body>
</html>
