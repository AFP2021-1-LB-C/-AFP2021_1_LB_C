<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizTypeController;
use App\Http\Controllers\ScheduleController;

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
Route::get('/quiz', [QuizController::class, 'index']);
Route::get('/quiz/result/{id}', [QuizController::class, 'show_result']);
Route::get('/quiz/completion/{id}', [QuizController::class, 'completion']);
Route::post('/quiz/rating/{id}', [QuizController::class, 'save_answers']);
Route::get('/admin/quiz/delete/{id}', [QuizController::class, 'destroy']);

// Course
Route::get('/admin/course/edit/{id}', [CourseController::class, 'edit']);
Route::post('/admin/course/edit/{id}', [CourseController::class, 'update']);
Route::get('/admin/course/create', [CourseController::class, 'create_form']);
Route::post('/admin/course/create', [CourseController::class, 'create']);
Route::get('/course', [CourseController::class, 'index']);
Route::get('/course/{id}', [CourseController::class, 'lesson']);

//Lesson
Route::get('/admin/lesson/edit/{id}', [LessonController::class, 'edit']);
Route::post('/admin/lesson/edit/{id}', [LessonController::class, 'update']);
Route::get('/admin/lesson/create', [LessonController::class, 'create_form']);
Route::post('/admin/lesson/create', [LessonController::class, 'create']);
Route::get('/lesson/content/{id}', [LessonController::class, 'show']);
Route::get('/lesson', [LessonController::class, 'index']);
Route::get('/admin/lesson/delete/{id}', [LessonController::class, 'destroy']);

//Role
Route::get('/admin/role/create', [RoleController::class, 'create_form']);
Route::post('/admin/role/create', [RoleController::class, 'create']);
Route::get('/admin/role/edit/{id}', [RoleController::class, 'edit']);
Route::post('/admin/role/edit/{id}', [RoleController::class, 'update']);
Route::get('/admin/role', [RoleController::class, 'index']);

//User
Route::get('/admin/user/create', [UserController::class, 'create_form']);
Route::post('/admin/user/create', [UserController::class, 'create']);
Route::get('/admin/user/edit/{id}', [UserController::class, 'edit']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::post('/user/edit/{id}', [UserController::class, 'update']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/profile/{id}', [UserController::class, 'profile']);

//Registration
Route::get('/registration', [UserController::class, 'r_index']);
Route::post('/user-store', [UserController::class, 'userPostRegistration']);
//Route::get('/registration', [UserController::class, 'userPostRegistration']);
//Route::post('/registration', [UserController::class, 'registration']);

// Login
Route::get('/login', [UserController::class, 'userLoginIndex']);
Route::post('/user-login', [UserController::class, 'userPostLogin']);
Route::get('/logout', [UserController::class, 'logout']);

//Schedule
Route::get('/admin/schedule/create', [ScheduleController::class, 'create_form']);
Route::post('/admin/schedule/create', [ScheduleController::class, 'create']);
Route::get('/admin/schedule/edit/{id}', [ScheduleController::class, 'edit']);
Route::post('/admin/schedule/edit/{id}', [ScheduleController::class, 'update']);
Route::get('/schedule', [ScheduleController::class, 'index']);

// Homepage
Route::get('/', function() {
    return view('home.homepage',[
        'page_title' => 'Kezdőlap',
    ]);
});

// Subscribe/Unsubscribe
Route::get('/course/subscribe/{id}', [CourseController::class, 'subscribe']);
Route::get('/course/unsubscribe/{id}', [CourseController::class, 'unsubscribe']);
