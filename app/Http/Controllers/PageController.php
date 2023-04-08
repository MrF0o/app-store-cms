<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(string $slug, Page $page)
    {
        return view('pages.static', compact('page'), $this->commonData());
    }
}
