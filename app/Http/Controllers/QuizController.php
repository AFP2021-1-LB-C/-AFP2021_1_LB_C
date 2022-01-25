<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Quizze;
use App\Models\QuizType;
use App\Models\Quiz_result;
use Illuminate\Http\Request;
use App\Models\Quiz_question;
use ErrorException;
use Exception;

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

        $page_links = [];
        
        if ($this->auth('role_id') == 1){
            $page_links = array_merge($page_links, [
                (object)['label' => 'Létrehozás', 'link' => '/admin/quiz/create'] ,
                (object)['label' => 'Feladat típusok listája', 'link' => 'admin/quiz-type'] ,
            ] ,
            );
        }elseif($this->auth('role_id') == null) {
            return redirect()->to('/');
        }

        return view('quiz.quiz_list',[
            'isAdmin' => ($this->auth('role_id') === 1),
            'items' => $data ,
            'page_title' => 'Feladatok' ,
            'page_subtitle' => 'Lista' ,
            'page_links' => $page_links,
        ]);
    }

    public function completion($id){
        $quiz = Quizze::where('id', $id)
        -> update(['started_at' => Carbon::now()]);
        

        $data = Quiz_question::where('quiz_id', $id)
        -> select('quiz_questions.*')
        -> get();

        //dd($data);

        return view('quiz.quiz_completion',[
            'id' => $id,
            'isAdmin' => ($this->auth('role_id') === 1),
            'user' => ($this->auth('id')),
            'started_at' => Quizze::where('id', $id) -> select('quizzes.*')
            -> value('started_at'),
            'items' => $data ,
            'page_title' => 'Feladatok' ,
            'page_subtitle' => 'Lista' ,
        ]);
    }   

    public function save_answers($id){

        $data = array();

        $quiz = Quizze::where('id', $id)
        -> update(['submitted_at' => Carbon::now()]);

        $questions = Quiz_question::where('quiz_id', $id)
        -> select('quiz_questions.*')
        -> get();

        foreach ($questions as $question) {
            Quiz_result::where('quiz_question_id', $question -> id)
            ->delete();
         
            //üresen hagyott válaszok esetén catch fut le
            try{$answer = $_POST[$question -> id];}
            catch (ErrorException $e){$answer = 0;}

            $new = Quiz_result::create([
                'quiz_question_id' => $question -> id,
                'answer' => $answer,
                'user_id' => $this->auth('id'),
            ]);
            
            $data = Quiz_result::where('id', $id) 
            -> select('quiz_results.*')
            -> get();
        }   
    
        return view('quiz.quiz_answers',[
            'quiz_id' => $id,
            'isAdmin' => ($this->auth('role_id') === 1),
            'user_id' => ($this->auth('id')),
            'started_at' => Quizze::where('id', $id) -> select('quizzes.*')
            -> value('started_at'),
            'submitted_at' => Quizze::where('id', $id) -> select('quizzes.*')
            -> value('submitted_at'),
            'items' => $data ,
            'page_title' => 'Válaszok' ,
            'page_subtitle' => 'Lista' ,
        ]);
    } 

    public function show_result($id){

        $quiz_results = null;
        if ($this->auth('role_id') === 1 || $this->auth('role_id') === 2){
            $quiz_results = Quiz_result::join('quiz_questions', 'quiz_results.quiz_question_id', '=', 'quiz_questions.id')
                                    -> get();
        } else if($this->auth('role_id') === 3){
            $quiz_results = Quiz_result::where('user_id', $this->auth('id'))
            -> join('quiz_questions', 'quiz_results.quiz_question_id', '=', 'quiz_questions.id')
            -> get();
        }

        return view('quiz.quiz_result',[
            'id' => $id,
            'isAdmin' => ($this->auth('role_id') === 1),
            'isStudent' => ($this->auth('role_id') === 2),
            'user_id' => ($this->auth('id')),
            'items' => $quiz_results ,
            'page_title' => 'Eredmeny' ,
            'page_subtitle' => 'Lista' ,
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
        if ($this->auth('role_id') !== 1) {
            return redirect()->to('/');
        }

        $request->validate([
            'started_at'          =>      'required',
            'submitted_at'        =>      'required',
        ]);

        $new = Quizze::create([
            'started_at' => $request->started_at,
            'submitted_at' => $request->submitted_at,
            'type_id' => $request->type_id,
            'course_id' => $request->course_id,
        ]);
        if (!is_null($new)) {        
        $new->save();

        return redirect()->to('/quiz');
        } else {
            return back()->with('error', 'Hoppá, hiba történt. Próbáld újra.');
        }
    }

    public function create_form()
    {
        if ($this->auth('role_id') !== 1) {
            return redirect()->to('/');
        }

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
        if ($this->auth('role_id') !== 1) {
            return redirect()->to('/');
        }

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
        if ($this->auth('role_id') !== 1) {
            return redirect()->to('/');
        }

        $request->validate([
            'started_at'          =>      'required',
            'submitted_at'        =>      'required',
        ]);

        $new = Quizze::where('id', $id) -> update([
            'started_at' => $request->started_at,
            'submitted_at' => $request->submitted_at,
            'type_id' => $request->type_id,
            'course_id' => $request->course_id,
        ]);
        if (!is_null($new)) {
        return redirect()->to('/quiz');
        } else {
            return back()->with('error', 'Hoppá, hiba történt. Próbáld újra.');
        }
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
