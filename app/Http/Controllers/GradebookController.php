<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use ErrorException;
use App\Models\Grade;
use App\Models\Quizze;
use Illuminate\Http\Request;
use App\Models\Quiz_result;
use Illuminate\Support\Facades\DB;

class GradebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = Grade::with(['course', 'type','user','quiz_result'])
            ->select(['grades.grade AS grade', 'users.name AS user_name', DB::raw("CONCAT(quizzes.id,' ',quiz_types.name) AS quiz_name")])
            ->join('users', 'users.id', '=', 'grades.user_id')
            ->join('quizzes', 'quizzes.id', '=', 'grades.quiz_id')
            ->join('quiz_types', 'quizzes.type_id', '=', 'quiz_types.id')
            ->where('quizzes.course_id', $id);
            

        $quizzes = Quizze::with(['type'])
            ->join('quiz_types', 'quizzes.type_id', '=', 'quiz_types.id')
            ->select(["quizzes.id",DB::raw("CONCAT(quizzes.id,' ',quiz_types.name) AS quiz_name")])
            ->get() -> pluck("quiz_name");

        $students = Grade::with(['user'])
        ->select(['users.name AS user_name'])
        ->join('users', 'users.id', '=', 'grades.user_id')
        ->get() -> pluck('user_name');

        $grades = collect([]);

        if ($this->auth('role_id') == 3) {
            $data = $data
            ->where('grades.user_id', $this->auth('id'));
        }

        $data = $data-> get();
        //$data  = collect($data)->sortDesc()->unique();

        foreach ($students as $student) {
            if (!($grades->contains($student))){
                $grades -> put($student, collect([]));
            }
            
            foreach ($quizzes as $quiz) {
               $grades -> get($student)-> put($quiz, "");
            }
        }
        
        foreach ($data as $item){
            $grade_data = $item -> attributesToArray();
            if(($grades -> get($grade_data["user_name"]) -> get($grade_data["quiz_name"]) == "") || 
                $grades -> get($grade_data["user_name"]) -> get($grade_data["quiz_name"]) < $grade_data["grade"]){
                $grades -> get($grade_data["user_name"]) -> put($grade_data["quiz_name"], (int)$grade_data["grade"]);
            }
        } 

        foreach ($grades as $name => $quiz_results){
            $sum = 0;
            $count = 0;
           
            foreach ($quiz_results as $grade) { 
                
                if (is_int($grade)){
                    $count++;
                    $sum = $sum + $grade; 
                }
            }
            if($count > 0){
                $avg = round($sum/$count, 2);
                $grades -> get($name) -> put("Átlag", $avg);
            } else{
                $grades -> get($name) -> put("Átlag", "");
            }
        }

        $quizzes -> push("Átlag");

        return view('gradebook.gradebook',[
            'isAdmin' => ($this->auth('role_id') === 1),
            'isTeacher' => ($this->auth('role_id') === 2),
            'isStudent' => ($this->auth('role_id') === 3),
            'items' => $data ,
            'grades' => $grades ,
            'page_title' => 'Napló' ,
            'page_subtitle' => 'jegyek' ,
            'course_id' => $id,
            'quizzes' => $quizzes,
        ]);
    }

}
