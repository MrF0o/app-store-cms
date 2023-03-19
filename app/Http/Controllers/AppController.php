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
        $app->visits_count++;
        $app->save();

        return view('pages.app', compact('app'), $this->sidebarData());
    }

    public function gameDetails(String $slug, App $game)
    {
        $app = $game;

        $app->visits_count++;
        $app->save();


        return view('pages.app', compact('app'), $this->sidebarData());
    }

    public function allApps() {
        $apps = App::where('is_app', true)->simplePaginate(28);
        $apps->setCollection($this->mapSlugArray($apps->items()));
        $title = 'All Apps';

        return view('pages.generic-all', compact('title', 'apps'), $this->sidebarData());
    }

    public function allGames() {
        $apps = App::where('is_app', false)->simplePaginate(28);
        $apps->setCollection($this->mapSlugArray($apps->items()));
        $title = 'All Games';

        return view('pages.generic-all', compact('title', 'apps'), $this->sidebarData());
    }
}
