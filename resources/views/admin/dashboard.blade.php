@extends('layouts.dashboard')

@section('title', 'Home')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded shadow flex flex-col items-center text-center">
            <div class="text-3xl font-bold text-indigo-600">{{ $stats['users'] }}</div>
            <div class="text-gray-700 mt-2">Total Users</div>
        </div>
        <div class="bg-white p-6 rounded shadow flex flex-col items-center text-center">
            <div class="text-3xl font-bold text-green-600">{{ $stats['scholarships'] }}</div>
            <div class="text-gray-700 mt-2">Total Scholarships</div>
        </div>
        <div class="bg-white p-6 rounded shadow flex flex-col items-center text-center">
            <div class="text-3xl font-bold text-yellow-600">{{ $stats['applications'] }}</div>
            <div class="text-gray-700 mt-2">Total Applications</div>
        </div>
    </div>
    <div class="bg-white rounded shadow p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Latest Applications</h2>
        @if(count($latestApplications))
            <ul>
                @foreach($latestApplications as $app)
                <li class="border-b last:border-0 py-2 flex justify-between items-start">
                    <span>
                        <span class="font-semibold">{{ $app->user->name }}</span> applied for <span class="text-indigo-600">{{ $app->scholarship->scholarship_name }}</span>
                    </span>
                    <span class="text-xs text-gray-500">{{ $app->created_at->diffForHumans() }}</span>
                </li>
                @endforeach
            </ul>
        @else
            <div class="text-gray-500">No recent applications.</div>
        @endif
    </div>
</div>
@endsection
