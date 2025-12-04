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
    @stack('styles')
</head>

<body class="bg-gray-50 font-sans">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 bg-gray-900/40 hidden lg:hidden"></div>
    <aside id="dashboardSidebar"
        class="dashboard-sidebar sidebar-desktop-expanded group fixed inset-y-0 left-0 z-50 w-64 transform -translate-x-full bg-white border-r border-gray-200 shadow-sm transition-all duration-300 ease-in-out lg:translate-x-0">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 lg:hidden">
            <span class="text-sm font-semibold text-gray-700">Navigation</span>
            <button type="button" class="p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100"
                data-sidebar-close aria-label="Close sidebar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        @auth
            <div class="p-6 border-b border-gray-200 sidebar-hover-show">
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
        <nav class="dashboard-nav px-4 py-6 space-y-4">
            <div class="space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-600 rounded-lg transition-all hover:bg-gray-100 hover:text-gray-900">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 7 4-4 4 4"></path>
                    </svg>
                    <span class="sidebar-label">Dashboard</span>
                </a>
            </div>
            <div class="pt-2">
                <h3
                    class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider sidebar-hover-show">
                    Management
                </h3>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('admin.users.index') }}"
                        class="sidebar-link flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-all
                        @if (request()->routeIs('admin.users.*')) text-primary bg-primary/10 border border-primary/20
                        @else
                            text-gray-600 hover:bg-gray-100 hover:text-gray-900 @endif">
                        <svg class="w-5 h-5 flex-shrink-0 @if (request()->routeIs('admin.users.*')) text-primary @endif" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                            </path>
                        </svg>
                        <span class="sidebar-label">Users</span>
                    </a>
                    <a href="{{ route('admin.roles.index') }}"
                        class="sidebar-link flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-all
                        @if (request()->routeIs('admin.roles.*')) text-primary bg-primary/10 border border-primary/20
                        @else
                            text-gray-600 hover:bg-gray-100 hover:text-gray-900 @endif">
                        <svg class="w-5 h-5 flex-shrink-0 @if (request()->routeIs('admin.roles.*')) text-primary @endif" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 2l7 4v6c0 5-3.8 9.4-7 10-3.2-.6-7-5-7-10V6l7-4z"></path>
                        </svg>
                        <span class="sidebar-label">Roles</span>
                    </a>
                    <a href="{{ route('admin.applications.index') }}"
                        class="sidebar-link flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-all
                        @if (request()->routeIs('admin.applications.*')) text-primary bg-primary/10 border border-primary/20
                        @else
                            text-gray-600 hover:bg-gray-100 hover:text-gray-900 @endif">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="sidebar-label">Applications</span>
                    </a>
                    <a href="{{ route('admin.scholarships.index') }}"
                        class="sidebar-link flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-all
                        @if (request()->routeIs('admin.scholarships.*')) text-primary bg-primary/10 border border-primary/20
                        @else
                            text-gray-600 hover:bg-gray-100 hover:text-gray-900 @endif">
                        <svg class="w-5 h-5 flex-shrink-0 @if (request()->routeIs('admin.scholarships.*')) text-primary @endif" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span class="sidebar-label">Scholarships</span>
                    </a>
                    <a href="{{ route('admin.articles.index') }}"
                        class="sidebar-link flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-all
                        @if (request()->routeIs('admin.articles.*')) text-primary bg-primary/10 border border-primary/20
                        @else
                            text-gray-600 hover:bg-gray-100 hover:text-gray-900 @endif">
                        <svg class="w-5 h-5 flex-shrink-0 @if (request()->routeIs('admin.articles.*')) text-primary @endif" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span class="sidebar-label">Articles</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                        class="sidebar-link flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-all
                        @if (request()->routeIs('admin.categories.*')) text-primary bg-primary/10 border border-primary/20
                        @else
                            text-gray-600 hover:bg-gray-100 hover:text-gray-900 @endif">
                        <svg class="w-5 h-5 flex-shrink-0 @if (request()->routeIs('admin.categories.*')) text-primary @endif" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span class="sidebar-label">Article Categories</span>
                    </a>
                    <a href="{{ route('admin.contacts.index') }}"
                        class="sidebar-link flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-all
                        @if (request()->routeIs('admin.contacts.*')) text-primary bg-primary/10 border border-primary/20
                        @else
                            text-gray-600 hover:bg-gray-100 hover:text-gray-900 @endif">
                        <svg class="w-5 h-5 flex-shrink-0 @if (request()->routeIs('admin.contacts.*')) text-primary @endif" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="sidebar-label">Contact Messages</span>
                        @php
                            $unreadCount = \App\Models\Contact::where('is_read', false)->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="ml-auto inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>
            @auth
                <div class="pt-2">
                    <h3
                        class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider sidebar-hover-show">
                        Account
                    </h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('profile.show') }}"
                            class="sidebar-link flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-600 rounded-lg transition-all hover:bg-gray-100 hover:text-gray-900">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="sidebar-label">Profile</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline w-full">
                            @csrf
                            <button type="submit"
                                class="sidebar-link flex items-center gap-3 w-full px-3 py-2 text-sm font-medium text-gray-600 rounded-lg transition-all hover:bg-gray-100 hover:text-gray-900">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                <span class="sidebar-label">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </nav>
    </aside>
    <main id="dashboardMain" class="min-h-screen transition-[margin-left] duration-300 ease-in-out lg:ml-0">
        <header class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <button type="button"
                        class="p-2 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary"
                        data-sidebar-toggle aria-label="Toggle sidebar" aria-expanded="false">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button type="button" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-5 5v-5z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </header>
        @auth
            @if (Auth::user()->isAdmin())
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
                        @if (count($recentUserApplications))
                            <ul>
                                @foreach ($recentUserApplications as $app)
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
    <div aria-hidden="true" class="hidden lg:-translate-x-full lg:translate-x-0 lg:ml-0 lg:ml-64"></div>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('dashboardSidebar');
            const main = document.getElementById('dashboardMain');
            const overlay = document.getElementById('sidebarOverlay');
            const toggles = document.querySelectorAll('[data-sidebar-toggle]');
            const closers = document.querySelectorAll('[data-sidebar-close]');
            const CLOSED_CLASS = '-translate-x-full';
            const OPEN_CLASS = 'translate-x-0';
            const LG_MAIN_OPEN = 'lg:ml-64';
            const LG_MAIN_COLLAPSED = 'lg:ml-20';
            const LG_MAIN_CLOSED = 'lg:ml-0';
            const DESKTOP_COLLAPSED_CLASS = 'sidebar-desktop-collapsed';
            const DESKTOP_EXPANDED_CLASS = 'sidebar-desktop-expanded';
            const DESKTOP_WIDTH = 1024;
            let desktopState = 'expanded';

            if (!sidebar) {
                return;
            }

            const isDesktop = () => window.innerWidth >= DESKTOP_WIDTH;

            const setToggleState = (expanded) => {
                toggles.forEach((toggle) => toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false'));
            };

            const applyDesktopState = () => {
                if (!isDesktop()) {
                    return;
                }

                const expanded = desktopState === 'expanded';
                sidebar.classList.toggle(DESKTOP_EXPANDED_CLASS, expanded);
                sidebar.classList.toggle(DESKTOP_COLLAPSED_CLASS, !expanded);
                sidebar.classList.add(OPEN_CLASS);
                sidebar.classList.remove(CLOSED_CLASS);
                overlay?.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');

                if (expanded) {
                    main?.classList.add(LG_MAIN_OPEN);
                    main?.classList.remove(LG_MAIN_COLLAPSED, LG_MAIN_CLOSED);
                } else {
                    main?.classList.add(LG_MAIN_COLLAPSED);
                    main?.classList.remove(LG_MAIN_OPEN, LG_MAIN_CLOSED);
                }

                setToggleState(expanded);
            };

            const setDesktopState = (state) => {
                desktopState = state;
                applyDesktopState();
            };

            const openMobileSidebar = () => {
                sidebar.classList.add(OPEN_CLASS);
                sidebar.classList.remove(CLOSED_CLASS);
                overlay?.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                setToggleState(true);
            };

            const closeMobileSidebar = () => {
                sidebar.classList.add(CLOSED_CLASS);
                sidebar.classList.remove(OPEN_CLASS);
                overlay?.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                main?.classList.add(LG_MAIN_CLOSED);
                main?.classList.remove(LG_MAIN_OPEN, LG_MAIN_COLLAPSED);
                setToggleState(false);
            };

            const openSidebar = () => {
                if (isDesktop()) {
                    setDesktopState('expanded');
                } else {
                    openMobileSidebar();
                }
            };

            const closeSidebar = () => {
                if (isDesktop()) {
                    setDesktopState('collapsed');
                } else {
                    closeMobileSidebar();
                }
            };

            const isSidebarExpanded = () => {
                if (isDesktop()) {
                    return desktopState === 'expanded';
                }

                return sidebar.classList.contains(OPEN_CLASS) && !sidebar.classList.contains(CLOSED_CLASS);
            };

            toggles.forEach((toggle) => {
                toggle.addEventListener('click', () => {
                    if (isSidebarExpanded()) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                });
            });

            closers.forEach((closer) => closer.addEventListener('click', closeSidebar));
            overlay?.addEventListener('click', closeSidebar);

            const handleResize = () => {
                if (isDesktop()) {
                    applyDesktopState();
                } else {
                    closeMobileSidebar();
                }
            };

            handleResize();
            window.addEventListener('resize', handleResize);
        });
    </script>
</body>
</html>
