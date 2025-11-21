@extends('layouts.dashboard')

@section('title', 'Applications')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Page Header -->
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-900">Scholarship Applications</h1>
            <p class="mt-2 text-gray-600">Review and manage all submitted applications</p>
        </div>

        <!-- Applications Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/80 backdrop-blur-sm">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Applicant</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Scholarship</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Essay Preview</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Resume</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($applications as $application)
                            <tr class="hover:bg-gray-50/70 transition-all duration-200 group">
                                <!-- Applicant -->
                                <td class="px-6 py-5">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-11 h-11 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">
                                            {{ Str::substr($application->user->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $application->user->name }}</div>
                                            <div class="text-xs text-gray-500">ID: {{ $application->user->id }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Contact -->
                                <td class="px-6 py-5 text-sm">
                                    <div class="text-gray-900 font-medium">{{ $application->user->email }}</div>
                                    <div class="text-gray-500">{{ $application->phone }}</div>
                                </td>

                                <!-- Scholarship -->
                                <td class="px-6 py-5">
                                    <div class="font-medium text-gray-900">
                                        {{ Str::limit($application->scholarship->scholarship_name, 35) }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $application->scholarship->country }}</div>
                                </td>

                                <!-- Essay Preview -->
                                <td class="px-6 py-5 text-sm text-gray-600 max-w-md">
                                    <p class="line-clamp-3 leading-relaxed">
                                        {{ Str::limit($application->motivation_essay, 150) }}
                                    </p>
                                </td>

                                <!-- Resume -->
                                <td class="px-6 py-5 text-center">
                                    @if($application->resume)
                                        <a href="{{ asset('storage/' . $application->resume) }}"
                                           target="_blank"
                                           class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition font-medium text-sm shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            View
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-sm italic">—</span>
                                    @endif
                                </td>

                                <!-- Submitted At -->
                                <td class="px-6 py-5 text-sm text-gray-600">
                                    <div class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</div>
                                </td>
                            </tr>
                        @empty
                            <!-- Beautiful Empty State -->
                            <tr>
                                <td colspan="6" class="py-20 text-center">
                                    <div class="max-w-md mx-auto">
                                        <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No applications yet</h3>
                                        <p class="text-gray-500">Applications from students will appear here once they start applying.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($applications->hasPages())
                <div class="bg-gray-50/80 border-t border-gray-200 px-6 py-4">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
