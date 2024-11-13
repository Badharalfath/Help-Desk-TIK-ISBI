<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\RegInternetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\TambahTiketController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\FormFAQController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\EditTiketController;
use App\Http\Controllers\InputUserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ListJadwalController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PenempatanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\TambahPengadaanController;
use App\Http\Controllers\WallmountController;
use App\Http\Controllers\WallmountPerangkatController;
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


    // Route Managemen
    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{kd_barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{kd_barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{kd_barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kd_kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kd_kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kd_kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/penempatan', [PenempatanController::class, 'index'])->name('penempatan'); // Removed 'penempatan.index'
    Route::get('/penempatan-tambah', [PenempatanController::class, 'create'])->name('penempatan-tambah');
    Route::post('/penempatan', [PenempatanController::class, 'store'])->name('penempatan.store');
    Route::get('penempatan/{kd_penempatan}/edit', [PenempatanController::class, 'edit'])->name('penempatan.edit');
    Route::put('penempatan/{kd_penempatan}', [PenempatanController::class, 'update'])->name('penempatan.update');
    Route::delete('penempatan/{kd_penempatan}', [PenempatanController::class, 'destroy'])->name('penempatan.destroy');
    Route::get('/penempatan/generate-pdf', [PenempatanController::class, 'generatePdf'])->name('penempatan.generate-pdf');
    Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan');
    Route::delete('/pengadaan/{kd_transaksi}', [PengadaanController::class, 'destroy'])->name('transaksi.destroy');
    Route::post('/generate-pdf', [PengadaanController::class, 'generatePDF'])->name('generate-pdf');

    Route::get('/tambah-pengadaan', [TambahPengadaanController::class, 'index'])->name('tambah-pengadaan');
    Route::post('/pengadaan', [TambahPengadaanController::class, 'store'])->name('pengadaan.store');
    Route::get('/departemen', [DepartemenController::class, 'index'])->name('departemen');
    Route::get('/departemen/tambah', [DepartemenController::class, 'create'])->name('departemen.create');
    Route::post('/departemen/tambah', [DepartemenController::class, 'store'])->name('departemen.store');
    Route::get('/departemen/{kode}/edit', [DepartemenController::class, 'edit'])->name('departemen.edit');
    Route::put('/departemen/{kode}', [DepartemenController::class, 'update'])->name('departemen.update');
    Route::delete('/departemen/{kode}', [DepartemenController::class, 'destroy'])->name('departemen.destroy');
    Route::get('/get-lokasi/{departemenId}', [PenempatanController::class, 'getLokasi']);
    Route::get('/penempatan/{kd_penempatan}', [PenempatanController::class, 'show'])->name('penempatan.show');
    Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi');
    Route::get('/lokasi/create', [LokasiController::class, 'create'])->name('lokasi.create');
    Route::post('/lokasi', [LokasiController::class, 'store'])->name('lokasi.store');
    Route::get('/lokasi/{kode}/edit', [LokasiController::class, 'edit'])->name('lokasi.edit');
    Route::put('/lokasi/{kode}', [LokasiController::class, 'update'])->name('lokasi.update');
    Route::delete('/lokasi/{kode}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');


    // Route FAQ
    Route::get('/faq/menu', [FormFAQController::class, 'menu'])->name('faq.menu');
    Route::get('/formfaq', [FormFAQController::class, 'index'])->name('formfaq.index');
    Route::get('/faq/{id}', [FormFAQController::class, 'show'])->name('faq.show');
    Route::post('/formfaq', [FormFAQController::class, 'store'])->name('formfaq.store');
    Route::get('/faq/{kd_faq}/edit', [FormFAQController::class, 'edit'])->name('faq.edit');
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
    Route::get('/wallmounts', [WallmountController::class, 'index'])->name('wallmounts.index');
    Route::get('/wallmount-qr/{id}', [WallmountPerangkatController::class, 'show'])->name('wallmount-qr.show');
});

// Route User login
Route::get('/admin', [DashboardController::class, 'index']);
Route::post('/complaint', [ComplaintController::class, 'submitForm'])->name('submit.complaint');
Route::post('/tambahtiket', [TambahTiketController::class, 'submitForm'])->name('submit.tambahtiket');
Route::post('/login', [LoginController::class, 'login']);
