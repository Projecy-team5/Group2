@extends('layouts.homepage')
@section('content')
    {{-- Hero Section --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-4">About ScholarshipHub</h1>
            <p class="text-xl mb-8">Your platform for discovering educational funding opportunities.</p>
        </div>
    </div>

    {{-- Mission Section --}}
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                <p class="text-lg text-gray-600 leading-relaxed mb-8">
                    ScholarshipHub is dedicated to helping students find and apply for scholarships that match their
                    educational goals. We provide a centralized platform where students can explore various funding
                    opportunities and manage their applications efficiently.
                </p>
            </div>
        </div>
    </div>

    {{-- Features Section --}}
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">What We Offer</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Scholarship Database</h3>
                    <p class="text-gray-600">Browse through various scholarship opportunities across different fields and eligibility criteria.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Application Management</h3>
                    <p class="text-gray-600">Track your applications and manage deadlines all in one convenient place.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Resources & Articles</h3>
                    <p class="text-gray-600">Access helpful resources and articles to guide you through your scholarship journey.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA Section --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 py-16">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to Get Started?</h2>
            <p class="text-xl text-indigo-100 mb-8">Explore available scholarships and begin your application today.</p>
            <a href="{{ url('/scholarships') }}"
               class="bg-white text-indigo-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300 inline-block">
                Browse Scholarships
            </a>
        </div>
    </div>
@endsection
