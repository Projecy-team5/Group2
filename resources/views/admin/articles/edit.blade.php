{{-- resources/views/admin/articles/create.blade.php & edit.blade.php --}}
@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                <h1 class="text-3xl font-bold text-white">
                    {{ isset($article) ? 'Edit Article' : 'Write New Article' }}
                </h1>
            </div>

            <div class="p-8">
                <form action="{{ isset($article) ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
                      method="POST" class="space-y-8">
                    @csrf
                    @if(isset($article)) @method('PUT') @endif

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                        <input type="text" name="title" required
                               value="{{ old('title', $article->title ?? '') }}"
                               class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition text-lg"
                               placeholder="Enter a catchy title...">
                        @error('title') <p class="mt-2 text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Excerpt (Optional)</label>
                        <textarea name="excerpt" rows="3"
                                  class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500"
                                  placeholder="Short description for SEO and previews...">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
                    </div>

                    <!-- Content -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Content</label>
                        <textarea name="content" rows="15" required
                                  class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 font-mono text-sm"
                                  placeholder="Start writing your amazing article...">{{ old('content', $article->content ?? '') }}</textarea>
                        @error('content') <p class="mt-2 text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Categories -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Categories <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-h-64 overflow-y-auto p-4 bg-gray-50 rounded-xl border">
                            @foreach($categories as $cat)
                                <label class="flex items-center space-x-3 cursor-pointer hover:bg-white p-3 rounded-lg transition">
                                    <input type="checkbox" name="categories[]"
                                           value="{{ $cat->id }}"
                                           {{ (isset($article) && $article->categories->contains($cat)) || in_array($cat->id, old('categories', [])) ? 'checked' : '' }}
                                           class="w-5 h-5 text-indigo-600 rounded focus:ring-indigo-500">
                                    <span class="text-gray-800 font-medium">{{ $cat->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('categories') <p class="mt-2 text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Publish Options -->
                    <div class="bg-gray-50 p-6 rounded-xl space-y-5">
                        <div class="flex items-center space-x-4">
                            <!-- Hidden field ensures 0 is sent when unchecked -->
                            <input type="hidden" name="published" value="0">
                            <input type="checkbox" name="published" value="1" id="published"
                                {{ old('published', $article->published ?? false) ? 'checked' : '' }}
                                class="w-6 h-6 text-green-600 rounded focus:ring-green-500">
                            <label for="published" class="text-lg font-semibold text-gray-800">
                                Publish this article
                            </label>
                        </div>

                        <div class="flex items-center space-x-4">
                            <label class="text-sm font-medium text-gray-700 w-32">Publish Date</label>
                            <input type="date" name="published_at"
       value="{{ old('published_at', $article->published_at) }}"
       class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center pt-8 border-t">
                        <a href="{{ route('admin.articles.index') }}"
                           class="text-gray-600 hover:text-gray-900 font-medium text-lg">
                            ← Back to Articles
                        </a>

                        <div class="space-x-4">
                            <button type="submit"
                                    class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-4 px-10 rounded-xl shadow-lg transform hover:scale-105 transition">
                                {{ isset($article) ? 'Update Article' : 'Publish Article' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
