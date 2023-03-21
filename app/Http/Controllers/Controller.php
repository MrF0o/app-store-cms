<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\Paginator;
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

    public function footerData()
    {
        $pages = Page::take(5)->get();
        $pages->map(fn ($page) => $page->slug = Str::slug($page->title, '-'));
        return [
            'pages' => $pages
        ];
    }

    public function commonData()
    {
        return array_merge($this->footerData(), $this->sidebarData());
    }

    public function mapSlug($model)
    {
        $model->slug = Str::slug($model->name, '-');

        return $model;
    }

    public function mapSlugCollection(Collection $coll)
    {
        return $coll->map(fn ($g) => $g->slug = Str::slug($g->name, '-'));
    }

    public function mapSlugArray(array $arr)
    {
        // dd($arr);
        $coll = collect($arr);

        foreach ($coll as $item) {
            $item->slug = Str::slug($item->name, '-');
        }

        return $coll;
    }
}
