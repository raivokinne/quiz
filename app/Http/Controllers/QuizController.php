<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;
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
        Session::put('question_results', []);
        return redirect()->route('quiz.question');
    }

    public function showQuestion()
    {
        $questions = Session::get('quiz_questions');
        $currentIndex = Session::get('current_question_index');
        if (!isset($questions[$currentIndex])) {
            return redirect()->route('quiz.result');
        }
        $totalQuestions = count($questions);
        $score = Session::get('quiz_score', 0);
        $question = Question::findOrFail($questions[$currentIndex]);
        $answers = Answer::where('question_id', $question->id)->inRandomOrder()->get();
        $correctAnswer = Answer::where('question_id', $question->id)
            ->where('is_correct', true)
            ->first();
        $questionResults = Session::get('question_results', []);
        return view('quiz.show', compact('correctAnswer', 'question', 'score', 'answers', 'totalQuestions', 'questionResults', 'currentIndex'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'answer' => 'required|string'
        ]);

        $questions = Session::get('quiz_questions');
        $currentIndex = Session::get('current_question_index');
        $question = Question::findOrFail($questions[$currentIndex]);
        $selectedAnswer = Answer::findOrFail($request->get('answer'));
        $correctAnswer = Answer::where('question_id', $question->id)
            ->where('is_correct', true)
            ->first();

        $isCorrect = $correctAnswer->id == $selectedAnswer->id;

        $questionResults = Session::get('question_results', []);
        $questionResults[] = [
            'question' => $question->question,
            'selected_answer' => $selectedAnswer->answer,
            'correct_answer' => $correctAnswer->answer,
            'is_correct' => $isCorrect
        ];
        Session::put('question_results', $questionResults);

        if ($isCorrect) {
            Session::increment('quiz_score');
        }

        Session::increment('current_question_index');

        if (Session::get('current_question_index') < count($questions)) {
            return redirect()->route('quiz.question');
        }

        $quizResult = Result::create([
            'user_id' => auth()->id(),
            'score' => Session::get('quiz_score', 0),
            'total_questions' => count($questions),
            'results' => $questionResults
        ]);

        return redirect()->route('quiz.result', ['id' => $quizResult->id]);
    }

    public function result($id)
    {
        $quizResult = Result::findOrFail($id);

        $score = $quizResult->score;
        $totalQuestions = $quizResult->total_questions;
        $questionResults = $quizResult->results;

        return view('quiz.result', compact('score', 'totalQuestions', 'questionResults'));
    }
}
