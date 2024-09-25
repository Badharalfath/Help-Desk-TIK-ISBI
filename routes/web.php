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
use App\Http\Controllers\InputUserController;
use App\Http\Controllers\ListJadwalController;
use App\Http\Controllers\WallmountController;
use Illuminate\Support\Facades\Route;

route::get('/', [HomeController::class, 'index'])->name('home');

// Mengarahkan user yang sudah login ke dashboard
route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/faq', [FAQController::class, 'index'])->name('faq');
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
Route::get('/maintenance/generate-report', [MaintenanceController::class, 'generateReport'])->name('maintenance.generateReport');
Route::post('/maintenance/generateReport', [MaintenanceController::class, 'generateReport'])->name('maintenance.generateReport');
Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
Route::get('/reginternet', [RegInternetController::class, 'index'])->name('reginternet');
Route::get('/regemail', [RegInternetController::class, 'email'])->name('regemail');
Route::get('/complaint', [ComplaintController::class, 'showForm'])->name('complaint');

// Route Dashboard
Route::middleware(['auth.all'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tiket', [TiketController::class, 'index'])->name('tiket');

    Route::get('/listjadwal', [ListJadwalController::class, 'index'])->name('listjadwal');
    Route::get('/tickets/pdf', [TiketController::class, 'generatePdf'])->name('tickets.generatePdf');

    // Route FAQ
    Route::get('/daftarfaq', [FormFAQController::class, 'menu'])->name('faq.index');
    // Route Users
    Route::get('/user', [InputUserController::class, 'index'])->name('user');

});

Route::middleware(['auth.admin'])->group(function () {

    Route::get('/edittiket', [EditTiketController::class, 'index'])->name('edittiket');
    Route::get('/tickets/{id}/edit', [EditTiketController::class, 'edit'])->name('ticket.edit');

    Route::post('/tickets/{id}', [EditTiketController::class, 'update'])->name('ticket.update');

    // Route FAQ

    Route::get('/formfaq', [FormFAQController::class, 'index'])->name('formfaq.index');
    Route::get('/faq/{id}', [FormFAQController::class, 'show'])->name('faq.show');
    Route::post('/formfaq', [FormFAQController::class, 'store'])->name('formfaq.store');
    Route::get('/faq/{id}/edit', [FormFAQController::class, 'edit'])->name('faq.edit');
    Route::put('/faq/{id}', [FormFAQController::class, 'update'])->name('faq.update');
    Route::delete('/faq/{id}', [FormFAQController::class, 'destroy'])->name('faq.destroy');

    // Route Users
    Route::get('/inuser', [InputUserController::class, 'create'])->name('inuser');
    Route::get('/users/create', [InputUserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [InputUserController::class, 'store'])->name('users.store');
    Route::resource('users', InputUserController::class);

    // Route Jadwal
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{id}/edit-foto-kedua', [JadwalController::class, 'editFotoKedua'])->name('jadwal.editFotoKedua');
    Route::post('/jadwal/{id}/update-foto-kedua', [JadwalController::class, 'updateFotoKedua'])->name('jadwal.updateFotoKedua');
    Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal/store', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::post('/update-status/{id}', [ListJadwalController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/perangkat-by-wallmount/{id}', [JadwalController::class, 'getPerangkatByWallmount']);


    // Route Tiket
    Route::get('/tambahtiket', [TambahTiketController::class, 'showForm'])->name('tambahtiket');
    Route::resource('tickets', EditTiketController::class);

    // Route Wallmount
    Route::get('/wallmount', [WallmountController::class, 'index'])->name('wallmount.index');
    Route::get('/wallmount/create', [WallmountController::class, 'create'])->name('wallmount.create');
    Route::post('/wallmount/store', [WallmountController::class, 'store'])->name('wallmount.store');
    Route::get('/wallmount/{id}', [WallmountController::class, 'show'])->name('wallmount.show');
    Route::get('/wallmount/{id}/edit', [WallmountController::class, 'edit'])->name('wallmount.edit');
    Route::put('/wallmount/{id}', [WallmountController::class, 'update'])->name('wallmount.update');
    Route::delete('/wallmount/{id}', [WallmountController::class, 'destroy'])->name('wallmount.destroy');




});

// Route User login
Route::get('/admin', [DashboardController::class, 'index']);
Route::post('/complaint', [ComplaintController::class, 'submitForm'])->name('submit.complaint');
Route::post('/tambahtiket', [TambahTiketController::class, 'submitForm'])->name('submit.tambahtiket');
Route::post('/login', [LoginController::class, 'login']);
