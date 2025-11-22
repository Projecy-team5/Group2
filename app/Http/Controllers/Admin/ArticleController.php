<?php
// app/Http/Controllers/Admin/ArticleController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('categories')->latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // VALIDATION (clean — no logic here!)
        $request->validate([
            'title'       => 'required|unique:articles,title',
            'excerpt'     => 'nullable|string',
            'content'     => 'required',
            'categories'  => 'required|array',
            'categories.*'=> 'exists:categories,id',
            'published'   => 'sometimes|boolean',        // just accept boolean
            'published_at'=> 'nullable|date',
        ]);

        // NOW process the published logic AFTER validation
        $published = $request->boolean('published', false);
        $publishedAt = $published ? ($request->published_at ?? now()) : null;

        $article = Article::create([
            'title'        => $request->title,
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'published'    => $published,
            'published_at' => $publishedAt,
        ]);

        $article->categories()->sync($request->categories);

        return redirect()->route('admin.articles.index')->with('success', 'Article created!');
    }

    public function edit(Article $article)
    {
        $categories = Category::orderBy('name')->get();
        $article->load('categories');
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'       => 'required|unique:articles,title,' . $article->id,
            'excerpt'     => 'nullable|string',
            'content'     => 'required',
            'categories'  => 'required|array',
            'categories.*'=> 'exists:categories,id',
            'published'   => 'sometimes|boolean',
            'published_at'=> 'nullable|date',
        ]);

        $published = $request->boolean('published', false);
        $publishedAt = $published ? ($request->published_at ?? now()) : null;

        $article->update([
            'title'        => $request->title,
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'published'    => $published,
            'published_at' => $publishedAt,
        ]);

        $article->categories()->sync($request->categories);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated!');
    }

    public function destroy(Article $article)
    {
        $article->categories()->detach();
        $article->delete();
        return back()->with('success', 'Article deleted!');
    }
}
