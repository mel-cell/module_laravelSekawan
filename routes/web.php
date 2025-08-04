<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::controller(HomeController::class)->group(function () {
//     Route::get('/', 'index');
// });

// Route untuk halaman register
Route::get('/register', [RegisterController::class, 'index'])->name('register');

// Route untuk proses submit form
Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');