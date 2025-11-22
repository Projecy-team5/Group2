{{-- http://127.0.0.1:8000/category/scholarship-guides --}}
@extends('layouts.homepage')
@section('title', $category->name . ' - Scholarship Guides')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-16">
    <div class="text-center mb-16">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-4">
            {{ $category->name }}
        </h1>
        <p class="text-xl text-gray-600">All guides in this category</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($articles as $article)
            @include('frontend.articles.partials.card', ['article' => $article])
        @empty
            <p class="col-span-full text-center text-2xl text-gray-500 py-20">
                No guides in this category yet.
            </p>
        @endforelse
    </div>

    <div class="mt-16 flex justify-center">
        {{ $articles->links() }}
    </div>
</div>
@endsection
