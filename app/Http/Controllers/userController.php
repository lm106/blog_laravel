<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Muestra todos los usuarios (Rol de administrador)
        $users = User::all()->toArray();
        return array_reverse($users); 
    }
    public function login(Request $request){
        $request->validate([
            'email'=>['required', 'email'],
            'password'=> 'required'
        ]);
        $user = new User();
        $user->email=$request->get('email');
        $user->password=$request->get('password');
        $user_login = DB::table('user')
            ->where('email', '=', $user['email'])
            -> where('password', '=', $user['password'])
            ->get();
        if($user_login != null) session(['user'=>$user_login]);
        // return ($user['password']===$user['password'])? response()->json($user_check): 'Error: no coincide';
        return $request->session()->all();
    }

    public function logout(Request $request){
        $request->session()->forget('user');
        // return $request->session()->all();
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',
            'email'=>['required', 'email', 'unique:user'],
            'password'=>'required'
        ]);
        $user = new User();
        $user->name = $request->get('name');
        $user->name_last = $request->get('name_last');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->type= $request->get('type');
        $user -> save();
        // $request->session()->put(['login'=>'user']);
        // session(['login'=>'token']);
        /*Para eliminar session
        $request->session()->forget('login');
        $request->session()->flush(); //Para eliminar toda la información
        */
        $request->session()->put(['user' => $user]);

        return $request->session()->all();
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        // $id = $request->session('user')->get();
        // $user = User::find($id);
        return $request->session()->get('user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
