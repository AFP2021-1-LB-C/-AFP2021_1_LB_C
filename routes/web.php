<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizTypeController;

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

// Quiz
Route::get('/admin/quiz-type/create', [QuizTypeController::class, 'create_form']);
Route::post('/admin/quiz-type/create', [QuizTypeController::class, 'create']);

// Course
Route::get('/admin/course/create', [CourseController::class, 'create_form']);
Route::post('/admin/course/create', [CourseController::class, 'create']);
