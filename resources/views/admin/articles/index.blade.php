@extends('layouts.dashboard')

@section('content')
    <div class="p-6 pt-0">
        <div class="space-y-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex-1 min-w-[240px]">
                    <h1 class="text-3xl font-bold text-gray-900">Articles Library</h1>
                </div>
                <div class="space-x-2 mt-3">
                    <a href="{{ route('admin.articles.create') }}"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 bg-blue-600 text-white shadow hover:bg-blue-700 h-10 rounded-md px-4 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-4 w-4" aria-hidden="true">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        Write Article
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
                                    class="h-12 px-4 text-left align-middle font-medium text-gray-500 [&:has([role=checkbox])]:pr-0">
                                    Article</th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-gray-500 [&:has([role=checkbox])]:pr-0">
                                    Categories</th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-gray-500 [&:has([role=checkbox])]:pr-0">
                                    Published</th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-gray-500 [&:has([role=checkbox])]:pr-0">
                                    Updated</th>
                                <th
                                    class="h-12 px-4 text-left align-middle font-medium text-gray-500 [&:has([role=checkbox])]:pr-0 w-[120px]">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="[&_tr:last-child]:border-0">
                            @forelse ($articles as $article)
                                <tr class="border-b hover:bg-gray-50 transition-colors duration-200">
                                    <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <p class="font-semibold text-gray-900 truncate max-w-[320px]"
                                                    title="{{ $article->title }}">
                                                    {{ $article->title }}
                                                </p>
                                                <span
                                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $article->published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                                    {{ $article->published ? 'Published' : 'Draft' }}
                                                </span>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($article->excerpt ?? $article->content), 90) }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                        <div class="flex flex-wrap gap-2">
                                            @php
                                                $categoryPreview = $article->categories->take(3);
                                                $remaining = $article->categories->count() - $categoryPreview->count();
                                            @endphp
                                            @forelse ($categoryPreview as $category)
                                                <span
                                                    class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-semibold text-blue-700">
                                                    {{ $category->name }}
                                                </span>
                                            @empty
                                                <span class="text-xs text-gray-400">No categories</span>
                                            @endforelse
                                            @if ($remaining > 0)
                                                <span
                                                    class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-semibold text-gray-600">
                                                    +{{ $remaining }} more
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                        @if ($article->published_at)
                                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 2v4m8-4v4M3 10h18" />
                                                    <rect width="18" height="12" x="3" y="8" rx="2"></rect>
                                                </svg>
                                                <span>{{ $article->published_at->format('M j, Y') }}</span>
                                            </div>
                                        @else
                                            <span class="text-xs font-medium text-gray-400">Not scheduled</span>
                                        @endif
                                    </td>
                                    <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                        <div class="text-sm text-gray-600">
                                            {{ $article->updated_at->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                        <div class="relative inline-block text-left">
                                            <button type="button"
                                                class="inline-flex items-center justify-center w-8 h-8 text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                                onclick="toggleArticleDropdown(event, 'article-dropdown-{{ $article->id }}', this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                </svg>
                                            </button>
                                            <div id="article-dropdown-{{ $article->id }}"
                                                class="hidden fixed z-50 w-48 bg-white border border-gray-200 rounded-md shadow-lg"
                                                onclick="event.stopPropagation()" style="display: none;">
                                                <div class="py-1">
                                                    <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
                                                        rel="noopener"
                                                        class="flex items-center px-4 py-2 text-sm text-gray-700 transition hover:bg-blue-50 hover:text-blue-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="mr-2">
                                                            <path d="m18 13 6-6-6-6"></path>
                                                            <path d="M11 7h13v13"></path>
                                                            <path d="m2 22 10-10"></path>
                                                        </svg>
                                                        View on site
                                                    </a>
                                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                                        class="flex items-center px-4 py-2 text-sm text-gray-700 transition hover:bg-blue-50 hover:text-blue-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="mr-2">
                                                            <path d="M12 20h9" />
                                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                                        </svg>
                                                        Edit article
                                                    </a>
                                                    <form action="{{ route('admin.articles.destroy', $article) }}"
                                                        method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="flex w-full items-center px-4 py-2 text-sm text-rose-600 transition hover:bg-rose-50 hover:text-rose-700"
                                                            onclick="showDeleteModal(this.form)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="mr-2">
                                                                <polyline points="3 6 5 6 21 6" />
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-10 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m18 13 6-6-6-6M11 7h13v13M2 22l10-10" />
                                            </svg>
                                            No articles yet. Start writing your first story!
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($articles->hasPages())
                <div class="rounded-lg border border-gray-200 bg-white px-4 py-3">
                    <div class="flex flex-col gap-3 text-sm text-gray-700 sm:flex-row sm:items-center sm:justify-between">
                        <span>Showing {{ $articles->firstItem() ?? 0 }} to {{ $articles->lastItem() ?? 0 }} of
                            {{ $articles->total() }} results</span>
                        <div class="flex items-center space-x-2">
                            {{ $articles->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <x-delete-confirmation />
    <x-toast />

    <script>
        function toggleArticleDropdown(evt, dropdownId, buttonElement) {
            evt.stopPropagation();

            document.querySelectorAll('[id^="article-dropdown-"]').forEach(dropdown => {
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
            const isInsideDropdown = event.target.closest('[id^="article-dropdown-"]') ||
                event.target.closest('button[onclick*="toggleArticleDropdown"]');

            if (!isInsideDropdown) {
                document.querySelectorAll('[id^="article-dropdown-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                    dropdown.style.display = 'none';
                });
            }
        });

        ['scroll', 'resize'].forEach(eventType => {
            window.addEventListener(eventType, () => {
                document.querySelectorAll('[id^="article-dropdown-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                    dropdown.style.display = 'none';
                });
            });
        });
    </script>
@endsection
