<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Role::all();
        
        return view('user.roles_list',[
            'items' => $data ,
            'page_title' => 'Szerepkörök' ,
            'page_subtitle' => 'Lista' ,
            'page_links' => [
                (object)['label' => 'Létrehozás', 'link' => '/admin/role/create'] ,
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

        $new = Role::create([
            'name' => $request->name,            
        ]);
                
        $new->save();

        return redirect()->to('/');
    }

    public function create_form()
    {
        return view('user.roles_create', [
            'page_title' => 'Szerepkörök' ,
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
        $data = Role::where('id', $id) -> first();
        
        return view('user.roles_edit',[
            'name' => $data -> name,
            'id' => $data -> id,
            'page_title' => 'Szerepkörök' ,
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
        
        $new = Role::where('id', $id) -> update([
            'name' => $request->name,
        ]);

        return redirect()->to('/');
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
