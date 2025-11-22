@extends('layouts.dashboard')
@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">All Articles</h1>
            <a href="{{ route('admin.articles.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition transform hover:scale-105">
                ✍️ Write New Article
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($articles as $article)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-gray-900 line-clamp-2">
                                {{ $article->title }}
                            </h3>
                            <span class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                {{ $article->published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $article->published ? 'Published' : 'Draft' }}
                            </span>
                        </div>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                        </p>

                        <div class="mb-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($article->categories as $category)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                                @if($article->categories->isEmpty())
                                    <span class="text-gray-400 text-xs">No categories</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $article->created_at->format('M d, Y') }}</span>
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.articles.edit', $article) }}"
                                   class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>

                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Delete this article permanently?')"
                                            class="text-red-600 hover:text-red-900 font-medium">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-gray-500 text-lg">No articles yet. Start writing your first one!</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $articles->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
@endsection
