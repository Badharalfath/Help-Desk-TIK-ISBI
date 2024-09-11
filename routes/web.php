<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\RegInternetController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TambahTiketController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\FormFAQController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\EditTiketController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route Public
route::get('/', [HomeController::class, 'index'])->name('home');
route::get('/login', [LoginController::class, 'index'])->name('login');
route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/faq', [FAQController::class, 'index'])->name('faq');
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
Route::get('/maintenance/generate-report', [MaintenanceController::class, 'generateReport'])->name('maintenance.generateReport');
Route::post('/maintenance/generateReport', [MaintenanceController::class, 'generateReport'])->name('maintenance.generateReport');
Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
Route::get('/reginternet', [RegInternetController::class, 'index'])->name('reginternet');
Route::get('/complaint', [ComplaintController::class, 'showForm'])->name('complaint');

// Route Dashboard

Route::middleware(['auth.all'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tiket', [TiketController::class, 'index'])->name('tiket');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::get('/tickets/pdf', [TiketController::class, 'generatePdf'])->name('tickets.generatePdf');
});

Route::middleware(['auth.admin'])->group(function () {
    Route::get('/edittiket', [EditTiketController::class, 'index'])->name('edittiket');
    Route::get('/tickets/{id}/edit', [EditTiketController::class, 'edit'])->name('ticket.edit');
    Route::post('/tickets/{id}', [EditTiketController::class, 'update'])->name('ticket.update');
    Route::get('/formfaq', [FormFAQController::class, 'index'])->name('formfaq.index');
    Route::post('/formfaq', [FormFAQController::class, 'store'])->name('formfaq.store');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{id}/edit-foto-kedua', [JadwalController::class, 'editFotoKedua'])->name('jadwal.editFotoKedua');
    Route::post('/jadwal/{id}/update-foto-kedua', [JadwalController::class, 'updateFotoKedua'])->name('jadwal.updateFotoKedua');
    Route::post('/jadwal/{id}/update-foto-kedua', [JadwalController::class, 'updateFotoKedua'])->name('jadwal.updateFotoKedua');
    Route::get('/tambahtiket', [TambahTiketController::class, 'showForm'])->name('tambahtiket');

});

Route::resource('tickets', EditTiketController::class);
Route::resource('dash.jadwal', JadwalController::class);

// Route User login
Route::get('/admin', [DashboardController::class, 'index']);

Route::post('/complaint', [ComplaintController::class, 'submitForm'])->name('submit.complaint');
Route::post('/tambahtiket', [TambahTiketController::class, 'submitForm'])->name('submit.tambahtiket');
Route::post('/login', [LoginController::class, 'login']);
