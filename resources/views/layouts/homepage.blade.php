<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ScholarshipHub') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .text-gradient {
            background: linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .backdrop-blur {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    {{-- HEADER --}}
    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Left --}}
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gradient">ScholarshipHub</h1>
                    <div class="hidden md:block ml-10">
                        <div class="flex space-x-8">
                            <a href="{{ url('/') }}" class="nav-link">Home</a>
                            <a href="#" class="nav-link">Scholarships</a>
                            <a href="#" class="nav-link">About</a>
                            <a href="#" class="nav-link">Resources</a>
                            <a href="#" class="nav-link">Contact</a>
                        </div>
                    </div>
                </div>

                {{-- Right --}}
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Sign Up</a>
                    @endguest

                    @auth
                        {{-- Profile dropdown --}}
                        <div class="relative">
                            <button class="flex items-center space-x-2 focus:outline-none group">
                                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}"
                                     alt="Profile" class="w-9 h-9 rounded-full border border-gray-300">
                                <span class="hidden sm:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            </button>
                            {{-- Dropdown --}}
                            <div class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-100 group-focus-within:block">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-white py-16 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-2xl font-bold text-gradient mb-4">ScholarshipHub</h3>
                <p class="text-gray-400">Empowering students to achieve their educational dreams through accessible funding opportunities.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Platform</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white">Find Scholarships</a></li>
                    <li><a href="#" class="hover:text-white">Application Tracker</a></li>
                    <li><a href="#" class="hover:text-white">Essay Assistant</a></li>
                    <li><a href="#" class="hover:text-white">Deadlines</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Resources</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white">Blog</a></li>
                    <li><a href="#" class="hover:text-white">Guides</a></li>
                    <li><a href="#" class="hover:text-white">FAQs</a></li>
                    <li><a href="#" class="hover:text-white">Success Stories</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Support</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white">Help Center</a></li>
                    <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} ScholarshipHub. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
