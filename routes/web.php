<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/news/{slug}', [HomeController::class, 'show'])->name('news.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('/admin/users', UserController::class);
    Route::resource('/admin/categories', CategoryController::class);
    Route::resource('/admin/articles', ArticleController::class);
    Route::resource('/admin/tags', TagController::class);

    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
});


