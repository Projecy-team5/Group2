@extends('layouts.homepage')
@section('content')
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 to-purple-800">
        <div class="max-w mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight animate-fade-in">
                    Your Gateway to
                    <span class="block text-yellow-300">Educational Funding</span>
                </h1>
                <p class="text-xl text-indigo-100 mb-8 max-w-3xl mx-auto leading-relaxed animate-slide-up">
                    Discover thousands of scholarships, grants, and educational opportunities tailored to your profile. Start your journey to debt-free education today.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#"
                       class="bg-yellow-400 text-indigo-900 px-8 py-4 rounded-full font-semibold text-lg hover:bg-yellow-300 transition-all duration-300 transform hover:scale-105 shadow-xl">
                        Find Scholarships
                    </a>
                    <a href="#"
                       class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-indigo-900 transition-all duration-300 transform hover:scale-105">
                        How It Works
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

    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach([
                    ['value' => '50,000+', 'label' => 'Available Scholarships'],
                    ['value' => '$2.5B+', 'label' => 'Total Funding'],
                    ['value' => '95%', 'label' => 'Success Rate'],
                    ['value' => '100,000+', 'label' => 'Students Helped']
                ] as $stat)
                    <div class="text-center transform transition-all duration-300 hover:scale-105">
                        <div class="text-3xl md:text-4xl font-bold text-indigo-600 mb-2 animate-pulse">{{ $stat['value'] }}</div>
                        <div class="text-gray-600">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 animate-fade-in">Why Choose ScholarshipHub?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">We make finding and applying for scholarships simple, efficient, and successful.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    [
                        'title' => 'Smart Matching',
                        'description' => 'Our AI-powered algorithm matches you with scholarships based on your profile, interests, and academic achievements.',
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
                        'title' => 'Expert Guidance',
                        'description' => 'Get personalized advice from education counselors and successful scholarship recipients.',
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

    <div class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Scholarships</h2>
                <p class="text-xl text-gray-600">Popular opportunities ending soon</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([
                    [
                        'type' => 'Merit-Based',
                        'typeBg' => 'bg-green-100',
                        'typeColor' => 'text-green-800',
                        'amount' => '$25,000',
                        'title' => 'Academic Excellence Award',
                        'description' => 'For outstanding students with GPA 3.8+ pursuing STEM fields.',
                        'deadline' => 'March 15'
                    ],
                    [
                        'type' => 'Need-Based',
                        'typeBg' => 'bg-blue-100',
                        'typeColor' => 'text-blue-800',
                        'amount' => '$15,000',
                        'title' => 'Community Leaders Grant',
                        'description' => 'Supporting students who demonstrate community service and leadership.',
                        'deadline' => 'April 1'
                    ],
                    [
                        'type' => 'Creative',
                        'typeBg' => 'bg-purple-100',
                        'typeColor' => 'text-purple-800',
                        'amount' => '$10,000',
                        'title' => 'Arts & Innovation Scholarship',
                        'description' => 'For creative students pursuing arts, design, or creative technology.',
                        'deadline' => 'March 30'
                    ]
                ] as $scholarship)
                    <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-4">
                            <span class="{{ $scholarship['typeBg'] }} {{ $scholarship['typeColor'] }} text-sm font-medium px-3 py-1 rounded-full">{{ $scholarship['type'] }}</span>
                            <span class="text-2xl font-bold text-indigo-600">{{ $scholarship['amount'] }}</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $scholarship['title'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $scholarship['description'] }}</p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>Deadline: {{ $scholarship['deadline'] }}</span>
                            <a href="#" class="text-indigo-600 font-medium hover:text-indigo-700">Apply Now →</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="#"
                   class="bg-indigo-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105">
                    View All Scholarships
                </a>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Success Stories</h2>
                <p class="text-xl text-gray-600">Real students, real results</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([
                    [
                        'name' => 'Sarah Johnson',
                        'field' => 'Computer Science',
                        'quote' => 'ScholarshipHub helped me find and win $45,000 in scholarships. The platform made the entire process so much easier!',
                        'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612e29f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
                    ],
                    [
                        'name' => 'Michael Chen',
                        'field' => 'Pre-Med',
                        'quote' => 'The smart matching feature connected me with scholarships I never would have found on my own. Incredible platform!',
                        'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
                    ],
                    [
                        'name' => 'Emily Rodriguez',
                        'field' => 'Business',
                        'quote' => 'Thanks to ScholarshipHub, I\'m graduating debt-free. The application tracking feature kept me organized throughout.',
                        'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
                    ]
                ] as $story)
                    <div class="bg-white p-8 rounded-2xl shadow-lg transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                        <div class="flex items-center mb-6">
                            <img class="w-12 h-12 rounded-full" src="{{ $story['image'] }}" alt="{{ $story['name'] }}">
                            <div class="ml-4">
                                <div class="font-semibold text-gray-900">{{ $story['name'] }}</div>
                                <div class="text-gray-600 text-sm">{{ $story['field'] }}</div>
                            </div>
                        </div>
                        <p class="text-gray-600 italic">"{{ $story['quote'] }}"</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-indigo-900 to-purple-800 py-20">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 animate-fade-in">Ready to Start Your Scholarship Journey?</h2>
            <p class="text-xl text-indigo-100 mb-8 animate-slide-up">Join thousands of students who are already on their path to debt-free education.</p>
            <a href="#"
               class="bg-yellow-400 text-indigo-900 px-8 py-4 rounded-full font-semibold text-lg hover:bg-yellow-300 transition-all duration-300 transform hover:scale-105 shadow-xl">
                Get Started For Free
            </a>
        </div>
    </div>
@endsection
