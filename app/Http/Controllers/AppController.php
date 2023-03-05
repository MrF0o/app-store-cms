<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppController extends Controller
{
    public function appDetails(String $slug, App $app)
    {

        return view('pages.app', compact('app'), $this->sidebarData());
    }

    public function gameDetails(String $slug, App $game)
    {
        $categories = Category::take(12)->get()->shuffle();
        $app = $game;

        $top_picks = DB::table('apps')
            ->join('top_picks', 'apps.id', '=', 'top_picks.app_id')
            ->limit(3)
            ->get();

        $top_picks->map(fn ($app) => $app->slug = Str::slug($app->name, '-'));

        return view('pages.app', compact('categories', 'app', 'top_picks'));
    }
}
