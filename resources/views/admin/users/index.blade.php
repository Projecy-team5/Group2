@extends('layouts.dashboard')

@section('content')
<div class="p-6 pt-0">
    <div class="space-y-4">
        <div class="flex items-center py-2 justify-between gap-4">
            <div class="flex items-center gap-4 flex-1">
                <h1 class="text-3xl font-bold text-gray-900">Users Management</h1>
            </div>
            <div class="space-x-2">
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary text-primary-foreground shadow hover:bg-primary/90 h-8 rounded-md px-3 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus h-4 w-4" aria-hidden="true">
                        <path d="M5 12h14"></path>
                        <path d="M12 5v14"></path>
                    </svg>
                    Add User
                </a>
            </div>
        </div>
    </div>

    <div class="rounded-md border">
        <div class="relative w-full overflow-auto">
            <table class="w-full caption-bottom text-sm">
                <thead class="[&_tr]:border-b">
                    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">Profile</th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">Name</th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">Email</th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">Created</th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 w-[100px]">Actions</th>
                    </tr>
                </thead>
                <tbody class="[&_tr:last-child]:border-0">
                    @foreach($users as $user)
                    <tr class="border-b data-[state=selected]:bg-muted hover:bg-gray-50 transition-colors duration-200">
                        <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                            <div class="flex items-center justify-center">
                                <div class="relative">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-12 h-12 object-cover rounded-full shadow-sm border border-gray-200">
                                    @else
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full shadow-sm border border-gray-200 flex items-center justify-center">
                                            <span class="text-blue-600 font-medium text-lg">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0 font-semibold text-gray-900">
                            <div class="truncate max-w-[200px]" title="{{ $user->name }}">{{ $user->name }}</div>
                        </td>
                        <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                            <div class="flex items-center gap-2 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail h-4 w-4 text-gray-500" aria-hidden="true">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-10 5L2 7"></path>
                                </svg>
                                <span class="text-gray-700">{{ $user->email }}</span>
                            </div>
                        </td>
                        {{-- <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                            @if($user->status === 'active')
                                <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-green-700 border-green-300 bg-green-50 font-medium">
                                    ● Active
                                </div>
                            @else
                                <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-red-700 border-red-300 bg-red-50 font-medium">
                                    ● Inactive
                                </div>
                            @endif
                        </td> --}}
                        <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                            <div class="flex items-center gap-2 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar h-4 w-4 text-purple-500" aria-hidden="true">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>
                                <span class="text-gray-600">{{ $user->created_at->format('n/j/Y') }}</span>
                            </div>
                        </td>
                        <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.users.show', $user) }}">
                                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-8 rounded-md px-3 text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye h-4 w-4 mr-1" aria-hidden="true">
                                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        View
                                    </button>
                                </a>
                                <a href="{{ route('admin.users.edit', $user) }}">
                                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-8 rounded-md px-3 text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen h-4 w-4 mr-1" aria-hidden="true">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                                        </svg>
                                        Edit
                                    </button>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent h-8 rounded-md px-3 text-xs text-red-600 hover:text-red-700" onclick="showDeleteModal(this.form)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 h-4 w-4 mr-1" aria-hidden="true">
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
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>

<!-- Delete Confirmation Modal -->
<x-delete-confirmation />
@endsection
