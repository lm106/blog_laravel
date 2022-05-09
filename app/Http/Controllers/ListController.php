<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\List_private;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        //
        // $n_recetas= List_private::select('user_id','name', DB::raw('count(recipe_id) as n_recetas'))->groupBy('user_id','name')
        //     ->havingRaw('count(recipe_id) > 1')->get();

        //Muestra todos las listas de todos los usuarios
        // $n_recetas= List_private::select('user_id','name',DB::raw('COUNT(recipe_id) as n_recetas'))
        // ->distinct('user_id','name')->groupBy('user_id','name')->get();
        $user_id=$request->session()->get('user')[0]->id;
        $list_n_recetas= List_private::select('user_id','name',DB::raw('COUNT(recipe_id) as n_recetas'))
        ->distinct('user_id','name')->groupBy('user_id','name')->where('user_id','=', $user_id)->get();
        return response()->json($list_n_recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        //
        $request->validate([
            'name'=>'required',
            'user_id'=>['required']
        ]);
        $user_id=$request->get('user_id');
        $name=$request->get('name');
        $check_list=List_private::distinct()->where('user_id','=', $user_id)->where('name','=', $name)->exists();
        if(!$check_list){
            $list_new= new List_private();
            $list_new->name=$request->get('name');
            $list_new->user_id=$request->get('user_id');
            $list_new->save();
            return $list_new;
        }else{
            return 'not';
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $name){
        //
        $user=$request->session()->get('user');
        $user_id=($user[0])? $user[0]->id: $user->id;
        $delete_list=List_private::where('user_id','=', $user_id)->where('name','=',$name)->delete();
        return response()->json($delete_list);
    }
}
