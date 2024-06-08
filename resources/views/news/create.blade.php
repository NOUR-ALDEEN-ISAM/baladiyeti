<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة خبر جديد</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hacen+Tunisia&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Hacen Tunisia', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 50px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 50px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">إضافة خبر جديد</h1>
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">عنوان الخبر</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <label for="content">محتوى الخبر</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
            </div>
            <div class="form-group">
                <label for="published_at">تاريخ النشر</label>
                <input type="date" class="form-control" id="published_at" name="published_at" value="{{ old('published_at') }}">
            </div>
            <div class="form-group">
                <label for="photo">صورة الخبر</label>
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">إضافة الخبر</button>
            </div>
        </form>
        <div class="back-button mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">الرجوع</a>
        </div>
    </div>
</body>
</html>
