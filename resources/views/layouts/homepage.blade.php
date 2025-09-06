<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ScholarshipHub') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .text-gradient {
            background: linear-gradient(135deg, #5a67d8 0%, #9f7aea 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .backdrop-blur {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(135deg, #5a67d8, #9f7aea);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .dropdown {
            transform: translateY(-10px);
            opacity: 0;
            transition: all 0.3s ease;
        }
        .group:focus-within .dropdown, .group:hover .dropdown {
            transform: translateY(0);
            opacity: 1;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        @keyframes slideUp {
            0% { transform: translateY(20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        .animate-slide-up {
            animation: slideUp 0.8s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-gray-50 to-gray-100 flex flex-col min-h-screen">

    {{-- HEADER --}}
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-gray-200/50 shadow-sm animate-fade-in">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Left --}}
                <div class="flex items-center">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gradient">ScholarshipHub</h1>
                    <div class="hidden md:block ml-12">
                        <div class="flex space-x-8">
                            <a href="{{ url('/') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium text-sm">Home</a>
                            <a href="{{ url('/scholarships') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium text-sm">Scholarships</a>
                            <a href="#" class="nav-link text-gray-700 hover:text-indigo-600 font-medium text-sm">About</a>
                            <a href="#" class="nav-link text-gray-700 hover:text-indigo-600 font-medium text-sm">Resources</a>
                            <a href="#" class="nav-link text-gray-700 hover:text-indigo-600 font-medium text-sm">Contact</a>
                        </div>
                    </div>
                </div>

                {{-- Right --}}
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors duration-300">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg hover:from-indigo-700 hover:to-purple-700 shadow-md hover:shadow-lg transition-all duration-300">Sign Up</a>
                    @endguest

                    @auth
                        {{-- Profile dropdown --}}
                        <div class="relative group">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}"
                                     alt="Profile" class="w-9 h-9 rounded-full border border-gray-300 shadow-sm hover:scale-105 transition-transform duration-300">
                                <span class="hidden sm:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            </button>
                            {{-- Dropdown --}}
                            <div class="dropdown hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-100">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    {{-- Mobile Menu Button --}}
                    <div class="md:hidden">
                        <button id="mobile-menu-button" class="focus:outline-none">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div id="mobile-menu" class="hidden md:hidden bg-white/90 backdrop-blur border-t border-gray-200">
                <div class="px-4 py-4 space-y-2">
                    <a href="{{ url('/') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Home</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Scholarships</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">About</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Resources</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-slide-up">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-white py-12 mt-16 animate-slide-up">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-2xl font-extrabold text-gradient mb-4">ScholarshipHub</h3>
                <p class="text-gray-300 text-sm leading-relaxed">Empowering students to achieve their educational dreams through accessible funding opportunities.</p>
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="text-gray-400 hover:text-white transform hover:scale-110 transition-all duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.14h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transform hover:scale-110 transition-all duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transform hover:scale-110 transition-all duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.04c-5.5 0-9.96 4.46-9.96 9.96 0 5.06 3.686 9.24 8.51 9.9v-6.99h-2.55v-2.91h2.55v-2.22c0-2.51 1.49-3.89 3.78-3.89 1.09 0 2.23.19 2.23.19v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.9h2.78l-.45 2.91h-2.33v6.99c4.824-.66 8.51-4.84 8.51-9.9 0-5.5-4.46-9.96-9.96-9.96z"/></svg>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="font-semibold text-lg text-white mb-4">Platform</h4>
                <ul class="space-y-3 text-gray-300 text-sm">
                    <li><a href="#" class="hover:text-white transition-colors duration-300 relative group">Find Scholarships<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span></a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300 relative group">Application Tracker<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span></a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300 relative group">Essay Assistant<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span></a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300 relative group">Deadlines<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span></a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-lg text-white mb-4">Resources</h4>
                <ul class="space-y-3 text-gray-300 text-sm">
                    <li><a href="#" class="hover:text-white transition-colors duration-300 relative group">Blog<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span></a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300 relative group">Guides<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span></a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300 relative group">FAQs<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span></a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300 relative group">Success Stories<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span></a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-lg text-white mb-4">Support</h4>
                <ul class="space-y-3 text-gray-300 text-sm">
                    <li><a href="#" class="hover:text-white transition-colors duration-3
00 relative group">Contact Us<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span></a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300 relative group">Help Center<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span></a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300 relative group">Privacy Policy<span class="absolute bottom-0 left-0 w-0 h-0. od-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300"></span></a></li>
                    <li><a href="#" class="hover:text-white transition-colors duration-300 relative group">Terms of Service<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span></a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-300 text-sm">
            <p>&copy; {{ date('Y') }} ScholarshipHub. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
