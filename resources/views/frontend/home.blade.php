@extends('layouts.homepage')
@section('content')
    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 to-purple-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight animate-fade-in">
                    Your Gateway to
                    <span class="block text-yellow-300">Educational Funding</span>
                </h1>
                <p class="text-xl text-indigo-100 mb-8 max-w-3xl mx-auto leading-relaxed animate-slide-up">
                    Discover scholarships, grants, and educational opportunities. Start your journey to educational success today.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ url('/scholarships') }}"
                       class="bg-yellow-400 text-indigo-900 px-8 py-4 rounded-full font-semibold text-lg hover:bg-yellow-300 transition-all duration-300 transform hover:scale-105 shadow-xl">
                        Browse Scholarships
                    </a>
                    <a href="{{ url('/about') }}"
                       class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-indigo-900 transition-all duration-300 transform hover:scale-105">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute top-20 left-10 animate-float">
            <div class="w-16 h-16 bg-yellow-400 rounded-full opacity-30 blur-md"></div>
        </div>
        <div class="absolute bottom-20 right-10 animate-float" style="animation-delay: -2s;">
            <div class="w-24 h-24 bg-white rounded-full opacity-20 blur-md"></div>
        </div>
    </div>

    {{-- Features Section --}}
    <div class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 animate-fade-in">Why Choose ScholarshipHub?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">We make finding and applying for scholarships simple and organized.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    [
                        'title' => 'Browse Scholarships',
                        'description' => 'Explore various scholarship opportunities tailored to different fields and criteria.',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>',
                        'bg' => 'bg-indigo-100',
                        'iconColor' => 'text-indigo-600'
                    ],
                    [
                        'title' => 'Application Tracking',
                        'description' => 'Keep track of all your applications, deadlines, and requirements in one organized dashboard.',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
                        'bg' => 'bg-green-100',
                        'iconColor' => 'text-green-600'
                    ],
                    [
                        'title' => 'Resource Center',
                        'description' => 'Access helpful articles and resources to guide you through the scholarship application process.',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>',
                        'bg' => 'bg-yellow-100',
                        'iconColor' => 'text-yellow-600'
                    ]
                ] as $feature)
                    <div class="bg-white p-8 rounded-2xl shadow-lg transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                        <div class="w-16 h-16 {{ $feature['bg'] }} rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 {{ $feature['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $feature['icon'] !!}
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">{{ $feature['title'] }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $feature['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- CTA Section --}}
    <div class="bg-gradient-to-br from-indigo-900 to-purple-800 py-20">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 animate-fade-in">Ready to Start Your Scholarship Journey?</h2>
            <p class="text-xl text-indigo-100 mb-8 animate-slide-up">Explore available scholarships and start your application today.</p>
            <a href="{{ url('/scholarships') }}"
               class="bg-yellow-400 text-indigo-900 px-8 py-4 rounded-full font-semibold text-lg hover:bg-yellow-300 transition-all duration-300 transform hover:scale-105 shadow-xl">
                Get Started
            </a>
        </div>
    </div>
@endsection
