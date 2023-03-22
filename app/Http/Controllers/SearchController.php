<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query_string = $request->input('s');
        if ($query_string) {
            $apps = App::where('name', 'like', "%$query_string%" )->simplePaginate()->withQueryString();
            $apps->setCollection($this->mapSlugArray($apps->items()));
            return view('pages.search', compact('query_string', 'apps'), $this->commonData());
        }
    }

    public function result(Request $request)
    {
        return redirect('search/?s=' . $request->search);
    }
}
