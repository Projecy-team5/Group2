@extends('layouts.homepage')
@section('content')
    <div class="bg-gray-50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Available Scholarships</h1>
                <p class="text-gray-600 mt-2">Discover funding opportunities for your education</p>
            </div>

            @if($scholarships->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($scholarships as $scholarship)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-shadow">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                                        {{ ucfirst($scholarship->status) }}
                                    </span>
                                    <span class="text-2xl font-bold text-indigo-600">${{ $scholarship->award_amount }}</span>
                                </div>

                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $scholarship->scholarship_name }}</h3>

                                <div class="mb-4">
                                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $scholarship->country }}
                                    </div>

                                    <p class="text-gray-600 text-sm line-clamp-3">{{ Str::limit($scholarship->application_description, 120) }}</p>
                                </div>

                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <span>
                                        @php
                                            $deadline = \Carbon\Carbon::parse($scholarship->application_deadline);
                                            $now = \Carbon\Carbon::now();
                                            $daysLeft = $now->diffInDays($deadline, false);
                                        @endphp
                                        @if ($daysLeft > 0)
                                            {{ $daysLeft }} days left
                                        @elseif($daysLeft == 0)
                                            Deadline today!
                                        @else
                                            Closed {{ abs($daysLeft) }} days ago
                                        @endif
                                    </span>
                                    <span>{{ $deadline->format('M d, Y') }}</span>
                                </div>

                                <a href="{{ route('scholarships.show', $scholarship) }}"
                                   class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 font-medium">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $scholarships->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No scholarships available</h3>
                    <p class="text-gray-600">Check back later for new opportunities.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

