<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة مشروع جديد</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hacen+Tunisia&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Hacen Tunisia', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-success {
            border-radius: 50px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>إضافة مشروع جديد</h2>
    <form action="{{ route('projects.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">اسم المشروع</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">الوصف</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="start_date">تاريخ البدء</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">تاريخ الانتهاء</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <div class="form-group">
            <label for="status">الحالة</label>
            <select class="form-control" id="status" name="status" required>
                <option value="planned" {{ $project->status == 'planned' ? 'selected' : '' }}>مخطط</option>
                <option value="ongoing" {{ $project->status == 'ongoing' ? 'selected' : '' }}>قيد التنفيذ</option>
                <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                <option value="on-hold" {{ $project->status == 'on-hold' ? 'selected' : '' }}>متوقف</option>
                <option value="canceled" {{ $project->status == 'canceled' ? 'selected' : '' }}>ملغى</option>
            </select>
        </div>
        <div class="form-group">
            <label for="photo">الصورة</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
        </div>
        <button type="submit" class="btn btn-success">إضافة</button>
    </form>
</div>
</body>
</html>
