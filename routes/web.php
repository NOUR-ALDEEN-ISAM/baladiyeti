<?php

use App\Models\Location;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\ReportController;
use App\Http\Controllers\Web\InvoiceController;
use App\Http\Controllers\Web\TourismController;
use App\Http\Controllers\Web\ProjectController;
use App\Http\Controllers\Web\LocationController;
use App\Http\Controllers\Web\UserController;



// التوجيه للصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// عرض الخريطة
Route::get('/map', function () {
    $locations = Location::all();
    return view('map', compact('locations'));
});


Route::prefix('user')->group(function () {
    Route::get('search', [UserController::class, 'search'])->name('user.search');
    Route::post('find', [UserController::class, 'find'])->name('user.find');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
});

// مجموعة مسارات المشاريع
Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'all'])->name('projects.all');
    Route::get('create', function () {
        return view('projects.create_project');
    })->name('projects.create');
    Route::post('/', [ProjectController::class, 'add'])->name('projects.add');
    Route::get('{id}', [ProjectController::class, 'one'])->name('projects.one');
    Route::put('{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('{id}', [ProjectController::class, 'delete'])->name('projects.delete');
});

// مجموعة مسارات المواقع
Route::prefix('locations')->group(function () {
    Route::get('all', [LocationController::class, 'index'])->name('locations.index');
    Route::get('create', [LocationController::class, 'create'])->name('locations.create');
    Route::post('store', [LocationController::class, 'store'])->name('locations.store');
    Route::get('{id}', [LocationController::class, 'show'])->name('locations.show');
    Route::get('{id}/edit', [LocationController::class, 'edit'])->name('locations.edit');
    Route::put('{id}', [LocationController::class, 'update'])->name('locations.update');
    Route::delete('{id}', [LocationController::class, 'destroy'])->name('locations.destroy');
    Route::post('{id}/make-special', [LocationController::class, 'makeSpecial'])->name('locations.makeSpecial');
});

// مجموعة مسارات الأخبار
Route::prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('news.index');
    Route::get('create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/', [NewsController::class, 'store'])->name('news.store');
    Route::get('{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('{id}', [NewsController::class, 'update'])->name('news.update');
    Route::get('{id}', [NewsController::class, 'show'])->name('news.show');
    Route::delete('{id}', [NewsController::class, 'destroy'])->name('news.destroy');
});

// مجموعة مسارات التقارير
Route::prefix('reports')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('reports.index');
    Route::get('update-response/{id}', [ReportController::class, 'showUpdateResponseForm'])->name('reports.showUpdateResponseForm');
    Route::post('update-response/{id}', [ReportController::class, 'updateResponse'])->name('reports.updateResponse');
});

// مجموعة مسارات الفواتير
Route::prefix('invoices')->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('store', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::delete('{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
});

// مجموعة مسارات السياحة
Route::prefix('tourism')->group(function () {
    Route::get('/', [TourismController::class, 'index'])->name('tourism.index');
    Route::get('create', [TourismController::class, 'create'])->name('tourism.create');
    Route::post('/', [TourismController::class, 'store'])->name('tourism.store');
    Route::get('{id}', [TourismController::class, 'show'])->name('tourism.show');
});
