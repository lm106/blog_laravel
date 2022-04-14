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
Route::view('/', 'welcome');
/*
Route::get('register', [AuthController::class, 'show_signup_form']->name('register');
Route::post('register', [RegisterController::class, 'process_signup']);
*/
	/*
use App\Http\Controllers\PostController;
 
Route::get('post', [PostController::class, 'index'])->name('post');*/
use App\Http\Controllers\userController;
Route::post('/createUser', [userController::class, 'createUser']);
Route::get('/users', [userController::class, 'index']);
Route::get('/profile/{id}', [userController::class, 'show']);