@extends('layouts.homepage')

@section('title', $article->title)
@section('description', $article->excerpt ?? 'Scholarship guide')

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-16">
    <div class="max-w-4xl mx-auto px-6">
        <div class="flex flex-wrap gap-2 mb-4">
            @foreach($article->categories as $cat)
                <a href="{{ route('articles.category', $cat->slug) }}"
                   class="px-3 py-1 bg-white/20 backdrop-blur rounded-full text-sm font-semibold hover:bg-white/30 transition">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
        <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $article->title }}</h1>
        <div class="flex items-center gap-4 text-sm text-white/90">
            <span>{{ $article->published_at }}</span>
            <span>•</span>
            <span>{{ \Illuminate\Support\Str::readingTime($article->content) }} min read</span>
        </div>
    </div>
</div>
<div class="max-w-4xl mx-auto px-6 py-12">
    @if($article->excerpt)
        <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-r mb-8">
            <p class="text-lg text-gray-700 italic">
                {{ $article->excerpt }}
            </p>
        </div>
    @endif
    <article class="prose prose-lg max-w-none text-gray-700 leading-relaxed mb-12">
        {!! nl2br(e($article->content)) !!}
    </article>
    {{-- <div class="mb-12 pb-8 border-b border-gray-200">
        <p class="text-sm font-semibold text-gray-600 mb-3">Tags:</p>
        <div class="flex flex-wrap gap-2">
            @foreach($article->categories as $cat)
                <a href="{{ route('articles.category', $cat->slug) }}"
                   class="px-4 py-2 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full hover:bg-blue-200 transition">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div> --}}
    @if($related->count())
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Related Guides</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($related as $rel)
                    <a href="{{ route('articles.show', $rel->slug) }}"
                       class="block bg-white rounded-lg shadow-md hover:shadow-lg transition p-6">
                        <h3 class="text-lg font-bold mb-2 hover:text-blue-600">
                            {{ Str::limit($rel->title, 60) }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-3">
                            {{ Str::limit($rel->excerpt ?? strip_tags($rel->content), 100) }}
                        </p>
                        <span class="text-blue-600 font-semibold text-sm">Read →</span>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
    <div class="text-center">
        <a href="{{ route('articles.index') }}"
           class="inline-block bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-blue-700 transition">
            ← Back to All Guides
        </a>
    </div>
</div>
@endsection
