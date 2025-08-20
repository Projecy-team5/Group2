<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScholarshipHub - Your Gateway to Educational Funding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-gray-50">
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-gradient">ScholarshipHub</h1>
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex space-x-8">
                            <a href="#"
                                class="text-gray-900 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Home</a>
                            <a href="#"
                                class="text-gray-500 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Scholarships</a>
                            <a href="#"
                                class="text-gray-500 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">About</a>
                            <a href="#"
                                class="text-gray-500 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Resources</a>
                            <a href="#"
                                class="text-gray-500 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Contact</a>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}"
                        class="text-gray-500 hover:text-indigo-600 px-4 py-2 text-sm font-medium border border-transparent hover:border-gray-300 rounded-lg transition-all">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 text-white px-4 py-2 text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Sign
                        Up</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="relative overflow-hidden">
        <div class="gradient-bg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                        Your Gateway to
                        <span class="block text-yellow-300">Educational Funding</span>
                    </h1>
                    <p class="text-xl text-indigo-100 mb-8 max-w-3xl mx-auto leading-relaxed">
                        Discover thousands of scholarships, grants, and educational opportunities tailored to your
                        profile. Start your journey to debt-free education today.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="#"
                            class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-50 transition-colors shadow-lg">
                            Find Scholarships
                        </a>
                        <a href="#"
                            class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-indigo-600 transition-colors">
                            How It Works
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-20 left-10 animate-float">
            <div class="w-16 h-16 bg-yellow-400 rounded-full opacity-20"></div>
        </div>
        <div class="absolute bottom-20 right-10 animate-float" style="animation-delay: -2s;">
            <div class="w-20 h-20 bg-white rounded-full opacity-10"></div>
        </div>
    </div>
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-indigo-600 mb-2">50,000+</div>
                    <div class="text-gray-600">Available Scholarships</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-indigo-600 mb-2">$2.5B+</div>
                    <div class="text-gray-600">Total Funding</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-indigo-600 mb-2">95%</div>
                    <div class="text-gray-600">Success Rate</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-indigo-600 mb-2">100,000+</div>
                    <div class="text-gray-600">Students Helped</div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Choose ScholarshipHub?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">We make finding and applying for scholarships simple,
                    efficient, and successful.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Smart Matching</h3>
                    <p class="text-gray-600 leading-relaxed">Our AI-powered algorithm matches you with scholarships
                        based on your profile, interests, and academic achievements.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Application Tracking</h3>
                    <p class="text-gray-600 leading-relaxed">Keep track of all your applications, deadlines, and
                        requirements in one organized dashboard.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Expert Guidance</h3>
                    <p class="text-gray-600 leading-relaxed">Get personalized advice from education counselors and
                        successful scholarship recipients.</p>
                </div>
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
                <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <span
                            class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">Merit-Based</span>
                        <span class="text-2xl font-bold text-indigo-600">$25,000</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Academic Excellence Award</h3>
                    <p class="text-gray-600 mb-4">For outstanding students with GPA 3.8+ pursuing STEM fields.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Deadline: March 15</span>
                        <a href="#" class="text-indigo-600 font-medium hover:text-indigo-700">Apply Now →</a>
                    </div>
                </div>
                <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <span
                            class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">Need-Based</span>
                        <span class="text-2xl font-bold text-indigo-600">$15,000</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Community Leaders Grant</h3>
                    <p class="text-gray-600 mb-4">Supporting students who demonstrate community service and leadership.
                    </p>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Deadline: April 1</span>
                        <a href="#" class="text-indigo-600 font-medium hover:text-indigo-700">Apply Now →</a>
                    </div>
                </div>
                <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <span
                            class="bg-purple-100 text-purple-800 text-sm font-medium px-3 py-1 rounded-full">Creative</span>
                        <span class="text-2xl font-bold text-indigo-600">$10,000</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Arts & Innovation Scholarship</h3>
                    <p class="text-gray-600 mb-4">For creative students pursuing arts, design, or creative technology.
                    </p>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Deadline: March 30</span>
                        <a href="#" class="text-indigo-600 font-medium hover:text-indigo-700">Apply Now →</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="#"
                    class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
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
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <img class="w-12 h-12 rounded-full"
                            src="https://images.unsplash.com/photo-1494790108755-2616b612e29f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="Sarah">
                        <div class="ml-4">
                            <div class="font-semibold text-gray-900">Sarah Johnson</div>
                            <div class="text-gray-600 text-sm">Computer Science</div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"ScholarshipHub helped me find and win $45,000 in scholarships. The
                        platform made the entire process so much easier!"</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <img class="w-12 h-12 rounded-full"
                            src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="Michael">
                        <div class="ml-4">
                            <div class="font-semibold text-gray-900">Michael Chen</div>
                            <div class="text-gray-600 text-sm">Pre-Med</div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"The smart matching feature connected me with scholarships I never
                        would have found on my own. Incredible platform!"</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <img class="w-12 h-12 rounded-full"
                            src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="Emily">
                        <div class="ml-4">
                            <div class="font-semibold text-gray-900">Emily Rodriguez</div>
                            <div class="text-gray-600 text-sm">Business</div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Thanks to ScholarshipHub, I'm graduating debt-free. The
                        application tracking feature kept me organized throughout."</p>
                </div>
            </div>
        </div>
    </div>
    <div class="gradient-bg py-20">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Start Your Scholarship Journey?</h2>
            <p class="text-xl text-indigo-100 mb-8">Join thousands of students who are already on their path to
                debt-free education.</p>
            <a href="#"
                class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-50 transition-colors shadow-lg">
                Get Started For Free
            </a>
        </div>
    </div>
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="col-span-1">
                    <h3 class="text-2xl font-bold text-gradient mb-4">ScholarshipHub</h3>
                    <p class="text-gray-400">Empowering students to achieve their educational dreams through accessible
                        funding opportunities.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Platform</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Find Scholarships</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Application Tracker</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Essay Assistant</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Deadlines</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Guides</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQs</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Success Stories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2025 ScholarshipHub. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
