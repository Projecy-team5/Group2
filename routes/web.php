<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontendScholarshipController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('frontend/home');
});

Route::get('/about', function () {
    return view('frontend/about');
});


Route::post('/chatbot', [GeminiController::class, 'handle'])->middleware('web');
Route::get('/test-chat', function () {
    $apiKey = env('GOOGLE_API_KEY');
    return response()->json([
        'api_key_configured' => !empty($apiKey),
        'api_key_length' => $apiKey ? strlen($apiKey) : 0,
        'api_key_preview' => $apiKey ? substr($apiKey, 0, 10) . '...' : 'Not set'
    ]);
});

Route::get('/test-chatbot', function () {
    $controller = new \App\Http\Controllers\GeminiController();
    $request = new \Illuminate\Http\Request();
    $request->merge(['message' => 'Hello, test message']);
    return $controller->handle($request);
});
Route::get('/scholarships', [FrontendScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/scholarships/{scholarship}', [FrontendScholarshipController::class, 'show'])->name('scholarships.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        } else {
            $user = Auth::user();
            $appStats = [
                'applied' => $user->applications()->count(),
                'scholarships' => \App\Models\Scholarship::where('status', 'active')->count(),
            ];
            $recentUserApplications = $user->applications()->with('scholarship')->latest()->take(5)->get();
            return view('dashboard', compact('appStats', 'recentUserApplications'));
        }
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

// Route for applying to a scholarship
Route::middleware(['auth', 'verified'])->group(function() {
    Route::post('/scholarships/{scholarship}/apply', [ApplicationController::class, 'store'])->name('scholarships.apply');
});

// Route for admin to view submitted applications
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/applications', [ApplicationController::class, 'index'])->name('admin.applications.index');
});
