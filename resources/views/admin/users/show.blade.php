@extends('layouts.dashboard')
@section('content')
    <div class="p-6 pt-0">
        <div class="space-y-4">
            <div class="flex items-center py-2 justify-between gap-4">
                <div class="flex items-center gap-4 flex-1">
                    <h1 class="text-3xl font-bold text-gray-900">User Details</h1>
                </div>
            </div>
        </div>
        <div class="rounded-md border border-[#b8bbc0]" style="margin-top:15px;">
            <div class="p-6">
                <div class="flex items-center gap-4 mb-6">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                            class="w-16 h-16 object-cover rounded-full shadow-sm border border-gray-200">
                    @else
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full shadow-sm border border-gray-200 flex items-center justify-center">
                            <span class="text-blue-600 font-medium text-lg">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900">{{ $user->name }}</h2>
                        <div class="flex items-center gap-2 text-sm mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-mail h-4 w-4 text-gray-500">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-10 5L2 7"></path>
                            </svg>
                            <span class="text-gray-700">{{ $user->email }}</span>
                        </div>
                        @if ($user->email_verified_at)
                            <div
                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-green-700 border-green-300 bg-green-50 font-medium mt-2">
                                ● Verified Account
                            </div>
                        @else
                            <div
                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-red-700 border-red-300 bg-red-50 font-medium mt-2">
                                ● Unverified Account
                            </div>
                        @endif
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 pt-4 border-t">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">User ID</p>
                        <p class="font-semibold text-gray-900">#{{ $user->id }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Member Since</p>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-calendar h-4 w-4 text-purple-500">
                                <path d="M8 2v4"></path>
                                <path d="M16 2v4"></path>
                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                <path d="M3 10h18"></path>
                            </svg>
                            <span class="text-gray-600">{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Last Updated</p>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-calendar h-4 w-4 text-purple-500">
                                <path d="M8 2v4"></path>
                                <path d="M16 2v4"></path>
                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                <path d="M3 10h18"></path>
                            </svg>
                            <span class="text-gray-600">{{ $user->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-2 pt-4 border-t">
                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-gray-300 bg-white text-gray-700 shadow-sm hover:bg-gray-50 h-8 rounded-md px-3 text-xs">
                        ← Back to Users
                    </a>
                    <a href="{{ route('admin.users.edit', $user) }}">
                        <button
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all duration-300 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-green-50 hover:text-green-700 hover:border-green-200 hover:shadow-md h-8 rounded-md px-3 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-square-pen h-4 w-4 mr-1">
                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path
                                    d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z">
                                </path>
                            </svg>
                            Edit
                        </button>
                    </a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all duration-300 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-red-50 hover:text-red-700 hover:border-red-200 hover:shadow-md h-8 rounded-md px-3 text-xs text-red-600"
                            onclick="showDeleteModal(this.form)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trash2 h-4 w-4 mr-1">
                                <path d="M10 11v6"></path>
                                <path d="M14 11v6"></path>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                                <path d="M3 6h18"></path>
                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-delete-confirmation />
@endsection
