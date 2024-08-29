<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ComplaintController;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

route::get('/',[HomeController::class,'index'])->name('home');
route::get('/login',[LoginController::class,'index'])->name('login');
Route::get('/faq', [FAQController::class, 'index'])->name('faq');
Route::get('/complaint', [ComplaintController::class, 'showForm'])->name('complaint');

Route::post('/complaint/submit', [ComplaintController::class, 'submitForm'])->name('complaint.submit');