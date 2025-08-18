@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">User Details</h1>
        <p class="text-gray-600 mt-2">View user information</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Information</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <img class="h-16 w-16 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                        @else
                            <div class="h-16 w-16 rounded-full bg-blue-600 flex items-center justify-center">
                                <span class="text-white font-medium text-xl">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h4>
                            <p class="text-gray-600">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">User ID</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->id }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email Verified</label>
                        <p class="mt-1 text-sm text-gray-900">
                            @if($user->email_verified_at)
                                <span class="text-green-600">Yes ({{ $user->email_verified_at->format('M d, Y H:i') }})</span>
                            @else
                                <span class="text-red-600">No</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Member Since</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('M d, Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.users.edit', $user) }}" 
                       class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200 text-center block">
                        Edit User
                    </a>
                    
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="w-full delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-200"
                                onclick="showDeleteModal(this.form)">
                            Delete User
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.users.index') }}" 
                       class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition duration-200 text-center block">
                        Back to Users
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<x-delete-confirmation />
@endsection