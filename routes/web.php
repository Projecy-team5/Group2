<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BusinessSettingController;
use App\Http\Controllers\FrontendScholarshipController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Frontend\ArticleController;   // ← Frontend
use App\Http\Controllers\Admin\ArticleController as AdminArticleController; // ← Admin (aliased)
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Models\Scholarship;

// Frontend Routes
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::post('/locale/{locale}', function (string $locale) {
    session(['app_locale' => $locale]);
    app()->setLocale($locale);

    return response()->json(['status' => 'ok']);
})->name('locale.switch');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

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
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        $user = Auth::user();
        $applicationsQuery = $user->applications();

        $appStats = [
            'applied' => (clone $applicationsQuery)->count(),
            'scholarships' => Scholarship::where('status', 'active')->count(),
        ];

        $recentUserApplications = (clone $applicationsQuery)
            ->with('scholarship')
            ->latest()
            ->take(5)
            ->get();

        $statusCounts = (clone $applicationsQuery)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $statusChartData = [
            'labels' => !empty($statusCounts) ? array_map(function ($status) {
                return \Illuminate\Support\Str::headline($status ?? 'Unknown');
            }, array_keys($statusCounts)) : ['No Applications'],
            'data' => !empty($statusCounts) ? array_values($statusCounts) : [0],
        ];

        $trendMonths = 5;
        $currentDate = now();
        $trendStart = $currentDate->copy()->subMonths($trendMonths)->startOfMonth();

        $trendApplications = (clone $applicationsQuery)
            ->where('created_at', '>=', $trendStart)
            ->get()
            ->groupBy(function ($application) {
                return $application->created_at->format('M Y');
            });

        $monthlyTrendData = collect(range($trendMonths, 0))->mapWithKeys(function ($offset) use ($currentDate, $trendApplications) {
            $label = $currentDate->copy()->subMonths($offset)->format('M Y');
            return [$label => optional($trendApplications->get($label))->count() ?? 0];
        })->toArray();

        $trendChartData = [
            'labels' => array_keys($monthlyTrendData),
            'data' => array_values($monthlyTrendData),
        ];

        return view('dashboard', [
            'appStats' => $appStats,
            'recentUserApplications' => $recentUserApplications,
            'statusCounts' => $statusCounts,
            'statusChartData' => $statusChartData,
            'trendChartData' => $trendChartData,
        ]);
    })->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Contact Messages
    Route::get('/contacts', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contacts.destroy');

    // Scholarships
    Route::resource('scholarships', ScholarshipController::class)->except(['show']);
    Route::get('scholarships/{scholarship}', [ScholarshipController::class, 'show'])->name('scholarships.show');

    // Users
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');

    // Articles & Categories (Admin CRUD)
    Route::resource('articles', AdminArticleController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('roles', RoleController::class)->except(['show']);

    // Applications
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');

    // Business Settings
    Route::get('/business-settings', [BusinessSettingController::class, 'edit'])->name('business-settings.edit');
    Route::put('/business-settings', [BusinessSettingController::class, 'update'])->name('business-settings.update');
});

// Apply to scholarship (user)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/scholarships/{scholarship}/apply', [ApplicationController::class, 'store'])
        ->name('scholarships.apply');
});
