<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ScholarshipController;

Route::get('/', function () {
    return view('welcome');
});

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


Route::prefix('admin/scholarships')->name('admin.scholarships.')->group(function () {
    Route::get('/', [ScholarshipController::class, 'index'])->name('index');
    Route::get('/create', [ScholarshipController::class, 'create'])->name('create');
    Route::post('/', [ScholarshipController::class, 'store'])->name('store');
    Route::get('/{scholarship}/edit', [ScholarshipController::class, 'edit'])->name('edit');
    Route::put('/{scholarship}', [ScholarshipController::class, 'update'])->name('update');
    Route::delete('/{scholarship}', [ScholarshipController::class, 'destroy'])->name('destroy');
    Route::get('/{scholarship}', [ScholarshipController::class, 'show'])->name('show');
});
