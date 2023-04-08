<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(String $slug, Category $category)
    {
        $apps = $category->apps()->simplePaginate(28);
        $apps->setCollection($this->mapSlugArray($apps->items()));

        return view('pages.category', compact('category', 'apps'), $this->commonData());
    }

    public function all()
    {
        $cats = Category::simplePaginate(10);
        $cats->map(fn ($c) => $c->slug = Str::slug($c->name, '-'));
        return view('pages.categories', compact('cats') , $this->commonData());
    }
}
