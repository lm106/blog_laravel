<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
    public function show($id)
    {
        //
        $user = User::find($id);
        return response()->json($user);

        
        


        // public function index(Request $request)
        // {
        //     $tasks = Task::orderBy('id', 'DESC')->paginate(2);
    
        //     return [
        //         'pagination' => [
        //             'total'         => $tasks->total(),
        //             'current_page'  => $tasks->currentPage(),
        //             'per_page'      => $tasks->perPage(),
        //             'last_page'     => $tasks->lastPage(),
        //             'from'          => $tasks->firstItem(),
        //             'to'            => $tasks->lastPage(),
        //         ],
        //         'tasks' => $tasks
        //     ];
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
