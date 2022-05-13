<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\List_private;

class ListController extends Controller
{
    /**
     * Mostrar las listas privadas que tiene el usuario
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
        $user=$request->session()->get('user');
        $user_id=($user[0]!=null)?$user[0]->id:$user->id;
        $list_n_recetas= List_private::select('user_id','name',DB::raw('COUNT(recipe_id) as n_recetas'))
        ->distinct('user_id','name')->groupBy('user_id','name')->where('user_id','=', $user_id)->get();

        // $receta_destaca=DB::table('likes')
        // ->crossJoin('receta', 'receta.id', '=', 'likes.recipe_id')
        // ->distinct('likes.recipe_id', 'title')
        // ->groupBy('likes.recipe_id','title', 'image', 'likes.user_id')
        // ->select('recipe_id','title', 'image', DB::raw('COUNT(likes.user_id) as n_recetas') )
        // ->get();
        
        return response()->json($list_n_recetas);
    }

    /**
     * Crear una lista privada vacía
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
    public function check_recipe(Request $request){
        //
        $user=$request->session()->get('user');
        if($user != ""){
            $user_id=($user[0]!=null)?$user[0]->id:$user->id;
            $check=List_private::where('user_id','=', $user_id)
                ->where('recipe_id','=', $request->get('id'))->count();
            if($check>=1){
                return 'ok';
            }else{
                return 'not';
            }
        }
    }

    /**
     * Mostrar los nombres de las listas privadas del usuario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request){
        //
        $user=$request->session()->get('user');
        if($user != ""){
            $user_id=($user[0]!=null)?$user[0]->id:$user->id;
            $list_user= List_private::select('user_id','name')
            ->distinct('name')->groupBy('user_id','name')->where('user_id','=', $user_id)->get();
            return response()->json($list_user);
        } else{
            return 'not';
        }
    }

    /**
     * Mostrar el contenido de una lista
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_list(Request $request, $name){
        //
        $user=$request->session()->get('user');
        if($user != ""){
            $user_id=($user[0]!=null)?$user[0]->id:$user->id;
            $list_recipe=List_private::select('list.id as list_id','receta.*')
                ->where('list.user_id', '=', $user_id)
                ->where('name', '=', $name)->rightJoin('receta', 'recipe_id', 'receta.id')->get();
            return response()->json($list_recipe);
        } else{
            return 'not';
        }
    }

    /**
     * Guardar una receta en una lista privada
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save_recipe(Request $request){
        //
        $request->validate([
            'name'=>'required',
            'user_id'=>['required'],
            'recipe_id'=>['required']
        ]);
        $check=List_private::where('user_id','=', $request->get('user_id'))
            ->where('recipe_id','=', $request->get('recipe_id'))
            ->where('name', '=', $request->get('name'))->count();
        if($check == 0){
            $save= new List_private();
            $save->name=$request->get('name');
            $save->user_id=$request->get('user_id');
            $save->recipe_id=$request->get('recipe_id');
            $save->save();
            return 'ok';
        } else{
            return 'not';
            // return response()->json($check);
        }
    }

    public function update(Request $request){
        $list_old=$request->get('name_old');
        $user_new=$request->get('name_new');
        $user=$request->session()->get('user');
        if($user != ""){
            $user_id=($user[0]!=null)?$user[0]->id:$user->id;
        }
        // $list_db=List_private::find($list->id);
        // if($list->name)
        $list_db=List_private::where('name','=', $list_old)->where('user_id', '=', $user_id)->whereNull('recipe_id')->select('name')->distinct()->get();
        if($list_db!= $user_new){
            $lists_id=List_private::where('name','=', $list_old)->where('user_id', '=', $user_id)->select('id')->get();
            for ($i=0; $i < $lists_id->count(); $i++) { 
                $list=List_private::find($lists_id[$i]->id);
                $list->update(['name' => $user_new]);
            }   
            $lists_update=List_private::where('name','=', $user_new)->where('user_id','=', $user_id)->whereNotNull('recipe_id')->get();
            if($lists_update->count()>1){
                return $lists_update;
            }else{
                return 'not';
            }
        }
        return 'not';
    }


    public function dissave_recipe(Request $request){
        //
        $request->validate([
            'name'=>'required',
            'user_id'=>['required'],
            'recipe_id'=>['required']
        ]);
        $check=List_private::where('user_id','=', $request->get('user_id'))
            ->where('recipe_id','=', $request->get('recipe_id'))
            ->where('name', '=', $request->get('name'))->delete();
        if($check>=1){
            return 'ok';
        } else{
            return 'not';
        }
        // return response()->json($check);
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

