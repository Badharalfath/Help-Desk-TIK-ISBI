<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\MonitoringController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MaintenanceController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route Public
route::get('/',[HomeController::class,'index'])->name('home');
route::get('/login',[LoginController::class,'index'])->name('login');
Route::get('/faq', [FAQController::class, 'index'])->name('faq');
Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
Route::get('/complaint', [ComplaintController::class, 'showForm'])->name('complaint');
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');

// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/tiket', [TiketController::class, 'index'])->name('tiket');
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');


Route::post('/complaint/submit', [ComplaintController::class, 'submitForm'])->name('complaint.submit');
