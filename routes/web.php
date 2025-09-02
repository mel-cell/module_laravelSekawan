<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;   
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\ShelfController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\User\BorrowingController as UserBorrowingController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;


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

// Home page
Route::get('/', [HomeController::class, 'index'])->name('Home');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin Routes
Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/author', [AdminAuthorController::class, 'index'])->name('admin.author');
    Route::post('/author', [AdminAuthorController::class, 'store'])->name('admin.author.store');
    Route::put('/author/{id}', [AdminAuthorController::class, 'update'])->name('admin.author.update');
    Route::delete('/author/{id}', [AdminAuthorController::class, 'destroy'])->name('admin.author.destroy');

    // publisher routes
    Route::get('/publisher', [PublisherController::class, 'index'])->name('admin.publisher');
    Route::post('/publisher', [PublisherController::class, 'store'])->name('admin.publisher.store');
    Route::put('/publisher/{id}', [PublisherController::class, 'update'])->name('admin.publisher.update');
    Route::delete('/publisher/{id}', [PublisherController::class, 'destroy'])->name('admin.publisher.destroy');

    // shelf routes
    Route::get('/shelf', [ShelfController::class, 'index'])->name('admin.shelf');
    Route::post('/shelf', [ShelfController::class, 'store'])->name('admin.shelf.store');
    Route::put('/shelf/{id}', [ShelfController::class, 'update'])->name('admin.shelf.update');
    Route::delete('/shelf/{id}', [ShelfController::class, 'destroy'])->name('admin.shelf.destroy');

    // category routes
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    // book routes
    Route::get('/book', [BookController::class, 'index'])->name('admin.books');
    Route::get('/book/create', [BookController::class, 'create'])->name('admin.books.create');
    Route::post('/book', [BookController::class, 'store'])->name('admin.books.store');
    Route::get('/book/{book_id}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/book/{book_id}', [BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/book/{book_id}', [BookController::class, 'destroy'])->name('admin.books.destroy');

    // borrowing routes
    Route::get('/borrowings', [AdminBorrowingController::class, 'index'])->name('admin.borrowing.index');
    Route::get('/borrowings/create', [AdminBorrowingController::class, 'create'])->name('admin.borrowing.create');
    Route::post('/borrowings', [AdminBorrowingController::class, 'store'])->name('admin.borrowing.store');
    Route::get('/borrowings/{id}', [AdminBorrowingController::class, 'show'])->name('admin.borrowing.show');
    Route::delete('/borrowings/{id}', [AdminBorrowingController::class, 'destroy'])->name('admin.borrowing.destroy');
    Route::post('/borrowings/{id}/return', [AdminBorrowingController::class, 'returnBook'])->name('admin.borrowing.return');
    Route::get('/borrowings/get-book-item-form', [AdminBorrowingController::class, 'getBookItemForm'])->name('admin.borrowing.getBookItemForm');
});

// User Routes
Route::prefix('/user')->middleware(['auth'])->group(function() {
    Route::get('/', [UserHomeController::class, 'index'])->name('user.Home');
    Route::get('/settings', [UserHomeController::class, 'settings'])->name('user.settings');

    // borrowing routes
    Route::get('/my-borrowings', [UserBorrowingController::class, 'index'])->name('user.borrowing.index');
    Route::get('/my-borrowings/{id}', [UserBorrowingController::class, 'show'])->name('user.borrowing.show');
});
