<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizTypeController;
use App\Http\Controllers\LessonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Quiz-Type
Route::get('/admin/quiz-type/create', [QuizTypeController::class, 'create_form']);
Route::post('/admin/quiz-type/create', [QuizTypeController::class, 'create']);
Route::get('/admin/quiz-type/edit/{id}', [QuizTypeController::class, 'edit']);
Route::post('/admin/quiz-type/edit/{id}', [QuizTypeController::class, 'update']);
Route::get('/admin/quiz-type', [QuizTypeController::class, 'index']);

// Quiz
Route::get('/admin/quiz/create', [QuizController::class, 'create_form']);
Route::post('/admin/quiz/create', [QuizController::class, 'create']);
Route::get('/admin/quiz/edit/{id}', [QuizController::class, 'edit']);
Route::post('/admin/quiz/edit/{id}', [QuizController::class, 'update']);
Route::get('/admin/quiz', [QuizController::class, 'index']);

// Course
Route::get('/admin/course/edit/{id}', [CourseController::class, 'edit']);
Route::post('/admin/course/edit/{id}', [CourseController::class, 'update']);
Route::get('/admin/course/create', [CourseController::class, 'create_form']);
Route::post('/admin/course/create', [CourseController::class, 'create']);

//Lesson
Route::get('/admin/lesson/edit/{id}', [LessonController::class, 'edit']);
Route::post('/admin/lesson/edit/{id}', [LessonController::class, 'update']);
Route::get('/admin/lesson/create', [LessonController::class, 'create_form']);
Route::post('/admin/lesson/create', [LessonController::class, 'create']);
Route::get('/admin/lesson', [LessonController::class, 'index']);