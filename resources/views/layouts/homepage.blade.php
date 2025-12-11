<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $sharedSettings = $businessSettings ?? null;
        $brandName = $sharedSettings?->name ?? config('app.name', 'ScholarshipHub');
        $brandLogo = $sharedSettings?->logo_url;
        $faviconUrl = $sharedSettings?->favicon_url ?? asset('favicon.ico');
        $defaultFooterCopy = 'Your platform for discovering educational funding opportunities. We help students find and apply for scholarships.';
        $footerCopy = $sharedSettings?->footer_text ?? $defaultFooterCopy;
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $brandName }}</title>
    <link rel="icon" type="image/png" href="{{ $faviconUrl }}">
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
            padding-bottom: 4px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -8px;
            left: 0;
            background: #3b82f6;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .nav-link.active::after {
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
                    <a href="{{ url(path: '/') }}" class="flex items-center gap-3">
                        @if ($brandLogo)
                            <img src="{{ $brandLogo }}" alt="{{ $brandName }} logo" class="h-10 w-auto object-contain">
                            <span class="text-2xl sm:text-3xl font-extrabold text-gradient hidden sm:inline">{{ $brandName }}</span>
                        @else
                            <span class="text-2xl sm:text-3xl font-extrabold text-gradient">{{ $brandName }}</span>
                        @endif
                    </a>
                    <div class="hidden md:block ml-12">
                        <div class="flex space-x-8">
                            <a href="{{ url(path: '/') }}" class="nav-link {{ request()->is('/') ? 'active text-indigo-600' : 'text-gray-700' }} hover:text-indigo-600 font-medium text-sm">Home</a>

                            {{-- Scholarships Dropdown --}}
                            <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                                <a href="{{ url('/scholarships') }}" class="nav-link {{ request()->is('scholarships*') ? 'active text-indigo-600' : 'text-gray-700' }} hover:text-indigo-600 font-medium text-sm flex items-center gap-1">
                                    Scholarships
                                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </a>
                                <div x-show="open"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                    class="absolute left-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-200 z-50"
                                    style="display: none;">
                                    <div class="p-4">
                                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Featured Scholarships</div>
                                        @php
                                            $featuredScholarships = \App\Models\Scholarship::where('status', 'active')
                                                ->latest()
                                                ->take(3)
                                                ->get();
                                        @endphp
                                        <div class="space-y-2">
                                            @forelse($featuredScholarships as $scholarship)
                                                <a href="{{ route('scholarships.show', $scholarship) }}"
                                                    class="block p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                                    <div class="font-medium text-gray-900 text-sm">{{ Str::limit($scholarship->scholarship_name, 40) }}</div>
                                                    <div class="text-xs text-indigo-600 font-semibold mt-1">${{ number_format($scholarship->award_amount) }}</div>
                                                    <div class="text-xs text-gray-500 mt-1">Deadline: {{ \Carbon\Carbon::parse($scholarship->application_deadline)->format('M j, Y') }}</div>
                                                </a>
                                            @empty
                                                <div class="text-sm text-gray-500 py-2">No scholarships available</div>
                                            @endforelse
                                        </div>
                                        <div class="mt-4 pt-4 border-t border-gray-100">
                                            <a href="{{ url('/scholarships') }}"
                                                class="block text-center text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                                                View All Scholarships →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ url('/about') }}" class="nav-link {{ request()->is('about') ? 'active text-indigo-600' : 'text-gray-700' }} hover:text-indigo-600 font-medium text-sm">About</a>
                            <a href="{{ url('/articles') }}" class="nav-link {{ request()->is('articles*') || request()->is('category*') ? 'active text-indigo-600' : 'text-gray-700' }} hover:text-indigo-600 font-medium text-sm">Resources</a>
                            <a href="{{ url('/contact') }}" class="nav-link {{ request()->is('contact') ? 'active text-indigo-600' : 'text-gray-700' }} hover:text-indigo-600 font-medium text-sm">Contact</a>
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
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                Dashboard
                                </a>
                            @endif

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
                    <a href="{{ url('/scholarships') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Scholarships</a>
                    <a href="{{ url('/about') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">About</a>
                    <a href="{{ url('/articles') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Resources</a>
                    <a href="{{ url('/contact') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 animate-slide-up">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                {{-- About --}}
                <div class="md:col-span-2">
                    <h3 class="text-2xl font-bold mb-4">{{ $brandName }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">
                        {{ $footerCopy }}
                    </p>
                    @if ($sharedSettings?->address)
                        <p class="text-gray-400 text-sm leading-relaxed">
                            {{ $sharedSettings->address }}
                        </p>
                    @endif
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="font-semibold text-lg mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ url('/scholarships') }}" class="text-gray-400 hover:text-white transition-colors">Scholarships</a></li>
                        <li><a href="{{ url('/articles') }}" class="text-gray-400 hover:text-white transition-colors">Resources</a></li>
                        <li><a href="{{ url('/about') }}" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="font-semibold text-lg mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ url('/contact') }}" class="hover:text-white transition-colors">Contact Us</a></li>
                        @if ($sharedSettings?->email)
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $sharedSettings->email }}
                            </li>
                        @endif
                        @if ($sharedSettings?->phone)
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h1.27a2 2 0 011.94 1.52l.65 2.6a2 2 0 01-.58 1.94l-1.1 1.1a16 16 0 006.35 6.35l1.1-1.1a2 2 0 011.94-.58l2.6.65A2 2 0 0121 19.73V21a2 2 0 01-2 2 18 18 0 01-16-16 2 2 0 012-2z"></path>
                                </svg>
                                {{ $sharedSettings->phone }}
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} {{ $brandName }}. All rights reserved.</p>
            </div>
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
    @stack('scripts')
</body>
</html>
