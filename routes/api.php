<?php
use App\Http\Controllers\{
    ChatController, 
    InformationController, 
    InvoiceController,
    JobController,
    LocationController,
    PhotoController,
    ProjectController, 
    ReportController, 
    ReviewController, 
    SectionController, 
    TourismController,
    NewsController, 
    UserController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// مجموعة مسارات المستخدمين
Route::prefix('users')->group(function () {
Route::post('register', [UserController::class, 'reg']);
Route::post('change-password', [UserController::class, 'changePassword']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);
Route::get('all', [UserController::class, 'all']);
Route::get('{id}', [UserController::class, 'one2']);
Route::post('find', [UserController::class, 'one']);
Route::delete('{id}', [UserController::class, 'delete']);
Route::post('edit/{id}', [UserController::class, 'update']);
});

// مجموعة مسارات السياحة
Route::prefix('tourism')->group(function () {
    Route::post('add', [TourismController::class, 'add']);
    Route::get('all', [TourismController::class, 'all']);
    Route::get('{id}', [TourismController::class, 'one2']);
    Route::post('find', [TourismController::class, 'one']);
    Route::delete('{id}', [TourismController::class, 'delete']);
    Route::post('edit/{id}', [TourismController::class, 'update']);
});

// مجموعة مسارات المشاريع
Route::prefix('projects')->group(function () {
    Route::post('add', [ProjectController::class, 'add']);
    Route::get('all', [ProjectController::class, 'all']);
    Route::get('{id}', [ProjectController::class, 'one2']);
    Route::post('find', [ProjectController::class, 'one']);
    Route::delete('{id}', [ProjectController::class, 'delete']);
    Route::post('edit/{id}', [ProjectController::class, 'update']);
});

// مجموعة مسارات الأقسام
Route::prefix('sections')->group(function () {
    Route::post('add', [SectionController::class, 'add']);
    Route::get('all', [SectionController::class, 'all']);
    Route::get('{id}', [SectionController::class, 'one2']);
    Route::post('find', [SectionController::class, 'one']);
    Route::delete('{id}', [SectionController::class, 'delete']);
    Route::post('edit/{id}', [SectionController::class, 'update']);
});

// مجموعة مسارات الوظائف
Route::prefix('jobs')->group(function () {
    Route::post('add', [JobController::class, 'add']);
    Route::get('all', [JobController::class, 'all']);
    Route::get('{id}', [JobController::class, 'one2']);
    Route::post('find', [JobController::class, 'one']);
    Route::delete('{id}', [JobController::class, 'delete']);
    Route::post('edit/{id}', [JobController::class, 'update']);
});

// مجموعة مسارات التقييمات
Route::prefix('reviews')->group(function () {
    Route::post('add', [ReviewController::class, 'add']);
    Route::get('all', [ReviewController::class, 'all']);
    Route::get('{id}', [ReviewController::class, 'one2']);
    Route::post('find', [ReviewController::class, 'one']);
    Route::delete('{id}', [ReviewController::class, 'delete']);
    Route::post('edit/{id}', [ReviewController::class, 'update']);
});

// مجموعة مسارات التقارير
Route::prefix('reports')->group(function () {
    Route::post('add', [ReportController::class, 'add']);
    Route::get('all', [ReportController::class, 'all']);
    Route::get('{id}', [ReportController::class, 'one2']);
    Route::post('find', [ReportController::class, 'one']);
    Route::delete('{id}', [ReportController::class, 'delete']);
    Route::post('edit/{id}', [ReportController::class, 'update']);
});

// مجموعة مسارات الفواتير
Route::prefix('invoices')->group(function () {
    Route::post('add', [InvoiceController::class, 'store']);
    Route::get('all', [InvoiceController::class, 'index']);
    Route::get('{id}', [InvoiceController::class, 'show']);
    Route::post('find', [InvoiceController::class, 'one']);
    Route::delete('{id}', [InvoiceController::class, 'destroy']);
    Route::post('edit/{id}', [InvoiceController::class, 'update']);
});

// مجموعة مسارات الدردشة
Route::prefix('chats')->group(function () {
    Route::post('send', [ChatController::class, 'send']);
    Route::get('all', [ChatController::class, 'all']);
    Route::get('{id}', [ChatController::class, 'one2']);
    Route::post('find', [ChatController::class, 'one']);
    Route::delete('{id}', [ChatController::class, 'delete']);
    Route::post('edit/{id}', [ChatController::class, 'update']);
});

// مجموعة مسارات المعلومات
Route::prefix('informations')->group(function () {
    Route::post('add', [InformationController::class, 'store']);
    Route::get('all', [InformationController::class, 'all']);
    Route::get('{id}', [InformationController::class, 'one2']);
    Route::post('find', [InformationController::class, 'one']);
    Route::delete('{id}', [InformationController::class, 'delete']);
    Route::post('edit/{id}', [InformationController::class, 'update']);
});

// مجموعة مسارات المواقع
Route::prefix('locations')->group(function () {
    Route::post('add', [LocationController::class, 'store']);
    Route::get('all', [LocationController::class, 'index']);
    Route::get('{id}', [LocationController::class, 'show']);
    Route::put('{id}', [LocationController::class, 'update']);
    Route::delete('{id}', [LocationController::class, 'destroy']);
    Route::post('{id}/make-special', [LocationController::class, 'makeSpecial']);
});
Route::prefix('news')->group(function () {
    Route::get('all', [NewsController::class, 'all']); // عرض جميع الأخبار
    Route::get('show/{id}', [NewsController::class, 'show']); // عرض خبر معين
    Route::post('add', [NewsController::class, 'add']); // إضافة خبر جديد
    Route::put('update/{id}', [NewsController::class, 'update']); // تحديث خبر معين
    Route::delete('del/{id}', [NewsController::class, 'delete']); // حذف خبر معين
    Route::post('find/find', [NewsController::class, 'find']); // البحث عن خبر بناءً على ID
});
// رفع الصور
Route::post('photos/upload', [PhotoController::class, 'upload']);
