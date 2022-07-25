<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Tag;

class CreateController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $colors = Color::all();
        $tags = Tag::all();
        return view('product.create', compact('categories', 'colors', 'tags'));
    }
}
