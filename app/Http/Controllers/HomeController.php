<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latest_games = App::where('is_app', false)->orderBy('id', 'DESC')->take(16)->get();
        $latest_apps = App::where('is_app', true)->orderBy('id', 'DESC')->take(16)->get();

        return view('pages.home', compact('latest_games', 'latest_apps'));
    }
}
