<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function isAdmin()
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    protected function userDashboardData()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return [
            'appStats' => [
                'applied' => $user->applications()->count(),
                'scholarships' => \App\Models\Scholarship::where('status', 'active')->count(),
            ],
            'recentUserApplications' => $user->applications()->with('scholarship')->latest()->take(5)->get()
        ];
    }
}
