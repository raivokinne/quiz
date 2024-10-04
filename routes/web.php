<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/welcome', [PageController::class, 'index'])->middleware('auth')->name('welcome');
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/quiz/start', [QuizController::class, 'start'])->name('quiz.start');
    Route::get('/quiz/question', [QuizController::class, 'showQuestion'])->name('quiz.question');
    Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/result', [QuizController::class, 'result'])->name('quiz.result');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});


Route::get('/leaderboard', [PageController::class, 'leaderboard'])->name('leaderboard');
Route::get('/leaderboard/show', [PageController::class, 'show'])->name('leaderboard.show');

Route::group(['middleware' => AdminMiddleware::class], function () {
    Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
    Route::post('/quiz/create/store', [QuizController::class, 'store'])->name('quiz.store');
    Route::get('/quiz/edit/{quizId}', [QuizController::class, 'edit'])->name('quiz.edit');
    Route::post('/quiz/edit/{quizId}/update', [QuizController::class, 'update'])->name('quiz.update');
    Route::post('/quiz/{quizId}/delete', [QuizController::class, 'delete'])->name('quiz.delete');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
