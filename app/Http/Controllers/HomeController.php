<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latest_games = App::where('is_app', false)->take(8)->get();

        return view('pages.home', compact('latest_games'));
    }
}
