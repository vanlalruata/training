<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $articles = $category->articles()
            ->with(['user', 'category'])
            ->published()
            ->latest('published_at')
            ->paginate(10);

        return view('articles.index', [
            'articles' => $articles,
            'categories' => Category::all(),
            'currentCategory' => $category
        ]);
    }
}
