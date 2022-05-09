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
    public function index(Request $request)
    {
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
    public function create()
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
