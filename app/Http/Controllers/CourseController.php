<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Courses_user;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        
        return view('course.course_list',[
            'isAdmin' => ($this->auth('role_id') === 1),
            'items' => $data ,
            'subs' => $subscriptions ,
            'page_title' => 'Kurzusok' ,
            'page_subtitle' => 'Lista' ,
            'page_links' => [
                (object)['label' => 'Létrehozás', 'link' => '/admin/course/create'] ,
            ] ,
        ]);
    }

    public function subscribe($id)
    {
        $date = Carbon::now();
        $userid = ($this->auth('id'));

        $new = Courses_user::create([
            'course_id' => $id,
            'user_id' => $userid,
            'date' => $date,
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

        $new = Course::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
                
        $new->save();

        return redirect()->to('/course');
    }

    public function create_form()
    {
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
        
        $new = Course::where('id', $id) -> update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->to('/course');
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
