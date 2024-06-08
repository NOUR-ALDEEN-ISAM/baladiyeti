<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل كلمة المرور</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            text-align: center;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-top: 20px;
        }

        h2 {
            color: #333;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- {{$user}} -->
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>تعديل كلمة المرور</h2>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form id="change-password-form">
                @csrf

                <div class="form-group">
                    <label for="name">اسم المستخدم</label>
                    <input type="text" class="form-control" id="name" name="name" required  value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" id="id" name="id" required  value="{{$user->id}}">
                </div>
                <div class="form-group">
                    <label for="new_password">كلمة المرور الجديدة</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">تأكيد كلمة المرور الجديدة</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById('change-password-form').addEventListener('submit', function(event) {
        event.preventDefault(); // منع إرسال النموذج بشكل افتراضي

        let formData = {
            _token: document.querySelector('input[name="_token"]').value,
            name: document.getElementById('name').value,
            id: document.getElementById('id').value,
            new_password: document.getElementById('new_password').value,
            new_password_confirmation: document.getElementById('new_password_confirmation').value
        };

        fetch('{{ route("user.changePassword") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData._token // Include CSRF token in headers
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status === true) {
                alert('تم تغيير كلمة المرور بنجاح');
                location.href = "/";
            } else {
                alert('حدث خطأ أثناء تغيير كلمة المرور');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>

</body>
</html>
