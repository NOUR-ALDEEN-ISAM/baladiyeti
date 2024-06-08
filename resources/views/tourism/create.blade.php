<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة معلم جديد</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        .form-group label {
            font-weight: bold;
            color: #333;
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
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">إضافة معلم جديد</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('tourism.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">اسم المعلم</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="location_id">الموقع</label>
                <select class="form-control" id="location_id" name="location_id" required>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="location">وصف الموقع</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="form-group">
                <label for="photo">الصورة</label>
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div>
            <button type="submit" class="btn btn-primary">إضافة</button>
        </form>
    </div>
</body>
</html>
