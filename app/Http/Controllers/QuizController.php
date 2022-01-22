<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quizze;
use App\Models\QuizType;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Quizze::with(['course', 'type'])
        ->select('quizzes.*')
        ->leftJoin('courses', 'courses.id', '=', 'quizzes.course_id')
        ->leftJoin('quiz_types', 'quiz_types.id', '=', 'quizzes.type_id')
        ->get();

        //dd($data);
        
        return view('quiz.quiz_list',[
            'isAdmin' => ($this->auth('role_id') === 1),
            'items' => $data ,
            'page_title' => 'Feladatok' ,
            'page_subtitle' => 'Lista' ,
            'page_links' => [
                (object)['label' => 'Létrehozás', 'link' => '/admin/quiz/create'] ,
                (object)['label' => 'Feladat típusok listája', 'link' => '/quiz-type'] ,
            ] ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd($request->request);  // dump and die

        $new = Quizze::create([
            'started_at' => $request->started_at,
            'submitted_at' => $request->submitted_at,
            'type_id' => $request->type_id,
            'course_id' => $request->course_id,
        ]);
                
        $new->save();

        return redirect()->to('/quiz');
    }

    public function create_form()
    {
        $types = QuizType::get();
        $courses = Course::get();

            return view('quiz.quiz_create',[

                'types' => $types,
                'courses' => $courses,
                'page_title' => 'Feladatok' ,
                'page_subtitle' => 'Létrehozás' ,
            ]);
            

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Quizze::where('id', $id) -> first();

        $types = QuizType::get();

        $courses = Course::get();
        
        
        return view('quiz.quiz_edit',[
            'id' => $data -> id,
            'started_at' => $data -> started_at,
            'submitted_at' => $data -> submitted_at,
            'type_id' => $data -> type_id,
            'course_id' => $data -> course_id,
            'types' => $types,
            'courses' => $courses,
            'page_title' => 'Feladatok' ,
            'page_subtitle' => 'Szerkesztés' ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $new = Quizze::where('id', $id) -> update([
            'started_at' => $request->started_at,
            'submitted_at' => $request->submitted_at,
            'type_id' => $request->type_id,
            'course_id' => $request->course_id,
        ]);

        return redirect()->to('/quiz');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
