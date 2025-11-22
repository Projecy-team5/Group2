@extends('layouts.dashboardphp artisan migrate')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-4xl">
        <h1 class="text-3xl font-bold mb-6">{{ $category->name }}</h1>
        <p class="text-gray-600 mb-8">{{ $category->description ?? 'No description.' }}</p>

        <div class="flex items-center gap-8 text-sm text-gray-500 mb-8">
            <span>Slug: <code class="bg-gray-100 px-2 py-1 rounded">{{ $category->slug }}</code></span>
            <span>Articles: <strong>{{ $category->articles_count }}</strong></span>
            <span>Created: {{ $category->created_at->format('d M Y') }}</span>
        </div>

        <h2 class="text-xl font-semibold mb-4">Recent Articles</h2>
        @if($category->articles->count())
            <ul class="space-y-3">
                @foreach($category->articles as $article)
                <li class="flex justify-between items-center py-3 border-b">
                    <a href="{{ route('admin.articles.show', $article) }}" class="text-blue-600 hover:underline">
                        {{ $article->title }}
                    </a>
                    <span class="text-sm text-gray-500">{{ $article->published_at?->format('d M Y') ?? 'Draft' }}</span>
                </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No articles in this category yet.</p>
        @endif
    </div>
</div>
@endsection
