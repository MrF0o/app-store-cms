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

        return view('pages.category', compact('category', 'apps'), $this->sidebarData());
    }
}
