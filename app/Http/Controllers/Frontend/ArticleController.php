<?php
// app/Http/Controllers/Frontend/ArticleController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    // 1. All Articles – http://127.0.0.1:8000/articles
    public function index()
    {
        $articles = Article::published()
            ->with('categories')
            ->latest('published_at')
            ->paginate(12);

        $categories = $this->getActiveCategories();

        return view('frontend.articles.index', compact('articles', 'categories'));
    }

    // 2. Single Article – http://127.0.0.1:8000/articles/your-slug
    public function show($slug)
    {
        $article = Article::published()
            ->with('categories')
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Article::published()
            ->whereHas('categories', fn($q) => $q->whereIn('category_id', $article->categories->pluck('id')))
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        $categories = $this->getActiveCategories();

        // FIXED: Use the correct show.blade.php
        return view('frontend.articles.show', compact('article', 'related', 'categories'));
    }

    // 3. Category Page – http://127.0.0.1:8000/category/scholarship-guides
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $articles = $category->articles()
            ->published()
            ->with('categories')
            ->latest('published_at')
            ->paginate(12);

        $categories = $this->getActiveCategories();

        return view('frontend.articles.category', compact('category', 'articles', 'categories'));
    }

    // Helper: Only categories with published articles (works on SQLite!)
    private function getActiveCategories()
    {
        return Category::whereHas('articles', fn($q) => $q->published())
            ->withCount(['articles as articles_count' => fn($q) => $q->published()])
            ->orderBy('name')
            ->get();
    }
}
