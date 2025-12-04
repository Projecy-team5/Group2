@extends('layouts.dashboard')

@section('content')
    <div class="p-6 pt-0 space-y-6">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-blue-600">Article Categories</p>
                <h1 class="text-3xl font-bold text-gray-900">Update {{ $category->name }}</h1>
                <p class="mt-1 text-sm text-gray-600">Match the same visual weight as the user CRUD so everything feels cohesive.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.categories.show', $category) }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-gray-300 hover:bg-gray-50">
                    Preview details
                </a>
                <a href="{{ route('admin.categories.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-gray-300 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to categories
                </a>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-gray-100 px-6 py-4">
                    <span
                        class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Edit category</h2>
                        <p class="text-sm text-gray-500">Changes go live immediately across all linked articles.</p>
                    </div>
                </div>
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="px-6 py-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div class="group">
                            <div class="flex items-center justify-between">
                                <label for="name" class="text-sm font-medium text-gray-700">Category name</label>
                                <span class="text-xs font-medium uppercase tracking-wide text-gray-400">Required</span>
                            </div>
                            <div class="relative mt-2">
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $category->name) }}" required
                                    class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 pl-11 text-gray-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 focus:border-red-500 focus:ring-red-500 @enderror"
                                    placeholder="e.g., Student Life" autocomplete="off">
                                <span
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 20l9-5-9-5-9 5 9 5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 12l9-5-9-5-9 5 9 5z" />
                                    </svg>
                                </span>
                            </div>
                            @error('name')
                                <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="15" y1="9" x2="9" y2="15" />
                                        <line x1="9" y1="9" x2="15" y2="15" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">Avoid renaming frequently used categories unless
                                necessary.</p>
                        </div>

                        <div class="group">
                            <div class="flex items-center justify-between">
                                <label for="description" class="text-sm font-medium text-gray-700">Description</label>
                                <span class="text-xs font-medium text-gray-400">Optional</span>
                            </div>
                            <div class="relative mt-2">
                                <textarea name="description" id="description" rows="4"
                                    class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 pl-11 text-gray-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500"
                                    placeholder="Explain when to use this category">{{ old('description', $category->description) }}</textarea>
                                <span class="pointer-events-none absolute top-3 left-4 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4-.83L3 20l1.53-3.58A8.68 8.68 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </span>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Keep it actionable so other editors know when to tag
                                articles.</p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center justify-between gap-3 border-t border-gray-100 pt-5">
                        <a href="{{ route('admin.categories.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:border-gray-300 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save changes
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-span-12 rounded-2xl border border-dashed border-emerald-200 bg-emerald-50/50 p-6 text-sm text-gray-700">
                <p class="text-xs font-semibold uppercase tracking-widest text-emerald-600">Snapshot</p>
                <div class="mt-4 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Slug</p>
                        <p class="mt-1 font-semibold text-gray-900">{{ $category->slug }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Linked articles</p>
                        <p class="mt-1 inline-flex items-center rounded-full bg-white px-3 py-1 text-xs font-semibold text-emerald-600 shadow">{{ $category->articles_count ?? $category->articles->count() }} total</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Created</p>
                        <p class="mt-1 font-semibold text-gray-900">{{ $category->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Updated</p>
                        <p class="mt-1 font-semibold text-gray-900">{{ $category->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
