<?php

use Illuminate\Http\Request;

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
$api = app('Dingo\Api\Routing\Router');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'auth'], function ($api) {
        $api->post('', 'App\Api\Controllers\Auth\AuthController@authenticate');
        $api->post('register', 'App\Api\Controllers\Auth\AuthController@register');
    });

    $api->group(['prefix' => 'users'], function ($api) {
        $api->get('', 'App\Api\Controllers\UserController@index');
        $api->get('{id}', 'App\Api\Controllers\UserController@show');
    });
    
    $api->group(['prefix' => 'notes', 'middleware' => 'api.auth'], function ($api) {
        $api->get('', 'App\Api\Controllers\NoteController@index');
        $api->post('', 'App\Api\Controllers\NoteController@store');
    });
});

