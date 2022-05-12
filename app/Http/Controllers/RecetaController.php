<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Receta;
use App\Models\LikeComment;
use App\Models\Comment;
use App\Models\User;
use App\Models\Like;

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
        $like = [Receta::find($id)->n_likes->count(), Receta::find($id)->n_comment->count()];
        return response()->json($like);
    }

    public function allComments($id) {
        //$comment = Receta::find($id)->n_comment;
        $comments = Comment::with('nameUser')
            ->where('recipe_id', '=', $id)
            ->get()->toArray();
        return response()->json($comments);
    }

    public function allLikesComments($id) {
        $comments = DB::table('like_comment')
            ->select('like_comment.id as id', 'like_comment.user_id', 'like_comment.comment_id',
                    'user.id as user_id_comment')->where('like_comment.comment_id', '=', $id)
            ->crossJoin('user', 'user.id', '=', 'like_comment.user_id')->get();
        return response()->json($comments);
    }

    public function nLikes() {
        $recipe_fav = DB::table('receta')
        ->crossJoin('likes', 'receta.id', '=', 'likes.recipe_id')
        ->groupBy('likes.recipe_id', 'title', 'image', 'likes.user_id')
        ->select('recipe_id as id', 'title', 'image', DB::raw('COUNT(likes.user_id) as n_likes'))
        ->get();

        return response()->json($recipe_fav);
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
            'image.*' => 'mimes:jpeg,png,jpg,svg',
            'description'=>'required',
            'ingredients'=>'required',
            'user_id'=>'required'
        ]);
        
        if($image = $request->hasFile('image')) { 
            $image = $request->file('image') ;
            $imageName = $image->getClientOriginalName() ;
            $destinationPath = public_path().'/images' ;
            $image->move($destinationPath,$imageName);
        } 
        $receta = new Receta();
        $receta->title = $request->get('title');
        $receta->image = $request->get('image_path');
        $receta->description = $request->get('description');
        $receta->ingredients = $request->get('ingredients');
        $receta->tags = $request->get('tags');
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


    public function find_recipes($search){
        $finded_recipes = Receta::where('title','like','%'.$search.'%')->get()->toArray();
        return array_reverse($finded_recipes);
    }
}
