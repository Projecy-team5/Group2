<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontendScholarshipController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Frontend\ArticleController;   // ← Frontend
use App\Http\Controllers\Admin\ArticleController as AdminArticleController; // ← Admin (aliased)
use App\Http\Controllers\Admin\CategoryController;

// Frontend Routes
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

// THIS IS THE FIX → List all articles as cards
Route::get('/articles', [App\Http\Controllers\Frontend\ArticleController::class, 'index'])
    ->name('articles.index');

// SINGLE ARTICLE
Route::get('/articles/{slug}', [App\Http\Controllers\Frontend\ArticleController::class, 'show'])
    ->name('articles.show');

// CATEGORY PAGE
Route::get('/category/{slug}', [App\Http\Controllers\Frontend\ArticleController::class, 'category'])
    ->name('articles.category');
// Scholarships
Route::get('/scholarships', [FrontendScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/scholarships/{scholarship}', [FrontendScholarshipController::class, 'show'])->name('scholarships.show');

// Chatbot test routes
Route::post('/chatbot', [GeminiController::class, 'handle'])->middleware('web');
Route::get('/test-chat', function () {
    $apiKey = env('GOOGLE_API_KEY');
    return response()->json([
        'api_key_configured' => !empty($apiKey),
        'api_key_length' => $apiKey ? strlen($apiKey) : 0,
        'api_key_preview' => $apiKey ? substr($apiKey, 0, 10) . '...' : 'Not set'
    ]);
});

// Authenticated routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        $user = Auth::user();
        $appStats = [
            'applied' => $user->applications()->count(),
            'scholarships' => \App\Models\Scholarship::where('status', 'active')->count(),
        ];
        $recentUserApplications = $user->applications()->with('scholarship')->latest()->take(5)->get();
        return view('dashboard', compact('appStats', 'recentUserApplications'));
    })->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Scholarships
    Route::resource('scholarships', ScholarshipController::class)->except(['show']);
    Route::get('scholarships/{scholarship}', [ScholarshipController::class, 'show'])->name('scholarships.show');

    // Users
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');

    // Articles & Categories (Admin CRUD)
    Route::resource('articles', AdminArticleController::class);
    Route::resource('categories', CategoryController::class);

    // Applications
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
});

// Apply to scholarship (user)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/scholarships/{scholarship}/apply', [ApplicationController::class, 'store'])
        ->name('scholarships.apply');
});
