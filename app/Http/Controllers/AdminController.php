<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Scholarship;
use App\Models\Application;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'scholarships' => Scholarship::count(),
            'applications' => Application::count(),
        ];
        $latestApplications = Application::with(['user', 'scholarship'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestApplications'));
    }
}
