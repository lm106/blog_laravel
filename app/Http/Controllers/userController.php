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
    public function index(){
        //Muestra todos los usuarios (Rol de administrador)
        $users = User::all();
        return response()->json($users); 
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request){
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
        // return response()->json($user);
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
    public function edit_user($id){
        $id_num=(int)$id;
        $user = User::find($id_num);
        return response()->json($user);
        // return  $id;
    }

    /** Mostrar los datos del usuario
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request){
        //
        // $id = $request->session('user')->get();
        // $user = User::find($id);
        return $request->session()->get('user');
    }

    /** Actualizar el perfil del usuario
     * 
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        //El que queremos actualizar
        $user_update = new User();
        $user_update->name = $request->get('name');
        $user_update->name_last = $request->get('name_last');
        $user_update->email = $request->get('email');
        $user_update->password = $request->get('password');
        $user_update->type= $request->get('type');
        //El antiguo que está en session (token)
        $user_old = $request->session()->get('user');
        //En la base de datos
        $user_db=User::find($user_old[0]->id);
        if($user_old[0]->name !==$user_update->name) $user_db->name=$user_update->name;
        if($user_old[0]->name_last !==$user_update->name_last) $user_db->name_last=$user_update->name_last;
        if($user_old[0]->password !==$user_update->password) $user_old->password=$user_update->password;
        $user_db->save();
        $request->session()->put(['user' => $user_update]);
        return response()->json($user_db);
        // return response()->json($user_update);
    }

    /** Actualizar un usuario (Rol Admnistrador)
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        //
        $user_update = new User();
        $user_update->name = $request->get('name');
        $user_update->name_last = $request->get('name_last');
        $user_update->email = $request->get('email');
        $user_update->password = $request->get('password');
        $user_update->type= $request->get('type');
        $user_update->id= $request->get('id');
        $user_db=User::find($user_update->id);
        if($user_db->name !==$user_update->name) $user_db->name=$user_update->name;
        if($user_db->name_last !==$user_update->name_last) $user_db->name_last=$user_update->name_last;
        if($user_db->password !==$user_update->password) $user_db->password=$user_update->password;
        if($user_db->type !==$user_update->type) $user_db->type=$user_update->type;
        $user_db->save();
        // return response()->json($user_db);

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
