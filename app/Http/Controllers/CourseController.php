<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quizze;
use App\Models\Schedule;
use App\Models\Quiz_result;
use App\Models\Courses_user;
use Illuminate\Http\Request;
use App\Models\Quiz_question;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = Course::all();
        $data = Course::with(['teacher'])
        ->select('courses.*')
        ->leftJoin('users', 'users.id', '=', 'courses.teacher_id')
        ->get();
        $subscriptions = Courses_user::all();
        
        $page_links = [];

        if ($this->auth('role_id') === 1 || $this->auth('role_id') === 2){
            $page_links = array_merge($page_links, [
              (object)['label' => 'Létrehozás', 'link' => '/admin/course/create'],
              (object)['label' => 'Törölt kurzusok megtekintése', 'link' => '/admin/course/deleted'],
            ]);
        }elseif($this->auth('role_id') == null) {
            return redirect()->to('/');
        }

        return view('course.course_list',[            
            'isAdmin' => ($this->auth('role_id') === 1),
            'isTeacher' => ($this->auth('role_id') === 2),
            'isStudent' => ($this->auth('role_id') === 3),
            'items' => $data ,
            'subs' => $subscriptions ,
            'page_title' => 'Kurzusok' ,
            'page_subtitle' => 'Lista' ,
            'page_links' => $page_links,
        ]);
    }

    public function deleted()
    {
        //$data = Course::all();
        $data = Course::with(['teacher'])
        ->select('courses.*')
        ->leftJoin('users', 'users.id', '=', 'courses.teacher_id')
        ->get();
        $subscriptions = Courses_user::all();
        
        $page_links = [];

        if ($this->auth('role_id') === 3)
        return redirect()->to('/');

        return view('course.deleted_list',[            
            'isAdmin' => ($this->auth('role_id') === 1),
            'isTeacher' => ($this->auth('role_id') === 2),
            'isStudent' => ($this->auth('role_id') === 3),
            'items' => $data ,
            'subs' => $subscriptions ,
            'page_title' => 'Kurzusok' ,
            'page_subtitle' => 'Törölt elemek listája' ,
            'page_links' => $page_links,
        ]);
    }

    public function lesson($id = null){

    $page_links = [];
    if ($this->auth('role_id') === 1 || $this->auth('role_id') === 2){
        $page_links = array_merge($page_links, [
        (object)['label' => 'Létrehozás', 'link' => '/admin/lesson/create'],
    ]);
    }elseif($this->auth('role_id') == null) {
        return redirect()->to('/');
    }    

    $course_name = Course::where('id', $id)
    ->select('courses.*')
    ->value('name');

    $status = Course::where('id', $id)
    ->select('courses.*')
    ->value('status');

    if ($id == null){
        $data = Lesson::with(['course'])
        ->select('lessons.*')
        ->get();
    }else{
        $data = Lesson::where('course_id', $id)
        ->select('lessons.*')
        ->get();    
    }
    
    $exists = Course::where('id', $id)
    -> first();
    

    $subscribed = 
    Courses_user::where('user_id', ($this->auth('id')))
    ->get()
    ->where('course_id', $id)
    ->count() > 0;

    $accepted = 
    Courses_user::where('user_id', ($this->auth('id')))
    ->where('course_id', $id)
    ->select('courses_users.*')
    ->value('status');

    return view('course.lesson_list',[
        'accepted' => $accepted,
        'subscribed' => $subscribed,
        'public' => $status,
        'isAdmin' => ($this->auth('role_id') === 1),
        'isTeacher' => ($this->auth('role_id') === 2),
        'isStudent' => ($this->auth('role_id') === 3),
        'course_name' => $course_name,
        'exists' => $exists,
        'items' => $data ,
        'page_title' => 'Tananyagok' ,
        'page_subtitle' => 'Lista' ,
    ]);
}

    public function subscribe($id)
    {
        $date_of_application = Carbon::now();
        $userid = ($this->auth('id'));

        $new = Courses_user::create([
            'course_id' => $id,
            'user_id' => $userid,
            'date_of_application' => $date_of_application,
            'status' => 0,
        ]);
                
        $new->save();

        return redirect()->to('/course');
    }

    public function unsubscribe($id)
    {
        $userid = ($this->auth('id'));

        $rejected = Courses_user::where('id', $id)
        ->where('user_id', $this->auth('id'))
        ->select('courses_users.*')
        ->value('status') == -1;

        if (!$rejected){
        Courses_user::where('id', $id)->delete();
        }
                
        return redirect()->to('/course');
    }

    public function accept($id)
    {
        $course_id = Courses_user::where('id', $id)->select('courses_users.*')->value('course_id');

        $teacher_id = Course::where('id', $course_id)->select('courses.*')->value('teacher_id');

        if (($this->auth('role_id') === 1) 
        || ($teacher_id == $this->auth('id')))
        {
        $new = Courses_user::where('id', $id)->update([
            'status' => 1,
        ]);
        }

        return redirect()->to('/admin/course/students/'.$course_id);
    }

    public function reject($id)
    {
        $course_id = Courses_user::where('id', $id)->select('courses_users.*')->value('course_id');

        $teacher_id = Course::where('id', $course_id)->select('courses.*')->value('teacher_id');

        if (($this->auth('role_id') === 1) 
        || ($teacher_id == $this->auth('id')))
        {
        $new = Courses_user::where('id', $id)->update([
            'status' => -1,
        ]);
    }

        return redirect()->to('/admin/course/students/'.$course_id);
    }

    public function remove($id)
    {
        $course_id = Courses_user::where('id', $id)->select('courses_users.*')->value('course_id');

        $teacher_id = Course::where('id', $course_id)->select('courses.*')->value('teacher_id');

        if (($this->auth('role_id') === 1) 
        || ($teacher_id == $this->auth('id')))
        {
        $new = Courses_user::where('id', $id)->delete();
        }

        return redirect()->to('/admin/course/students/'.$course_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd($request->request);  // dump and die

        if ($this->auth('role_id') !== 1 && $this->auth('role_id') !== 2) {
            return redirect()->to('/');
        }

        $request->validate([
            'name'          =>      'required',
            'description'   =>      'required',
        ]);
  
        $new = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'teacher_id' => $this->auth('id')
        ]);
        
        if (!is_null($new)) {
        $new->save();

        return redirect()->to('/course');
        } else {
            return back()->with('error', 'Hoppá, hiba történt. Próbáld újra.');
        }
    }

    public function create_form()
    {
        if ($this->auth('role_id') !== 1 && $this->auth('role_id') !== 2) {
            return redirect()->to('/');
        }

            return view('course.course_create', [
                'page_title' => 'Kurzusok' ,
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
        if ($this->auth('role_id') !== 1 && $this->auth('role_id') !== 2) {
            return redirect()->to('/');
        }

        $data = Course::where('id', $id) -> first();
        $teacher_id = 0;
        $isExists = (Course::where('id', $id) -> first()) != NULL;
        if ($isExists)
        {
            return view('course.course_edit',[
                'isExists' => true,
                'isAdmin' => ($this->auth('role_id') === 1),
                'isTeacher' => ($this->auth('role_id') === 2),
                'isStudent' => ($this->auth('role_id') === 3),
                'teacher_id' => $data -> teacher_id,
                'name' => $data -> name,
                'description' => $data -> description,
                'longDescription' => $data -> longDescription,
                'status' => $data -> status,
                'id' => $data -> id,
                'page_title' => 'Kurzusok' ,
                'page_subtitle' => 'Szerkesztés' ,
            ]);    
        }
        else
        {
            return view('course.course_edit',[
                'isExists' => false,
            ]);
        }
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

        if ($this->auth('role_id') !== 1 && $this->auth('role_id') !== 2) {
            return redirect()->to('/');
        }

        $request->validate([
            'name'          =>      'required',
            'description'   =>      'required',
            'status'        =>      'required',
        ]);
        
        $new = Course::where('id', $id) -> update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        if (!is_null($new)) {
        return redirect()->to('/course');
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
        if ($this->auth('role_id') == 1 || $this->auth('role_id') == 2) {

            // Vizsgaidőpontok törlése
            Schedule::where('course_id', $id)->update([
                'deleted_at' => Carbon::now()
            ]);

            // Feliratkozás törlése
            Courses_user::where('course_id', $id)->update([
                'deleted_at' => Carbon::now()
            ]);

            // Feladathoz tartozó kérdések törlése
            $quizzes = Quizze::where('course_id', $id)->get();
            foreach ($quizzes as $quizze) {
                $quiz_questions = Quiz_question::where('quiz_id', $quizze->id)->get();
                foreach ($quiz_questions as $quiz_question) {
                    Quiz_result::where('quiz_question_id', $quiz_question->id)->update([
                        'deleted_at' => Carbon::now()
                    ]);
                }
                Quiz_question::where('quiz_id', $quizze->id)->update([
                    'deleted_at' => Carbon::now()
                ]);
            }

            // Feladatok törlése
            Quizze::where('course_id', $id)->update([
                'deleted_at' => Carbon::now()
            ]);

            // Tananyagok törlése
            Lesson::where('course_id', $id)->update([
                'deleted_at' => Carbon::now()
            ]);

            // Kurzus törlése
            Course::where('id', $id)->update([
                'deleted_at' => Carbon::now()
            ]);
        }
        return redirect()->to('/course');
    }

    public function undo_delete($id)
    {
        if ($this->auth('role_id') == 1 || $this->auth('role_id') == 2) {

            // Vizsgaidőpontok helyreállítása
            Schedule::where('course_id', $id)->update([
                'deleted_at' => NULL
            ]);

            // Feliratkozás helyreállítása
            Courses_user::where('course_id', $id)->update([
                'deleted_at' => NULL
            ]);

            // Feladathoz tartozó kérdések helyreállítása
            $quizzes = Quizze::where('course_id', $id)->get();
            foreach ($quizzes as $quizze) {
                $quiz_questions = Quiz_question::where('quiz_id', $quizze->id)->get();
                foreach ($quiz_questions as $quiz_question) {
                    Quiz_result::where('quiz_question_id', $quiz_question->id)->update([
                        'deleted_at' => NULL
                    ]);
                }
                Quiz_question::where('quiz_id', $quizze->id)->update([
                    'deleted_at' => NULL
                ]);
            }

            // Feladatok helyreállítása
            Quizze::where('course_id', $id)->update([
                'deleted_at' => NULL
            ]);

            // Tananyagok helyreállítása
            Lesson::where('course_id', $id)->update([
                'deleted_at' => NULL
            ]);

            // Kurzus helyreállítása
            Course::where('id', $id)->update([
                'deleted_at' => NULL
            ]);
        }
        return redirect()->to('/course');
    }

    public function students($id)
    {
        if ($this->auth('role_id') == 1 || $this->auth('role_id') == 2) 
        {
        $data = Courses_user::with(['course', 'user'])
        ->select('courses_users.*')
        ->leftJoin('courses', 'courses.id', '=', 'courses_users.course_id')
        ->leftJoin('users', 'users.id', '=', 'courses_users.user_id')
        ->get();

        $course_name = Course::where('id', $id)
        ->select('courses.*')
        ->value('name');

        $exists = Course::where('id', $id)
        -> first();

        $teacher_id = Course::where('id', $id)
        ->select('courses.*')
        ->value('teacher_id');

        return view('course.student_list',[
            'teacher_id' => $teacher_id,
            'exists' => $exists,
            'course_name' => $course_name,
            'id' => $id,            
            'isAdmin' => ($this->auth('role_id') === 1),
            'isTeacher' => ($this->auth('role_id') === 2),
            'isStudent' => ($this->auth('role_id') === 3),
            'items' => $data ,
            'page_title' => 'Kurzusok' ,
            'page_subtitle' => 'Jelentkezett Hallgatók' ,
        ]);
        }
        else
        {
            return redirect()->to('/course');
        }
    }

}

