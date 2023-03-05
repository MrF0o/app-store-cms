<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(String $slug, Category $category) {
        $categories = Category::take(12)->get()->shuffle();

        $top_picks = DB::table('apps')
            ->join('top_picks', 'apps.id', '=', 'top_picks.app_id')
            ->limit(3)
            ->get();

        $top_picks->map(fn ($app) => $app->slug = Str::slug($app->name, '-'));

        $apps = $category->apps;

        return view('pages.category', compact('categories', 'top_picks', 'apps'));
    }
}
