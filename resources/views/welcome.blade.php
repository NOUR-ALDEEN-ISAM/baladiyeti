<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: 'Hacen Tunisia';
            src: url('{{ asset('fonts/HacenTunisia.ttf') }}') format('truetype');
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Hacen Tunisia', 'Arial', sans-serif;
        }
        .header {
            margin-top: 100px;
            margin-bottom: 50px;
        }
        .card {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            font-size: 2rem;
            color: #333;
            font-weight: bold;
        }
        .card-text {
            color: #777;
            font-weight: bold;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            transition: background-color 0.3s ease;
            font-weight: bold;
            margin: 5px;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-info {
            background-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #138496;
        }
        .btn-warning {
            background-color: #ffc107;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        h1 {
            font-size: 3rem;
            color: #212529;
            font-weight: bold;
        }
        .alert {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container text-center header">
        <img src="{{ asset('images/baladiyeti.png') }}" alt="Baladiyeti Application Image" class="img-fluid mb-4" width="300">
        <h1 class="mb-4">مرحباً بك في تطبيق بلديتي</h1>
        
        <!-- قسم الإشعارات -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="row justify-content-center">
            <!-- قسم الأخبار -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/newspaper-folded.png') }}" alt="News Image" class="img-fluid mb-3" width="100">
                        <h5 class="card-title">الأخبار</h5>
                        <p class="card-text">استعرض وأضف الأخبار الجديدة</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('/news') }}" class="btn btn-primary mb-2">عرض الأخبار</a>
                            <a href="{{ url('/news/create') }}" class="btn btn-success mb-2">إضافة خبر جديد</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- قسم التقارير -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/report.png') }}" alt="Reports Image" class="img-fluid mb-3" width="100">
                        <h5 class="card-title">البلاغات</h5>
                        <p class="card-text">ردود البلاغات</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('/reports') }}" class="btn btn-info mb-2">رد البلاغات</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- قسم الفواتير -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/invoices.png') }}" alt="Invoices Image" class="img-fluid mb-3" width="100">
                        <h5 class="card-title">الفواتير</h5>
                        <p class="card-text">استعرض وأضف الفواتير الخاصة بك</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('/invoices') }}" class="btn btn-warning mb-2">عرض الفواتير</a>
                            <a href="{{ url('/invoices/create') }}" class="btn btn-success mb-2">إضافة فاتورة جديدة</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- قسم المعالم السياحية -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/tourist-attraction.png') }}" alt="Tourism Image" class="img-fluid mb-3" width="100">
                        <h5 class="card-title">المعالم السياحية</h5>
                        <p class="card-text">استعرض وأضف المعالم السياحية والمتاحف</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('/tourism') }}" class="btn btn-primary mb-2">عرض المعالم</a>
                            <a href="{{ url('/tourism/create') }}" class="btn btn-success mb-2">إضافة معلم جديد</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- قسم المواقع -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/pin.png') }}" alt="Locations Image" class="img-fluid mb-3" width="100">
                        <h5 class="card-title">المواقع</h5>
                        <p class="card-text">استعرض وأضف المواقع</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('/locations/all') }}" class="btn btn-primary mb-2">عرض المواقع</a>
                            <a href="{{ url('/map') }}" class="btn btn-success mb-2">إضافة موقع جديد</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- قسم المشاريع -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/project.png') }}" alt="Projects Image" class="img-fluid mb-3" width="100">
                        <h5 class="card-title">المشاريع</h5>
                        <p class="card-text">استعرض وأضف المشاريع الجديدة</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('/projects') }}" class="btn btn-primary mb-2">عرض المشاريع</a>
                            <a href="{{ url('/projects/create') }}" class="btn btn-success mb-2">إضافة مشروع جديد</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- قسم تعديل الملف الشخصي -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/userS.png') }}" alt="User Profile Image" class="img-fluid mb-3" width="100">
                        <h5 class="card-title">تعديل الملف الشخصي</h5>
                        <p class="card-text">تعديل معلومات الملف الشخصي للمستخدم</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('/user/search') }}" class="btn btn-primary mb-2">البحث عن المستخدم</a>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
