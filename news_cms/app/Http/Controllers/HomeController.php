<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredArticles = Article::with(['category', 'user'])
            ->published()
            ->featured()
            ->latest('published_at')
            ->take(2)
            ->get();

        $latestArticles = Article::with(['category', 'user'])
            ->published()
            ->latest('published_at')
            ->paginate(10);

        return view('home', compact('featuredArticles', 'latestArticles'));
    }
}
