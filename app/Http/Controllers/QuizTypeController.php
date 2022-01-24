<?php

namespace App\Http\Controllers;

use App\Models\QuizType;
use Illuminate\Http\Request;

class QuizTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QuizType::all();
        
        $page_links = [];

        if ($this->auth('role_id') == 1){
            $page_links = array_merge($page_links, [
              (object)['label' => 'Létrehozás', 'link' => '/admin/quiz-type/create'],
            ]);
        }elseif($this->auth('role_id') == null) {
            return redirect()->to('/');
        }

        return view('quiz.quiz_types_list',[
            'isAdmin' => ($this->auth('role_id') === 1),
            'items' => $data ,
            'page_title' => 'Feladat típusok' ,
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
            'name'          =>      'required',
        ]);

        $new = QuizType::create([
            'name' => $request->name,
        ]);

        if (!is_null($new)) {          
        $new->save();

        return redirect()->to('/admin/quiz-type');
        } else {
            return back()->with('error', 'Hoppá, hiba történt. Próbáld újra.');
        }
    }

    public function create_form()
    {
        if ($this->auth('role_id') !== 1) {
            return redirect()->to('/');
        }

            return view('quiz.quiz_types_create',[
                'page_title' => 'Feladat típusok' ,
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

        $data = QuizType::where('id', $id) -> first();
        
        return view('quiz.quiz_types_edit',[
            'name' => $data -> name,
            'id' => $data -> id,
            'page_title' => 'Feladat típusok' ,
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
            'name'          =>      'required',
        ]);

        $new = QuizType::where('id', $id) -> update([
            'name' => $request->name,
        ]);
        if (!is_null($new)) {
        return redirect()->to('/admin/quiz-type');
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
    