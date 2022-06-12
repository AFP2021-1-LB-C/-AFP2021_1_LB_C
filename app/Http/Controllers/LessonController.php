<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id, $lesson_id)
    {
        $data = Lesson::with(['course'])
        ->select('lessons.*')
        ->where('course_id', $course_id)
        ->get();

        $page_links = [];

        if ($this->auth('role_id') === 1 || $this->auth('role_id') === 2){
            $page_links = array_merge($page_links, [
              (object)['label' => 'Létrehozás', 'link' => '/admin/lesson/create'],
              (object)['label' => 'Törölt tananyagok listája', 'link' => '/admin/lesson/deleted'],
            ]);
        }elseif($this->auth('role_id') == null) {
            return redirect()->to('/');
        }

        return view('lesson.lesson_list',[
            'isAdmin' => ($this->auth('role_id') === 1),
            'isTeacher' => ($this->auth('role_id') === 2),
            'isStudent' => ($this->auth('role_id') === 3),
            'items' => $data ,
            'page_title' => 'Tananyagok' ,
            'page_subtitle' => 'Lista' ,
            'page_links' => $page_links,
        ]);
    }

    public function deleted()
    {
        $data = Lesson::with(['course'])
        ->select('lessons.*')
        ->get();
        
        $page_links = [];

        if ($this->auth('role_id') === 3)
        return redirect()->to('/');

        return view('lesson.deleted_list',[            
            'isAdmin' => ($this->auth('role_id') === 1),
            'isTeacher' => ($this->auth('role_id') === 2),
            'isStudent' => ($this->auth('role_id') === 3),
            'items' => $data ,
            'page_title' => 'Tananyagok' ,
            'page_subtitle' => 'Törölt elemek listája' ,
            'page_links' => $page_links,
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
        if ($this->auth('role_id') !== 1 && $this->auth('role_id') !== 2)  {
            return redirect()->to('/');
        }

        $request->validate([
            'topic'     =>      'required',
            'content'   =>      'required',
        ]);

        $new = Lesson::create([
            
            'topic' => $request->topic,
            'content' => $request->content,
            'course_id' => $request->course_id,
        ]);
        
        if (!is_null($new)) {
        $new->save();

        return redirect()->to('/course/'.$request->course_id.'/lesson/');
        } else {
            return back()->with('error', 'Hoppá, hiba történt. Próbáld újra.');
        }
    }

    public function create_form($course_id)
    {
        if ($this->auth('role_id') !== 1 && $this->auth('role_id') !== 2)  {
            return redirect()->to('/');
        }

        $courses = Course::get();
            
        return view('lesson.lesson_create',[ 
            'courses' => $courses,
            'course_id' => $course_id,
            'page_title' => 'Tananyagok' ,
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
    public function show($course_id, $lesson_id)
    {

        if ($this->auth('role_id') == null) {
            return redirect()->to('/');
        }

        $data = Lesson::where('id', $lesson_id) 
        -> select('lessons.*')
        -> first();   

        return view('lesson.lesson_content',[ 
            'page_title' => 'Tananyag',
            'page_subtitle' => 'Tartalom',
            'course_id' => $course_id,
            'topic' => $data -> topic,
            'content' => preg_replace('/[\r\n]+/msi', '<br>', $data -> content),
            'page_links' => [
                (object)['label' => 'Vissza', 'link' => '/course/'.$course_id.'/lesson/'] ,
            ] ,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($this->auth('role_id') !== 1 && $this->auth('role_id') !== 2)  {
            return redirect()->to('/');
        }

        $data = Lesson::where('id', $id) -> first();
        $courses = Course::get();

        return view('lesson.lesson_edit',[
            
            'id' => $data -> id,
            'topic' => $data -> topic,
            'content' => $data -> content,
            'course_id' => $data -> course_id,
            'courses' => $courses,
            'page_title' => 'Tananyagok' ,
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

        if ($this->auth('role_id') !== 1 && $this->auth('role_id') !== 2)  {
            return redirect()->to('/');
        }

        $request->validate([
            'topic'     =>      'required',
            'content'   =>      'required',
        ]);

        $new = Lesson::where('id', $id) -> update([
            
            'topic' => $request->topic,
            'content' => $request->content,
            'course_id' => $request->course_id,
        ]);
        
        if (!is_null($new)) {
            return redirect()->to('course/'.$request->course_id.'/lesson/content/'.$id);
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

    public function undo_delete($id)
    {
        if ($this->auth('role_id') == 1 || $this->auth('role_id') == 2) {
            $delete = Lesson::where('id', $id)->update([
                'deleted_at' => NULL
            ]);
        }
        return redirect()->to('/lesson');
    }
     
    public function destroy($id)
    {
        if ($this->auth('role_id') == 1 || $this->auth('role_id') == 2) {
            $delete = Lesson::where('id', $id)->update([
                'deleted_at' => Carbon::now()
            ]);
        }
        return redirect()->to('/lesson');
    }
}
