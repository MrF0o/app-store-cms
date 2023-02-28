<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppController extends Controller
{
    public function appDetails(String $slug, App $app)
    {
        $categories = Category::take(12)->get()->shuffle();

        return view('pages.app', compact('categories', 'app'));
    }

    public function gameDetails(String $slug, App $game)
    {
        $categories = Category::take(12)->get()->shuffle();
        $app = $game;

        return view('pages.app', compact('categories', 'app'));
    }
}
