@extends('layouts.dashboard')

@section('content')
    @php
        $selectedCategories = collect(old('categories', $article->categories->pluck('id')->all()))
            ->map(fn($id) => (string) $id)
            ->all();
    @endphp
    <div class="p-6 pt-0 space-y-6">
        <div class="flex flex-wrap items-start justify-between gap-4">
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
                        <h2 class="text-lg font-semibold text-gray-900">Article Content</h2>
                        <p class="text-sm text-gray-500">Changes go live immediately across the newsroom.</p>
                    </div>
                </div>
                <form action="{{ route('admin.articles.update', $article) }}" method="POST" class="px-6 py-6 space-y-8">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <div class="group">
                                <label for="title" class="text-sm font-medium text-gray-700">Title</label>
                                <div class="relative mt-2">
                                    <input type="text" id="title" name="title"
                                        value="{{ old('title', $article->title) }}" required
                                        class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 pl-11 text-gray-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500 @error('title') border-red-400 focus:border-red-500 focus:ring-red-500 @enderror"
                                        placeholder="Enter a catchy title">
                                    <span
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h8m-8 6h16" />
                                        </svg>
                                    </span>
                                </div>
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="group">
                                <div class="flex items-center justify-between">
                                    <label class="text-sm font-medium text-gray-700">Categories</label>
                                    <span
                                        class="text-xs font-semibold uppercase tracking-wider text-gray-400">Required</span>
                                </div>
                                <div class="mt-3 rounded-xl border border-gray-300 bg-gray-50 p-4">
                                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                        @foreach ($categories as $cat)
                                            <label
                                                class="flex items-center gap-3 cursor-pointer group/item hover:bg-white rounded-lg p-2 transition">
                                                <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                                                    {{ in_array((string) $cat->id, $selectedCategories, true) ? 'checked' : '' }}
                                                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition">
                                                <span
                                                    class="text-sm font-medium text-gray-700 group-hover/item:text-gray-900">{{ $cat->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">Select one or more categories for this article.</p>
                                @error('categories')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="group">
                            <label for="excerpt" class="text-sm font-medium text-gray-700">Excerpt (optional)</label>
                            <textarea id="excerpt" name="excerpt" rows="3"
                                class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-gray-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500"
                                placeholder="Short description used for teasers">{{ old('excerpt', $article->excerpt) }}</textarea>
                        </div>

                        <div class="group">
                            <label for="content" class="text-sm font-medium text-gray-700">Story content</label>
                            <textarea id="content" name="content" rows="12" required
                                class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 font-mono text-sm text-gray-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500 @error('content') border-red-400 focus:border-red-500 focus:ring-red-500 @enderror"
                                placeholder="Start writing your amazing article">{{ old('content', $article->content) }}</textarea>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">
                            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Publishing options</p>
                                    <p class="text-xs text-gray-500">Toggle visibility or adjust the scheduled time.</p>
                                </div>
                            </div>
                            <div class="mt-4 space-y-4">
                                <label class="flex items-center gap-3">
                                    <input type="hidden" name="published" value="0">
                                    <input type="checkbox" name="published" value="1"
                                        {{ old('published', $article->published) ? 'checked' : '' }}
                                        class="h-5 w-5 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="text-sm font-medium text-gray-800">Publish immediately</span>
                                </label>
                                <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                                    <label for="published_at" class="text-sm font-medium text-gray-700">Publish
                                        date</label>
                                    <input type="date" id="published_at" name="published_at"
                                        value="{{ old('published_at', optional($article->published_at)->format('Y-m-d')) }}"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:w-auto">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-end items-center justify-end gap-3 border-t border-gray-100 pt-5">
                        <a href="{{ route('admin.articles.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:border-gray-300 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
