<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $latest_games = App::where('is_app', false)->orderBy('id', 'DESC')->take(16)->get();
        $latest_apps = App::where('is_app', true)->orderBy('id', 'DESC')->take(16)->get();
        $categories = Category::take(12)->get()->shuffle();

        $latest_games->map(fn ($g) => $g->slug = Str::slug($g->name, '-'));
        $latest_apps->map(fn ($app) => $app->slug = Str::slug($app->name, '-'));

        $featured_apps = DB::select('SELECT * FROM apps, featured_apps WHERE apps.id = featured_apps.app_id');

        array_map(fn ($app) => $app->slug = Str::slug($app->name, '-'), $featured_apps);

        return view('pages.home', compact(
            'latest_games',
            'latest_apps',
            'categories',
            'featured_apps'
        ));
    }
}
