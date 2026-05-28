<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index() {
        $headline = Article::with(['user', 'category'])->latest()->first();

        $latestNews = Article::with(['category'])
            ->latest()
            ->skip(1)
            ->take(4)
            ->get();

        $popularNews = Article::latest()
            ->take(3)
            ->get();

        $tags = Tag::take(10)->get();
        $categories = Category::take(10)->get();

        return view('index', compact('headline', 'latestNews', 'popularNews', 'tags', 'categories'));
    }

    public function show($slug) {
        $article = Article::with(['user.profile', 'category'])->where('slug', $slug)->firstOrFail();

        $popularNews = Article::latest()->take(3)->get();
        $tags = Tag::take(10)->get();
        $categories = Category::take(10)->get();

        return view('show', compact('article', 'popularNews', 'tags', 'categories'));
    }
}
