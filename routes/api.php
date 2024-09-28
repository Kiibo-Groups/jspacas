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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//  return $request->user();

Route::group(array('namespace' => 'App\Http\Controllers\Api'), function () {

    Route::get('welcome','ApiController@welcome');
    Route::get('getDataInit','ApiController@getDataInit');
    
    
    /*________________________
    |                         
    |           Login         
    |_________________________
    */
    
    Route::post('login', 'ApiController@login');
    Route::post('logout', 'ApiController@logout');

    /*________________________
    |                         
    |           Signup         
    |_________________________
    */
    Route::post('signup', 'ApiController@signup');
    
    /*________________________
    |                         
    |    Validacion de usuario 
    |    y Obtencion de DATA
    |_________________________
    */
    Route::post('chkUser','ApiController@chkUser');
    Route::get('userinfo/{id}','ApiController@userinfo');
    Route::post('updateInfo/{id}','ApiController@updateInfo');


});
