<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Courses_user;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Course::all();
        $subscriptions = Courses_user::all();
        
        $page_links = [];

        if ($this->auth('role_id') === 1 || $this->auth('role_id') === 2){
            $page_links = array_merge($page_links, [
              (object)['label' => 'Létrehozás', 'link' => '/admin/course/create'],
            ]);
        }elseif($this->auth('role_id') == null) {
            return redirect()->to('/');
        }

        return view('course.course_list',[
            'isAdmin' => ($this->auth('role_id') === 1),
            'isTeacher' => ($this->auth('role_id') === 2),
            'items' => $data ,
            'subs' => $subscriptions ,
            'page_title' => 'Kurzusok' ,
            'page_subtitle' => 'Lista' ,
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

    return view('course.lesson_list',[
        'isAdmin' => ($this->auth('role_id') === 1),
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
            'status' => true,
        ]);
                
        $new->save();

        return redirect()->to('/course');
    }

    public function unsubscribe($id)
    {
        $userid = ($this->auth('id'));

        Courses_user::where('id', $id)->delete();
                
        return redirect()->to('/course');
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
        
        return view('course.course_edit',[
            'name' => $data -> name,
            'description' => $data -> description,
            'id' => $data -> id,
            'page_title' => 'Kurzusok' ,
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

        if ($this->auth('role_id') !== 1 && $this->auth('role_id') !== 2) {
            return redirect()->to('/');
        }

        $request->validate([
            'name'          =>      'required',
            'description'   =>      'required',
        ]);
        
        $new = Course::where('id', $id) -> update([
            'name' => $request->name,
            'description' => $request->description,
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
        //
    }
}
