<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Point;
use App\Models\Hystory;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{
    public function create()
    {
        return view('quiz.create');
    }

    public function start(Request $request)
    {
        $topicId = $request->get('quiz_topic');
        if (!$topicId) {
            return redirect()->back()->with('error', 'Quiz topic not specified.');
        }

        $questions = Question::where('category_id', $topicId)->pluck('id')->toArray();
        if (empty($questions)) {
            return redirect()->back()->with('error', 'No questions found for this topic.');
        }

        Session::put('quiz_questions', $questions);
        Session::put('current_question_index', 0);
        Session::put('quiz_score', 0);

        return redirect()->route('quiz.question');
    }

    public function showQuestion()
    {
        $questions = Session::get('quiz_questions');
        $currentIndex = Session::get('current_question_index');

        if (!isset($questions[$currentIndex])) {
            return redirect()->route('quiz.result');
        }

        $question = Question::findOrFail($questions[$currentIndex]);
        $answers = Answer::where('question_id', $question->id)->inRandomOrder()->get();

        return view('quiz.show', compact('question', 'answers'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'answer' => 'required|string'
        ]);

        $questions = Session::get('quiz_questions');
        $currentIndex = Session::get('current_question_index');
        $question = Question::findOrFail($questions[$currentIndex]);

        $selectedAnswer = $request->get('answer');
        $correctAnswer = Answer::where('question_id', $question->id)
            ->where('is_correct', true)
            ->first();

        if ($correctAnswer && $correctAnswer->answer == $selectedAnswer) {
            Session::increment('quiz_score');
        }

        Session::increment('current_question_index');

        if (Session::get('current_question_index') < count($questions)) {
            return redirect()->route('quiz.question');
        }

        if (auth()->check()) {
            $point = Point::create([
                'user_id' => auth()->user()->id,
                'points' => Session::get('quiz_score', 0)
            ]);

            Hystory::create([
                'user_id' => auth()->user()->id,
                'point_id' => $point->id,
                'category_id' => $question->category_id
            ]);
        }

        return redirect()->route('quiz.result');
    }

    public function result()
    {
        $score = Session::get('quiz_score', 0);
        $totalQuestions = count(Session::get('quiz_questions', []));

        Session::forget(['quiz_questions', 'current_question_index', 'quiz_score']);

        return view('quiz.result', compact('score', 'totalQuestions'));
    }
}
