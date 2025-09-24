@extends('layouts.dashboard')
@section('content')
    <div class="p-6 pt-0">
        <div class="space-y-4">
            <div class="flex items-center py-2 justify-between gap-4">
                <div class="flex items-center gap-4 flex-1">
                    <h1 class="text-3xl font-bold text-gray-900">Users Management</h1>
                </div>
                <div class="space-x-2">
                    <a href="{{ route('admin.users.create') }}"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary text-primary-foreground shadow hover:bg-primary/90 h-8 rounded-md px-3 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-plus h-4 w-4" aria-hidden="true">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        Add User
                    </a>
                </div>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 border border-[#b8bbc0]">
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Search by Name</label>
                        <div class="relative">
                            <input type="text" name="name" id="name" value="{{ request('name') }}"
                                placeholder="Enter user name..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-3 text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="created_at" class="block text-sm font-medium text-gray-700 mb-2">Created Date</label>
                        <input type="date" name="created_at" id="created_at" value="{{ request('created_at') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-blue-600 text-white shadow hover:bg-blue-700 h-10 rounded-md px-4 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('admin.users.index') }}"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-gray-300 bg-white text-gray-700 shadow-sm hover:bg-gray-50 h-10 rounded-md px-4 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="rounded-md border border-[#b8bbc0]" style="margin-top:15px;">
            <div class="relative w-full overflow-auto">
                <table class="w-full caption-bottom text-sm">
                    <thead class="[&_tr]:border-b">
                        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                            <th
                                class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                ID</th>
                            <th
                                class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                User</th>
                            <th
                                class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                Email</th>
                            <th
                                class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                Created</th>
                            <th
                                class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 w-[100px]">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="[&_tr:last-child]:border-0">
                        @foreach ($users as $user)
                            <tr
                                class="border-b data-[state=selected]:bg-muted hover:bg-gray-50 transition-colors duration-200">
                                <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0 font-semibold text-gray-900">
                                    {{ $user->id }}
                                </td>
                                <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                                    class="w-10 h-10 object-cover rounded-full shadow-sm border border-gray-200">
                                            @else
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full shadow-sm border border-gray-200 flex items-center justify-center">
                                                    <span
                                                        class="text-blue-600 font-medium text-sm">{{ substr($user->name, 0, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 truncate max-w-[200px]"
                                                title="{{ $user->name }}">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                    <div class="flex items-center gap-2 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-mail h-4 w-4 text-gray-500" aria-hidden="true">
                                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                            <path d="m22 7-10 5L2 7"></path>
                                        </svg>
                                        <span class="text-gray-700">{{ $user->email }}</span>
                                    </div>
                                </td>
                                {{-- <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                            @if ($user->status === 'active')
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-calendar h-4 w-4 text-purple-500" aria-hidden="true">
                                            <path d="M8 2v4"></path>
                                            <path d="M16 2v4"></path>
                                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                            <path d="M3 10h18"></path>
                                        </svg>
                                        <span class="text-gray-600">{{ $user->created_at->format('n/j/Y') }}</span>
                                    </div>
                                </td>
                                <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                    <div class="relative inline-block text-left">
                                        <div>
                                            <button type="button"
                                                class="inline-flex items-center justify-center w-8 h-8 text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                                onclick="toggleDropdown('dropdown-{{ $user->id }}', this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                </svg>
                                            </button>
                                        </div>
                                        <div id="dropdown-{{ $user->id }}"
                                            class="hidden fixed z-50 w-48 bg-white border border-gray-200 rounded-md shadow-lg"
                                            onclick="event.stopPropagation()"
                                            style="display: none;">
                                            <div class="py-1">
                                                <a href="{{ route('admin.users.show', $user) }}"
                                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="mr-2">
                                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                    View Details
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="mr-2">
                                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                        </path>
                                                        <path
                                                            d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z">
                                                        </path>
                                                    </svg>
                                                    Edit User
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                    class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700"
                                                        onclick="showDeleteModal(this.form)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="mr-2">
                                                            <path d="M10 11v6"></path>
                                                            <path d="M14 11v6"></path>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                                                            <path d="M3 6h18"></path>
                                                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        </svg>
                                                        Delete User
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if ($users->hasPages())
            <div class="mt-6">
                <div
                    class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-white px-4 py-3 border rounded-lg">
                    <div class="text-sm text-gray-700">
                        <span>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }}
                            results</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
    <x-delete-confirmation />
    <x-toast />

    <script>
    function toggleDropdown(dropdownId, buttonElement) {
        event.stopPropagation();
        
        // Close all other dropdowns first
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            if (dropdown.id !== dropdownId) {
                dropdown.classList.add('hidden');
                dropdown.style.display = 'none';
            }
        });
        
        // Get the clicked dropdown
        const dropdown = document.getElementById(dropdownId);
        const button = buttonElement || event.target.closest('button');
        
        if (dropdown.classList.contains('hidden')) {
            // Position the dropdown
            const buttonRect = button.getBoundingClientRect();
            const dropdownWidth = 192; // w-48 = 12rem = 192px
            const dropdownHeight = 120; // Approximate height
            
            // Calculate position
            let left = buttonRect.right - dropdownWidth;
            let top = buttonRect.bottom + 8;
            
            // Adjust if dropdown would go off-screen
            if (left < 10) {
                left = buttonRect.left;
            }
            if (top + dropdownHeight > window.innerHeight - 10) {
                top = buttonRect.top - dropdownHeight - 8;
            }
            
            // Set position and show
            dropdown.style.left = left + 'px';
            dropdown.style.top = top + 'px';
            dropdown.style.display = 'block';
            dropdown.classList.remove('hidden');
        } else {
            // Hide dropdown
            dropdown.classList.add('hidden');
            dropdown.style.display = 'none';
        }
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const isInsideDropdown = event.target.closest('[id^="dropdown-"]') || 
                                event.target.closest('button[onclick*="toggleDropdown"]');
        
        if (!isInsideDropdown) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
                dropdown.style.display = 'none';
            });
        }
    });

    // Close dropdowns on scroll and resize
    ['scroll', 'resize'].forEach(eventType => {
        window.addEventListener(eventType, function() {
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
                dropdown.style.display = 'none';
            });
        });
    });
    </script>
@endsection
