<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontendScholarshipController;

Route::get('/', function () {
    return view('frontend/home');
});

Route::get('/scholarships', [FrontendScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/scholarships/{scholarship}', [FrontendScholarshipController::class, 'show'])->name('scholarships.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'admin'])->name('admin.dashboard');


Route::prefix('admin/scholarships')->name('admin.scholarships.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [ScholarshipController::class, 'index'])->name('index');
    Route::get('/create', [ScholarshipController::class, 'create'])->name('create');
    Route::post('/', [ScholarshipController::class, 'store'])->name('store');
    Route::get('/{scholarship}/edit', [ScholarshipController::class, 'edit'])->name('edit');
    Route::put('/{scholarship}', [ScholarshipController::class, 'update'])->name('update');
    Route::delete('/{scholarship}', [ScholarshipController::class, 'destroy'])->name('destroy');
    Route::get('/{scholarship}', [ScholarshipController::class, 'show'])->name('show');
});

Route::prefix('admin/users')->name('admin.users.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
});
