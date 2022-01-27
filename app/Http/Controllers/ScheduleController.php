<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_links = [];

        if ($this->auth('role_id') == 1){
            $page_links = array_merge($page_links, [
                (object)['label' => 'Létrehozás', 'link' => '/admin/schedule/create'] ,
            ]);
        }elseif($this->auth('role_id') == null) {
            return redirect()->to('/');
        }

        $data = Schedule::with(['course'])
        ->select('schedules.*')
        ->get();
        $courses = Course::get();

        $types = [
            (object)['id' => 1, 'name' => 'írásbeli'],
            (object)['id' => 2, 'name' => 'szóbeli'],
            (object)['id' => 3, 'name' => 'gyakorlati'],
          ];
        
        return view('schedule.schedule_list',[
            'isAdmin' => ($this->auth('role_id') === 1),
            'contents' => $types ,
            'schedules' => $data ,
            'page_title' => 'Vizsga' ,
            'courses' => $courses ,
            'page_subtitle' => 'Lista' ,
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
        if ($this->auth('role_id') !== 1) {
            return redirect()->to('/');
        }

        $request->validate([
            'date'          =>      'required',
        ]);

        $new = Schedule::create([
            
            'course_id' => $request->course_id,
            'date' => $request->date,
            'type' => $request->type,
        ]);
        
        if (!is_null($new)) {        
        $new->save();

        return redirect()->to('/schedule');
        } else {
            return back()->with('error', 'Hoppá, hiba történt. Próbáld újra.');
        }
    }

    public function create_form()
    {
        if ($this->auth('role_id') !== 1) {
            return redirect()->to('/');
        }

        $schedule = Schedule::get();
        $courses = Course::get();
         
        $types = [
            (object)['id' => 1, 'name' => 'írásbeli'],
            (object)['id' => 2, 'name' => 'szóbeli'],
            (object)['id' => 3, 'name' => 'gyakorlati'],
          ];
        
        return view('schedule.schedule_create',[ 
            'courses' => $courses,
            'contents' => $types ,
            'schedules' => $schedule,
            'page_title' => 'Vizsga' ,
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
        /*
        $data = Schedule::where('id', $id) -> first();    
        return view('schedule.schedule_content',[ 
            'schedules' => $data -> schedule,
            'page_links' => [
                (object)['label' => 'Vissza', 'link' => '/admin/schedule'] ,
            ] ,
        ]);
        */
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

        $data = Schedule::where('id', $id) -> first();
        $courses = Course::get();
         
        $types = [
            (object)['id' => 1, 'name' => 'írásbeli'],
            (object)['id' => 2, 'name' => 'szóbeli'],
            (object)['id' => 3, 'name' => 'gyakorlati'],
        ];

        return view('schedule.schedule_edit',[
            'id' => $data -> id,
            'date' => str_replace(' ', 'T', $data->date),
            'course_id' => $data -> course_id,
            'courses' => $courses,
            'types_id' => $data -> type,
            'contents' => $types,
            'page_title' => 'Vizsga' ,
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
            'date'          =>      'required',
        ]);

        $new = Schedule::where('id', $id) -> update([
            
            'course_id' => $request->course_id,
            'date' => $request->date,
            'type' => $request->type,
        ]);
        if (!is_null($new)) {
        return redirect()->to('/schedule');
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
