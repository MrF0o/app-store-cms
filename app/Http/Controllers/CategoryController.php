<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(String $slug, Category $category)
    {

        return view('pages.category', compact('category'), $this->sidebarData());
    }
}
