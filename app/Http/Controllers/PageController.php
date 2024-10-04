<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Hystory;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $topics = Category::all();

        return view('welcome', ['topics' => $topics]);
    }

    public function leaderboard(){
        $topics = Category::all();
        return view('leaderboard.leaderboard', ['topics' => $topics]);
    }

    public function show(Request $request){


        $topicId = $request->input('topic'); // Retrieving the topic from the query parameter

        if (!$topicId) {
            return redirect()->back()->with('error', 'Please select a valid topic.');
        }

        // Load the history records for the selected topic (category)
        $history = Hystory::with(['category', 'point'])->where('category_id', $topicId)->get();

        // Get the selected category to display its name
        $category = Category::find($topicId);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        // Pass the history and category to the view
        return view('leaderboard.show', compact('history', 'category'));
    }
}
