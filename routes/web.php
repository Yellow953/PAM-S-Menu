<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/qr_code', [HomeController::class, 'qrcode'])->name('qrcode');
Route::get('/', [HomeController::class, 'index'])->name('home');
