<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function create()
    {
        return view('quiz/create');
    }


    public function store(Request $request)
    {

        dd($request);
    }
}
