@extends('layouts.dashboard')

@section('content')
    <div class="p-6 pt-0">
        <div class="space-y-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex-1 min-w-[220px]">
                    <h1 class="text-xl font-bold text-gray-900">{{ __('Article Categories') }}</h1>
                </div>
                <div class="space-x-2 mt-3">
                    <a href="{{ route('admin.categories.create') }}"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 bg-blue-600 text-white shadow hover:bg-blue-700 h-10 rounded-md px-4 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-plus h-4 w-4" aria-hidden="true">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        {{ __('New Category') }}
                    </a>
                </div>
            </div>
            @if (session('success'))
                <div
                    class="flex items-center gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-md border border-[#b8bbc0] bg-white/90 shadow-sm">
                <div class="relative w-full overflow-auto">
                    <table class="w-full caption-bottom text-sm">
                        <thead class="[&_tr]:border-b">
                            <tr class="border-b transition-colors">
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                    {{ __('Category') }}</th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                    {{ __('Slug') }}</th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                    {{ __('Articles') }}</th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                    {{ __('Updated') }}</th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 w-[160px]">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="[&_tr:last-child]:border-0">
                            @forelse ($categories as $category)
                                <tr
                                    class="border-b data-[state=selected]:bg-muted hover:bg-gray-50 transition-colors duration-200">
                                    <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="h-10 w-10 rounded-xl border border-blue-100 bg-blue-50 text-blue-600 flex items-center justify-center shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 12h10m-7 6h7" />
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="font-semibold text-gray-900 truncate max-w-[220px]"
                                                    title="{{ $category->name }}">
                                                    {{ $category->name }}
                                                </div>
                                                <p class="text-xs text-gray-500 truncate max-w-[260px]">
                                                    {{ $category->description ? \Illuminate\Support\Str::limit($category->description, 70) : 'No description added yet.' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                        <div class="flex items-center gap-2 text-sm font-mono text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 4h6v6m-10 5 9-9" />
                                            </svg>
                                            <span>{{ $category->slug }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                        <span
                                            class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium text-indigo-700 border-indigo-200 bg-indigo-50">
                                            {{ $category->articles_count ?? $category->articles->count() }}
                                            {{ __('articles') }}
                                        </span>
                                    </td>
                                    <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 2v4m8-4v4M3 10h18" />
                                                <rect width="18" height="12" x="3" y="8" rx="2"></rect>
                                            </svg>
                                            <span>{{ $category->updated_at->format('M j, Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                        <div class="relative inline-block text-left">
                                            <button type="button"
                                                class="inline-flex items-center justify-center w-8 h-8 text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                                onclick="toggleCategoryDropdown(event, 'category-dropdown-{{ $category->id }}', this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                </svg>
                                            </button>
                                            <div id="category-dropdown-{{ $category->id }}"
                                                class="hidden fixed z-50 w-48 bg-white border border-gray-200 rounded-md shadow-lg"
                                                onclick="event.stopPropagation()" style="display: none;">
                                                <div class="py-1">
                                                    <a href="{{ route('admin.categories.show', $category) }}"
                                                        class="flex items-center px-4 py-2 text-sm text-gray-700 transition hover:bg-blue-50 hover:text-blue-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="mr-2">
                                                            <circle cx="12" cy="12" r="10" />
                                                            <path d="M12 16v.01" />
                                                            <path d="M12 8v4" />
                                                        </svg>
                                                        {{ __('View details') }}
                                                    </a>
                                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                                        class="flex items-center px-4 py-2 text-sm text-gray-700 transition hover:bg-blue-50 hover:text-blue-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="mr-2">
                                                            <path d="M12 20h9" />
                                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                                        </svg>
                                                        {{ __('Edit category') }}
                                                    </a>
                                                    <form action="{{ route('admin.categories.destroy', $category) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Delete {{ $category->name }}? This will NOT delete articles.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="flex w-full items-center px-4 py-2 text-sm text-rose-600 transition hover:bg-rose-50 hover:text-rose-700">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="mr-2">
                                                                <polyline points="3 6 5 6 21 6" />
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                            </svg>
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-sm text-gray-500">
                                        {{ __('No categories yet. Create the first one!') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($categories->hasPages())
                <div class="rounded-lg border border-gray-200 bg-white px-4 py-3">
                    <div class="flex flex-col gap-3 text-sm text-gray-700 sm:flex-row sm:items-center sm:justify-between">
                        <span>Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of
                            {{ $categories->total() }} results</span>
                        <div class="flex items-center space-x-2">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function toggleCategoryDropdown(evt, dropdownId, buttonElement) {
            evt.stopPropagation();

            document.querySelectorAll('[id^="category-dropdown-"]').forEach(dropdown => {
                if (dropdown.id !== dropdownId) {
                    dropdown.classList.add('hidden');
                    dropdown.style.display = 'none';
                }
            });

            const dropdown = document.getElementById(dropdownId);
            const button = buttonElement || evt.currentTarget;

            if (dropdown.classList.contains('hidden')) {
                const rect = button.getBoundingClientRect();
                const dropdownWidth = 192;
                const dropdownHeight = 140;

                let left = rect.right - dropdownWidth;
                let top = rect.bottom + 8;

                if (left < 10) {
                    left = rect.left;
                }
                if (top + dropdownHeight > window.innerHeight - 10) {
                    top = rect.top - dropdownHeight - 8;
                }

                dropdown.style.left = `${left}px`;
                dropdown.style.top = `${top}px`;
                dropdown.style.display = 'block';
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
                dropdown.style.display = 'none';
            }
        }

        document.addEventListener('click', function(event) {
            const isInsideDropdown = event.target.closest('[id^="category-dropdown-"]') ||
                event.target.closest('button[onclick*="toggleCategoryDropdown"]');

            if (!isInsideDropdown) {
                document.querySelectorAll('[id^="category-dropdown-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                    dropdown.style.display = 'none';
                });
            }
        });

        ['scroll', 'resize'].forEach(eventType => {
            window.addEventListener(eventType, () => {
                document.querySelectorAll('[id^="category-dropdown-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                    dropdown.style.display = 'none';
                });
            });
        });
    </script>
@endsection
