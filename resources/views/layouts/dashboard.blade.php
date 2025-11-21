<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
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
</head>

<body class="bg-gray-50 font-sans">
    <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 shadow-sm">
        {{-- <div class="flex items-center justify-center h-16 px-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-sm">D</span>
                </div>
                <span class="text-xl font-semibold text-gray-900">Dashboard</span>
            </div>
        </div> --}}
        @auth
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="w-10 h-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}">
                    @else
                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                            <span class="text-white font-medium text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</h3>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        @endauth
        <nav class="px-4 py-6 space-y-2">
            <div class="space-y-1">
                <a href="#"
                    class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 7 4-4 4 4"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="#"
                    class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile
                </a>
                <a href="#"
                    class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </div>
            <div class="pt-6">
                <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</h3>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors
                        @if (request()->routeIs('admin.users.*')) text-primary bg-primary/10 border border-primary/20
                        @else
                            text-gray-600 hover:bg-gray-100 hover:text-gray-900 @endif">
                        <svg class="w-5 h-5 mr-3 @if (request()->routeIs('admin.users.*')) text-primary @endif" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                            </path>
                        </svg>
                        Users
                    </a>
                    <a href="#"
                        class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Orders
                    </a>
                    <a href="{{ route('admin.applications.index') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Application
                    </a>
                    <a href="{{ route('admin.scholarships.index') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors
                        @if (request()->routeIs('admin.scholarships.*')) text-primary bg-primary/10 border border-primary/20
                        @else
                            text-gray-600 hover:bg-gray-100 hover:text-gray-900 @endif">
                        <svg class="w-5 h-5 mr-3 @if (request()->routeIs('admin.scholarships.*')) text-primary @endif" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Scholarships
                    </a>
                </div>
            </div>
            @auth
                <div class="pt-6">
                    <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Account</h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('profile.show') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline w-full">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </nav>
    </aside>
    <main class="ml-64 min-h-screen">
        <header class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-5 5v-5z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </header>
        @auth
            @if(Auth::user()->is_admin)
                {{-- Admin dashboard content is inside admin/dashboard.blade.php --}}
            @else
                <div class="px-6 py-8">
                    <h1 class="text-2xl font-bold mb-6">Your Dashboard</h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
                        <div class="bg-white p-6 rounded shadow flex flex-col items-center text-center">
                            <div class="text-3xl font-bold text-indigo-600">{{ $appStats['applied'] }}</div>
                            <div class="text-gray-700 mt-2">Applications Submitted</div>
                        </div>
                        <div class="bg-white p-6 rounded shadow flex flex-col items-center text-center">
                            <div class="text-3xl font-bold text-green-600">{{ $appStats['scholarships'] }}</div>
                            <div class="text-gray-700 mt-2">Available Scholarships</div>
                        </div>
                    </div>
                    <div class="bg-white rounded shadow p-6">
                        <h2 class="text-lg font-semibold mb-4">My Recent Applications</h2>
                        @if(count($recentUserApplications))
                            <ul>
                                @foreach($recentUserApplications as $app)
                                <li class="border-b last:border-0 py-2 flex justify-between items-start">
                                    <span>
                                        <span class="font-semibold">{{ $app->scholarship->scholarship_name }}</span>
                                        — <span class="text-sm text-gray-500 capitalize">{{ $app->status }}</span>
                                    </span>
                                    <span class="text-xs text-gray-500">{{ $app->created_at->diffForHumans() }}</span>
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-gray-500">You have not submitted any applications yet.</div>
                        @endif
                    </div>
                </div>
            @endif
        @endauth
        @yield('content')
    </main>
</body>

</html>
