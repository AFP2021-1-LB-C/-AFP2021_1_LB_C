<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::with(['role'])
        ->select('users.*')
        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
        ->get();

        //dd($data);
        
        return view('user.user_list',[
            'items' => $data ,
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

        $new = User::create([
            'name' => $request->name,
            'age' => $request->age,
            'role_id' => $request->role_id,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'registration_date' => $request->registration_date,
            'last_login_date' => $request->last_login_date,
        ]);
                
        $new->save();

        return redirect()->to('/admin/user');
    }

    public function create_form()
    {
            return view('user.user_create');
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
        $data = User::where('id', $id) -> first();
        
        return view('user.user_edit',[
            'name' => $data -> name,
            'id' => $data -> id,
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
        $new = User::where('id', $id) -> update([
            'name' => $request->name,
        ]);

        return redirect()->to('/admin/user');
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
