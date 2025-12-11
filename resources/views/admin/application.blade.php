@extends('layouts.dashboard')

@section('title', __('Submitted Applications'))

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ __('Submitted Scholarship Applications') }}</h1>
        <p class="mt-2 text-gray-600">{{ __('Manage and review all applicant submissions') }}</p>
    </div>

    <!-- Stats Summary (Optional - looks great) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="text-2xl font-bold text-indigo-600">{{ $applications->total() }}</div>
            <div class="text-sm text-gray-600 mt-1">{{ __('Total Applications') }}</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="text-2xl font-bold text-green-600">
                {{ $applications->where('created_at', '>=', now()->startOfMonth())->count() }}
            </div>
            <div class="text-sm text-gray-600 mt-1">{{ __('This Month') }}</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="text-2xl font-bold text-blue-600">
                {{ $applications->unique('user_id')->count() }}
            </div>
            <div class="text-sm text-gray-600 mt-1">{{ __('Unique Applicants') }}</div>
        </div>
    </div>

    <!-- Applications Table - Card Style -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('Applicant') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('Contact') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('Scholarship') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('Motivation Essay') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('Resume') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('Submitted') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($applications as $application)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <!-- Applicant -->
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-sm">
                                        {{ Str::substr($application->user->name, 0, 2) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $application->user->name }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td class="px-6 py-5 text-sm text-gray-700">
                                <div>{{ $application->user->email }}</div>
                                <div class="text-gray-500">{{ $application->phone }}</div>
                            </td>

                            <!-- Scholarship -->
                            <td class="px-6 py-5">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ Str::limit($application->scholarship->scholarship_name, 30) }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $application->scholarship->country }}</div>
                            </td>

                            <!-- Essay Preview -->
                            <td class="px-6 py-5 text-sm text-gray-700 max-w-xs">
                                <div class="line-clamp-3 text-gray-600">
                                    {{ Str::limit($application->motivation_essay, 120) }}
                                </div>
                            </td>

                            <!-- Resume -->
                            <td class="px-6 py-5 text-sm">
                                @if($application->resume)
                                    <a href="{{ asset('storage/'.$application->resume) }}"
                                       target="_blank"
                                       class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition font-medium text-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        {{ __('View Resume') }}
                                    </a>
                                @else
                                    <span class="text-gray-400 italic text-xs">{{ __('No resume') }}</span>
                                @endif
                            </td>

                            <!-- Submitted At -->
                            <td class="px-6 py-5 text-sm text-gray-600 whitespace-nowrap">
                                <div>{{ $application->created_at->format('d M Y')}</div>
                                <div class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="text-gray-500">
                                    <svg class="mx-auto w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">{{ __('No applications submitted yet') }}</p>
                                    <p class="text-sm mt-1">{{ __('Applications will appear here when students apply') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($applications->hasPages())
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $applications->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection
