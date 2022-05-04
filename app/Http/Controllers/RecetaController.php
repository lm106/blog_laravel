<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Receta;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$recetas = Receta::all();
        //return response()->json($recetas);

        $recetas = Receta::all()->toArray();
        return array_reverse($recetas);
    }

    public function nLike($id) {
        //$like = new Receta();
        //$like->n_likes()->where('recipe_id', '=', $id)->count();
        // $receta = DB::table('likes')->where('recipe_id', $id)->count();
        $like = Receta::find($id)->n_likes->count();
        return response()->json($like);
    }

    public function nComment($id) {
        $comment = Receta::find($id)->n_comment->count();
        return response()->json($comment);
    }

    public function allComments($id) {
        $comment = Receta::find($id)->n_comment;
        return response()->json($comment);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRecipe(Request $request)
    {
        //

        $request->validate([
            'title'=>'required',
            'image'=>'',
            'description'=>'required',
            'ingredients'=>'required',
            'user_id'=>'required'
        ]);

        $receta = new Receta();
        $receta->title = $request->get('title');
        $receta->image = $request->get('image');
        $receta->description = $request->get('description');
        $receta->ingredients = $request->get('ingredients');
        $receta->user_id = $request->get('user_id');
        $receta -> save();
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
