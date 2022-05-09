<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/{any}', function () {
    return view('welcome');
<<<<<<< HEAD
})->where('any', '^(home|signUp|login).*$'); */
/*Route::get('/', function () {
    return view('welcome');
});*//*
Route::get('/', function () {
    return view('welcome');
});
*/

///Routes para poder recargar
Route::view('/', 'welcome');
Route::view('/recipe_description/{id}', 'welcome');
Route::view('/recipes_manager', 'welcome');
Route::view('/formulario_contacto','welcome');
Route::view('/profile', 'welcome');
Route::view('/login', 'welcome');
Route::view('/signup', 'welcome');
Route::view('/likes', 'welcome');
Route::view('/edit', 'welcome');
Route::view('/admin_list', 'welcome');
Route::view('/edit_user/{id}', 'welcome');
Route::view('/comment', 'welcome');
Route::view('/lists_private', 'welcome');



// Route::view('/logout', 'welcome');
/*
Route::get('register', [AuthController::class, 'show_signup_form']->name('register');
Route::post('register', [RegisterController::class, 'process_signup']);
*/
	/*
use App\Http\Controllers\PostController;
 
Route::get('post', [PostController::class, 'index'])->name('post');*/
use App\Http\Controllers\userController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeCommentController;
use App\Http\Controllers\ListController;

//#################Controlador de usuario##################
Route::post('/signup', [userController::class, 'createUser']);
Route::post('/login', [userController::class, 'login']);
Route::post('/logout', [userController::class, 'logout']);
Route::get('/profile', [userController::class, 'show']);
Route::post('/edit', [userController::class, 'edit']);
Route::get('/admin_list', [userController::class, 'index']); 
Route::post('/update_user', [userController::class, 'update']);
Route::get('/edit_user/{id}', [userController::class, 'edit_user']);
Route::post('/delete', [userController::class, 'destroy']);

//#################Controlador de receta##################
Route::get('/recetas', [RecetaController::class, 'index']);
Route::post('/new_recipe', [RecetaController::class, 'createRecipe']);
Route::get('/recipe_likes/{id}', [RecetaController::class, 'nLike']);
Route::get('/recipe_comments/{id}', [RecetaController::class, 'allComments']);
Route::get('/recipe_like_comments/{id}', [RecetaController::class, 'allLikesComments']);

//#################Controlador de like##################
Route::get('/likes/{id}', [LikeController::class, 'index']);
Route::get('/dislikes/{id}', [LikeController::class, 'destroy']);
Route::post('/likes', [LikeController::class, 'create']);

//#################Controlador de like comentarios##################
Route::get('/dislike_comment/{id}', [LikeCommentController::class, 'destroy']);
Route::post('/like_comment', [LikeCommentController::class, 'create']);
Route::post('/dislike_comment', [LikeCommentController::class, 'destroy']);

//#################Controlador de comentario##################
Route::post('/comment', [CommentController::class, 'create']);
Route::get('/edit_comment/{id}', [CommentController::class, 'edit']);
Route::post('/edit_comment', [CommentController::class, 'edit']);

//#################Controlador de Lista privadas##################
Route::get('/lists', [ListController::class, 'index']);
Route::post('/create_list', [ListController::class, 'create']);
Route::get('/delete_list/{name}', [ListController::class, 'destroy']);