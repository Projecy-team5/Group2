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

// Routes for the scholarship admin panel
Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // This GET route is for DISPLAYING the form.
    Route::get('scholarships/create', [ScholarshipController::class, 'create'])->name('scholarships.create');

    // This POST route is for SUBMITTING the form data.
    Route::post('scholarships', [ScholarshipController::class, 'store'])->name('scholarships.store');
});
