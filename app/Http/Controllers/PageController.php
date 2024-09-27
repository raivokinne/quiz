<?php

namespace App\Http\Controllers;

use App\Models\Category;

class PageController extends Controller
{
    public function index()
    {
        $topics = Category::all();

        return view('welcome', ['topics' => $topics]);
    }
}
