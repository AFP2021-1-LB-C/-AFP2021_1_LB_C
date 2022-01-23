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
        
        return view('quiz.quiz_types_list',[
            'items' => $data ,
            'page_title' => 'Feladat típusok' ,
            'page_subtitle' => 'Lista' ,
            'page_links' => [
                (object)['label' => 'Létrehozás', 'link' => '/admin/quiz-type/create'] ,
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

        $new = QuizType::create([
            'name' => $request->name,
        ]);
                
        $new->save();

        return redirect()->to('/quiz-type');
    }

    public function create_form()
    {
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
        
        $new = QuizType::where('id', $id) -> update([
            'name' => $request->name,
        ]);

        return redirect()->to('/quiz-type');
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
    