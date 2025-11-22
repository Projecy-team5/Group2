<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ScholarshipHub') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .swiper-button-next, .swiper-button-prev { color: #4f46e5; }
        .swiper-pagination-bullet-active { background: #4f46e5; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#64748b',
                        accent: '#f59e0b'
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .text-gradient {
            background: linear-gradient(135deg, #5a67d8 0%, #9f7aea 100%);
            background-clip: text;
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
                    <a href="{{ url(path: '/') }}" class="text-2xl sm:text-3xl font-extrabold text-gradient">ScholarshipHub</a>
                    <div class="hidden md:block ml-12">
                        <div class="flex space-x-8">
                            <a href="{{ url(path: '/') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium text-sm">Home</a>
                            <a href="{{ url('/scholarships') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium text-sm">Scholarships</a>
                            <a href="{{ url('/about') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium text-sm">About</a>
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
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}"
                                alt="Profile"
                                class="w-9 h-9 rounded-full border border-gray-300 shadow-sm hover:scale-105 transition-transform duration-300">
                            <span class="hidden sm:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                        </button>

                        {{-- Dropdown --}}
                        <div x-show="open"
                            @click.away="open = false"
                            x-transition
                            class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-100 z-50">
                            <a href="{{ route('profile.show') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                            Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                    Logout
                                </button>
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
                    <a href="{{ url('/about') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">About</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Resources</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 animate-slide-up">
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

    {{-- CHAT WIDGET --}}
    <div id="chat-widget" class="fixed bottom-6 right-6 z-50">
        {{-- Chat Toggle Button --}}
        <button id="chat-toggle" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-4 rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
            <svg id="chat-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        {{-- Chat Container --}}
        <div id="chat-container" class="hidden absolute bottom-16 right-0 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
            {{-- Chat Header --}}
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold">AI Assistant</h3>
                            <p class="text-sm text-indigo-100">Ask me about scholarships!</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chat Messages --}}
            <div id="chatbox" class="h-80 overflow-y-auto p-4 space-y-3 bg-gray-50">
                <div class="flex items-start space-x-2">
                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm max-w-xs">
                        <p class="text-sm text-gray-800">Hello! I'm here to help you find scholarships and answer any questions you might have. How can I assist you today?</p>
                    </div>
                </div>
            </div>

            {{-- Chat Input --}}
            <div class="p-4 bg-white border-t border-gray-200">
                <div class="flex space-x-2">
                    <input id="userInput" type="text" placeholder="Type your message..."
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
                    <button onclick="sendMessage()"
                            class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Chat widget toggle
        document.getElementById('chat-toggle').addEventListener('click', () => {
            const container = document.getElementById('chat-container');
            const chatIcon = document.getElementById('chat-icon');
            const closeIcon = document.getElementById('close-icon');

            container.classList.toggle('hidden');
            chatIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Chat functionality
        async function sendMessage() {
            let input = document.getElementById('userInput');
            let message = input.value.trim();
            if (!message) return;

            let chatbox = document.getElementById('chatbox');

            // Add user message
            chatbox.innerHTML += `
                <div class="flex items-start space-x-2 justify-end">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg p-3 max-w-xs">
                        <p class="text-sm">${message}</p>
                    </div>
                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            `;

            // Add loading indicator
            chatbox.innerHTML += `
                <div class="flex items-start space-x-2">
                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm max-w-xs">
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                </div>
            `;

            input.value = "";
            chatbox.scrollTop = chatbox.scrollHeight;

            try {
                let res = await fetch("/chatbot", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ message })
                });

                console.log('Response status:', res.status);
                console.log('Response headers:', res.headers);

                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }

                let data = await res.json();
                console.log('Response data:', data);

                // Remove loading indicator
                chatbox.removeChild(chatbox.lastElementChild);

                // Add bot response
                chatbox.innerHTML += `
                    <div class="flex items-start space-x-2">
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div class="bg-white rounded-lg p-3 shadow-sm max-w-xs">
                            <p class="text-sm text-gray-800">${data.reply || 'No response received'}</p>
                        </div>
                    </div>
                `;
            } catch (error) {
                console.error('Chat error:', error);

                // Remove loading indicator
                chatbox.removeChild(chatbox.lastElementChild);

                // Add error message
                chatbox.innerHTML += `
                    <div class="flex items-start space-x-2">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="bg-white rounded-lg p-3 shadow-sm max-w-xs">
                            <p class="text-sm text-gray-800">Error: ${error.message}. Please try again later.</p>
                        </div>
                    </div>
                `;
            }

            chatbox.scrollTop = chatbox.scrollHeight;
        }

        // Allow sending message with Enter key
        document.getElementById('userInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.gallerySlider', {
                loop: true,
                autoplay: { delay: 4000, disableOnInteraction: false },
                pagination: { el: '.swiper-pagination', clickable: true },
                navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                grabCursor: true,
            });
        });
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
