@extends('layouts.homepage')

@section('title', 'All Scholarship Guides')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-4">All Scholarship Guides</h1>
        <p class="text-gray-600">Click any card to read the complete step-by-step guide</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($articles as $article)

            <article class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                <div class="p-6">
                    @if($article->categories->count())
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full mb-3">
                            {{ $article->categories->first()->name }}
                        </span>
                    @endif

                    <h2 class="text-xl font-bold mb-2 line-clamp-2">
                        {{ $article->title }}
                    </h2>

                    @if($article->excerpt)
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $article->excerpt }}
                        </p>
                    @endif

                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span>{{ $article->published_at }}</span>
                        <span>{{ \Illuminate\Support\Str::readingTime($article->content) }} min read</span>
                    </div>

                    <a href="{{ route('articles.show', $article->slug) }}"
                       class="inline-block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                        Read Full Guide
                    </a>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">No guides published yet. Check back soon!</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</div>
@endsection
