<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


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
            'page_title' => 'Felhasználók' ,
            'page_subtitle' => 'Lista' ,
            'page_links' => [
                (object)['label' => 'Létrehozás', 'link' => '/admin/user/create'] ,
            ] ,
        ]);
    }

    public function r_index()
{
    $roles = Role::get();

    return view('user.registration', [
        'roles' => $roles,
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
        $roles = Role::get();
        
        return view('user.user_create',[

            'roles' => $roles,
        ]);

        //return view('user.roles_create');
    }

    public function userPostRegistration(Request $request) {

        //jelenlegi dátum
        $date = Carbon::now();
        // validate form fields
        $request->validate([
                'first_name'        =>      'required',
                'last_name'         =>      'required',
                'username'          =>      'required',
                'email'             =>      'required|email',
                'password'          =>      'required|min:6',
                'confirm_password'  =>      'required|same:password',
                'age'               =>      'required',
                
            ]);

        $input          =           $request->all();

        $role = 1;
        if (User::exists()){
            $role = 2;
         }
        
// if validation success then create an input array

        $inputArray      =           array(
            // 'first_name'        =>      $request->first_name,
            // 'last_name'         =>      $request->last_name,
            'username'          =>      $request->username,
            'name'              =>      $request->first_name . " ". $request->last_name,
            'email'             =>      $request->email,
            'password'          =>      Hash::make($request->password),
            'age'               =>      $request->age,
            'role_id'           =>      $role,
            'registration_date' =>      $date,
            'last_login_date'   =>      $date,         
        );

        // register user
        $user           =           User::create($inputArray);

        // if registration success then return with success message
        if(!is_null($user)) {
            return back()->with('success', 'Sikeres regisztráció!.');
        }

        // else return with error message
        else {
            return back()->with('error', 'Hoppá, hiba történt a regisztráció során. Próbáld újra.');
        }
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

        $roles = Role::get();
        
        return view('user.user_edit',[
            'id' => $data -> id,
            'name' => $data -> name,
            'age' => $data -> age,
            'role_id' => $data -> role_id,
            'username' => $data -> username,
            'email' => $data -> email,
            'password' => $data -> password,
            'registration_date' => str_replace(' ', 'T', $data->registration_date),
            'last_login_date' => str_replace(' ', 'T', $data->last_login_date),
            'roles' => $roles
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
        $roles = Role::get();

        $new = User::where('id', $id) -> update([
            'name' => $request-> name,
            'age' => $request -> age,
            'role_id' => $request -> role_id,
            'username' => $request -> username,
            'email' => $request -> email,
            'password' => $request -> password,
            'registration_date' => $request -> registration_date,
            'last_login_date' => $request -> last_login_date,
            
            //'roles' => $roles
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
