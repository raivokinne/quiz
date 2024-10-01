<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{
    public function create()
    {
        return view('quiz.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_title' => 'required|string|max:255',
            'question' => 'required|array',
            'question.*' => 'required|string',
            'option_*' => 'required|array',
            'answer_*' => 'required'
        ]);


        $quiz = Category::create([
            'name' => $request->quiz_title
        ]);


        for ($i = 0; $i < count($request->question); $i++) {
            $question = Question::create([
                'category_id' => $quiz->id,
                'question' => $request->question[$i]
            ]);


            foreach ($request->input("option_{$i}") as $index => $option) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $option,
                    'is_correct' => ($request->input("answer_{$i}") == $index)
                ]);
            }
        }


        return redirect('/quiz/create')->with('success', 'Quiz created successfully!');
    }

    public function chooseQuiz(Request $request)
    {
        return redirect('/quiz/edit/' . $request->quiz_topic);
    }

    public function edit($quizID)
    {
        $category = Category::find($quizID);
        if (!$category) {
            return redirect('/quiz/index')->with('error', 'Quiz not found.');
        }

        $questions = Question::where('category_id', $quizID)->get();
        $data = [
            'category' => $category->name,
            'questions' => []
        ];

        foreach ($questions as $question) {
            $answers = Answer::where('question_id', $question->id)->get();
            $data['questions'][] = [
                'question_id' => $question->id,
                'question' => $question->question,
                'answers' => $answers->pluck('answer')->toArray(),
                'is_correct' => $answers->pluck('is_correct')->toArray()
            ];
        }

        return view('quiz/edit', ['quiz' => $data, 'quizID' => $quizID]);
    }

    public function update(Request $request, $quizID)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.answers' => 'required|array|min:4', // Ensure at least 4 answers
            'questions.*.correct_answer' => 'required|integer' // Validate correct answer index
        ]);

        $category = Category::find($quizID);
        if (!$category) {
            return redirect('/quiz/index')->with('error', 'Quiz not found.');
        }
        $category->name = $request->category;
        $category->save();

        foreach ($request->questions as $index => $questionData) {
            $question = Question::find($questionData['question_id']);
            if ($question && $question->category_id == $quizID) {
                $question->question = $questionData['question'];
                $question->save();

                foreach ($questionData['answers'] as $answerIndex => $answerText) {
                    $answer = Answer::where('question_id', $question->id)->skip($answerIndex)->first();
                    if ($answer) {
                        $answer->answer = $answerText;
                        $answer->is_correct = ($answerIndex == $questionData['correct_answer']);
                        $answer->save();
                    }
                }
            }
        }

        return redirect('/quiz/edit/' . $quizID)->with('success', 'Quiz updated successfully!');
    }

    public function delete($quizID)
    {
        $category = Category::find($quizID);
        if (!$category) {
            return redirect('/quiz/index')->with('error', 'Quiz not found.');
        }
        $category->delete();
        return redirect('/quiz/index')->with('success', 'Quiz deleted successfully!');
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
