<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحديث استجابة التقرير</title>
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
        .small-img {
            max-width: 200px;
            cursor: pointer;
        }
        .modal-img {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">تحديث استجابة التقرير</h2>
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
                    <img src="{{ asset($report->photo_1) }}" alt="صورة المواطن" class="img-fluid rounded img-thumbnail small-img" data-toggle="modal" data-target="#imageModal">
                @endif
            </div>
        </div>

        <form action="{{ route('reports.updateResponse', ['id' => $report->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text_2">نص الاستجابة</label>
                <textarea class="form-control" id="text_2" name="text_2" rows="4">{{ $report->text_2 }}</textarea>
            </div>
            <div class="form-group">
                <label for="photo_2">صورة الاستجابة</label>
                <input type="file" class="form-control-file" id="photo_2" name="photo_2">
            </div>
            <button type="submit" class="btn btn-primary">تحديث الاستجابة</button>
        </form>

        @if($report->text_2 || $report->photo_2)
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">استجابة التقرير</h5>
                @if($report->text_2)
                    <p class="card-text"><strong>النص:</strong> {{ $report->text_2 }}</p>
                @endif
                @if($report->photo_2)
                    <p class="card-text"><strong>الصورة:</strong></p>
                    <img src="{{ asset($report->photo_2) }}" alt="صورة الاستجابة" class="img-fluid rounded img-thumbnail small-img" data-toggle="modal" data-target="#imageModal">
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="صورة مكبرة" class="modal-img">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.small-img').on('click', function() {
                var imgSrc = $(this).attr('src');
                $('.modal-img').attr('src', imgSrc);
            });
        });
    </script>
</body>
</html>
