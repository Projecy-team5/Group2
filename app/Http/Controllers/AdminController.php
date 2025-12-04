<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Scholarship;
use App\Models\Application;
use Illuminate\Support\Str;

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

        $statusCounts = Application::selectRaw("COALESCE(status, 'unknown') as status, COUNT(*) as count")
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $statusChartData = [
            'labels' => !empty($statusCounts)
                ? array_map(fn ($status) => Str::headline($status), array_keys($statusCounts))
                : ['No Applications'],
            'data' => !empty($statusCounts)
                ? array_values($statusCounts)
                : [0],
        ];

        $trendMonths = 5;
        $currentDate = now();
        $trendStart = $currentDate->copy()->subMonths($trendMonths)->startOfMonth();

        $trendApplications = Application::where('created_at', '>=', $trendStart)
            ->get()
            ->groupBy(fn ($application) => $application->created_at->format('M Y'));

        $monthlyTrendData = collect(range($trendMonths, 0))->mapWithKeys(function ($offset) use ($currentDate, $trendApplications) {
            $label = $currentDate->copy()->subMonths($offset)->format('M Y');
            return [$label => optional($trendApplications->get($label))->count() ?? 0];
        })->toArray();

        $trendChartData = [
            'labels' => array_keys($monthlyTrendData),
            'data' => array_values($monthlyTrendData),
        ];

        $topScholarships = Scholarship::withCount('applications')
            ->orderByDesc('applications_count')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'latestApplications' => $latestApplications,
            'statusCounts' => $statusCounts,
            'statusChartData' => $statusChartData,
            'trendChartData' => $trendChartData,
            'topScholarships' => $topScholarships,
        ]);
    }
}
