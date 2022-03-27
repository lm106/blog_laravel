<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*Route::resource('blog', App\Http\Controllers\BlogController::class) ->only(['index', 'update','show','destroy']);
Route::get('blog', 'BlogController@index');
Route::group(['prefix' => 'post'], function () {
    Route::post('add', 'BlogController@add');
    Route::get('edit/{id}', 'BlogController@edit');
    Route::post('update/{id}', 'BlogController@update');
    Route::delete('delete/{id}', 'BlogController@delete');
});*/