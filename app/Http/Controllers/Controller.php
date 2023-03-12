<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sidebarData()
    {
        $categories = Category::take(12)->get()->shuffle();

        $top_picks = DB::table('apps')
            ->join('top_picks', 'apps.id', '=', 'top_picks.app_id')
            ->limit(3)
            ->get();

        $top_picks->map(fn ($app) => $app->slug = Str::slug($app->name, '-'));
        $categories->map(fn ($c) => $c->slug = Str::slug($c->name, '-'));

        return [
            'categories' => $categories,
            'top_picks' => $top_picks
        ];
    }
}
