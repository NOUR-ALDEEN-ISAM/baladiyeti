<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المشاريع</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hacen+Tunisia&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Hacen Tunisia', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .modal img {
            width: 100%;
        }
        .container {
            margin-top: 50px;
        }
        h1, h2 {
            text-align: center;
        }
        .card-body {
            direction: rtl; /* لتكون النصوص بالعربية من اليمين لليسار */
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-5">المشاريع</h1>
    <hr>
    <h2>جميع المشاريع</h2>
    <div class="row">
        @foreach($projects as $project)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->name }}</h5>
                        <p class="card-text">{{ $project->description }}</p>
                        <p class="card-text"><strong>تاريخ البدء:</strong> {{ $project->start_date }}</p>
                        <p class="card-text"><strong>تاريخ الانتهاء:</strong> {{ $project->end_date }}</p>
                        <p class="card-text"><strong>الحالة:</strong> {{ $project->status }}</p>
                        @if ($project->photo)
                            <img src="{{ $project->photo }}" alt="Project Photo" class="img-fluid" style="cursor: pointer;" onclick="showModal('{{ $project->photo }}')">
                        @else
                            <p>No Photo</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal for image zoom -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <img id="modalImage" src="" alt="Project Photo">
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function showModal(imageUrl) {
        $('#modalImage').attr('src', imageUrl);
        $('#imageModal').modal('show');
    }
</script>
</body>
</html>
