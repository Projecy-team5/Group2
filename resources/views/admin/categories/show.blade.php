@extends('layouts.dashboard')
@section('content')
    <div class="p-6 pt-5 space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 px-6 py-5">
                <div>
                    <h1 class="text-xl font-bold text-slate-900">{{ $category->name }}</h1>
                    <p class="text-sm text-slate-500">{{ __('Category overview and recent articles') }}.</p>
                </div>
            </div>
            <div class="px-6 py-6 space-y-6">
                <div
                    class="grid gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-4 text-sm text-slate-600 lg:grid-cols-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('Slug') }}</p>
                        <p class="mt-1 text-base font-semibold text-slate-900">{{ $category->slug }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('Articles') }}</p>
                        <p
                            class="mt-1 inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-800">
                            {{ $category->articles_count }} linked
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('Create') }}</p>
                        <p class="mt-1 text-base font-semibold text-slate-900">{{ $category->created_at->format('M d, Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">{{ 'Last updated' }}</p>
                        <p class="mt-1 text-base font-semibold text-slate-900">{{ $category->updated_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                    <h2 class="text-lg font-semibold text-slate-900">{{ __('Description') }}</h2>
                    <p class="mt-2 text-sm text-slate-600">
                        {{ $category->description ?: 'No description provided for this category yet.' }}
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-slate-900">{{ __('Recent Articles') }}</h2>
                        <a href="{{ route('admin.articles.index', ['category' => $category->id]) }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-sky-600 transition hover:text-sky-700">
                            {{ __('Manage articles') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    <div class="mt-4">
                        @if ($category->articles->isEmpty())
                            <p class="text-sm text-slate-500">{{ __('No articles found for this category yet.') }}</p>
                        @else
                            <ul class="divide-y divide-slate-100">
                                @foreach ($category->articles as $article)
                                    <li class="py-3">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="font-semibold text-slate-900">{{ $article->title }}</p>
                                                <p class="text-xs text-slate-500">Published
                                                    {{ $article->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <a href="{{ route('admin.articles.edit', $article) }}"
                                                class="text-sm font-semibold text-sky-600 hover:text-sky-700">{{ __('Edit') }}</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end border-t border-slate-100 pt-4">
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            class="inline-flex items-center gap-2 rounded-xl border border-rose-200 px-4 py-2 mr-2 text-sm font-semibold text-rose-600 shadow-sm transition hover:bg-rose-50"
                            onclick="showDeleteModal(this.form)">
                            {{ __('Delete Category') }}
                        </button>
                    </form>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.categories.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-slate-300 hover:bg-slate-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            {{ __('Back to categories') }}
                        </a>
                        <a href="{{ route('admin.categories.edit', $category) }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-sky-500 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-600">
                            {{ __('Edit Category') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <x-delete-confirmation />
    </div>
@endsection
