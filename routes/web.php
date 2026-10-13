<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/posts');

// Breeze mengarahkan user ke "dashboard" setelah login; kita alihkan ke daftar post
Route::redirect('/dashboard', '/posts')->middleware('auth')->name('dashboard');

// Semua halaman post wajib login
Route::resource('posts', PostController::class)->middleware('auth');

// Area admin: wajib login DAN role admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index', [
            'users'    => User::orderBy('id')->get(),
            'products' => Product::count(),
        ]);
    })->name('index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';