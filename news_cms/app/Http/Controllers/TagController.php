<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $articles = $tag->articles()
            ->with(['user', 'category'])
            ->published()
            ->latest('published_at')
            ->paginate(10);

        return view('articles.index', [
            'articles' => $articles,
            'categories' => \App\Models\Category::all(),
            'currentTag' => $tag
        ]);
    }
}
