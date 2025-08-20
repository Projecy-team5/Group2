@extends('layouts.dashboard')
@section('content')
    <div class="p-6 pt-0">
        <div class="space-y-4">
            <div class="flex items-center py-2 justify-between gap-4">
                <div class="flex items-center gap-4 flex-1">
                    <div class="flex items-center gap-3">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Edit User</h1>
                            <p class="text-gray-600 text-sm">Update user information and account settings</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mr-1">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        ID: #{{ $user->id }}
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="text-center">
                            <div class="relative inline-block mb-4">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                        class="w-20 h-20 object-cover rounded-full shadow-lg border-4 border-white">
                                @else
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full shadow-lg border-4 border-white flex items-center justify-center">
                                        <span class="text-white font-bold text-2xl">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div
                                    class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 border-2 border-white rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                        <path d="M20 6 9 17l-5-5" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-600 mb-4">{{ $user->email }}</p>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="font-medium text-gray-900">Joined</div>
                                    <div class="text-gray-600">{{ $user->created_at->format('M d, Y') }}</div>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="font-medium text-gray-900">Status</div>
                                    <div class="text-green-600 font-medium">Active</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-blue-600">
                                    <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path
                                        d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                </svg>
                                Account Information
                            </h2>
                            <p class="text-sm text-gray-600 mt-1">Update the user's basic information and credentials</p>
                        </div>
                        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6">
                            @csrf
                            @method('PUT')
                            <div class="space-y-6">
                                <div class="group">
                                    <label for="name"
                                        class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                        Full Name
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', $user->name) }}"
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                            required>
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="text-gray-400">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                                <circle cx="12" cy="7" r="4" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('name')
                                        <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="group">
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="text-gray-500">
                                            <rect width="20" height="16" x="2" y="4" rx="2" />
                                            <path d="m22 7-10 5L2 7" />
                                        </svg>
                                        Email Address
                                    </label>
                                    <div class="relative">
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', $user->email) }}"
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                            required>
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="text-gray-400">
                                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                                <path d="m22 7-10 5L2 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- New Password -->
                                    <div class="group">
                                        <label for="password"
                                            class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="text-gray-500">
                                                <rect width="18" height="11" x="3" y="11" rx="2"
                                                    ry="2" />
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                            </svg>
                                            New Password
                                        </label>
                                        <div class="relative">
                                            <input type="password" name="password" id="password"
                                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                                placeholder="Leave blank to keep current">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="text-gray-400">
                                                    <rect width="18" height="11" x="3" y="11" rx="2"
                                                        ry="2" />
                                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <line x1="15" y1="9" x2="9" y2="15" />
                                                    <line x1="9" y1="9" x2="15" y2="15" />
                                                </svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="group">
                                        <label for="password_confirmation"
                                            class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="text-gray-500">
                                                <rect width="18" height="11" x="3" y="11" rx="2"
                                                    ry="2" />
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                            </svg>
                                            Confirm Password
                                        </label>
                                        <div class="relative">
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation"
                                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                                                placeholder="Leave blank to keep current">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="text-gray-400">
                                                    <rect width="18" height="11" x="3" y="11" rx="2"
                                                        ry="2" />
                                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex items-start gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="text-blue-600 mt-0.5 flex-shrink-0">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M12 16v-4" />
                                            <path d="M12 8h.01" />
                                        </svg>
                                        <div class="text-sm">
                                            <p class="text-blue-800 font-medium">Password Update Information</p>
                                            <p class="text-blue-700 mt-1">Leave password fields empty to keep the current
                                                password unchanged. If you enter a new password, make sure it meets the
                                                security requirements.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200 mt-8">
                                <a href="{{ route('admin.users.index') }}"
                                    class="inline-flex items-center justify-center gap-2 px-6 py-3 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18" />
                                        <path d="M6 6l12 12" />
                                    </svg>
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                        <polyline points="17,21 17,13 7,13 7,21" />
                                        <polyline points="7,3 7,8 15,8" />
                                    </svg>
                                    Update User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
