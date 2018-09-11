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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
$api = app('Dingo\Api\Routing\Router');
$api->version('v1',['middleware' => 'api'], function ($api) {
	$api->group( ['prefix' => 'auth','namespace'=>'App\Http\Controllers'],function($api){
		$api->post('login', 'AuthController@login');
		$api->post('logout', 'AuthController@logout');
		$api->post('refresh', 'AuthController@refresh');
		$api->post('me', 'AuthController@me');
	});
	$api->group(['middleware' => 'api.auth', 'providers' => 'jwt'], function ($api) {
		$api->group(['prefix' => 'posts','namespace'=>'Api\Posts\Controllers'],function($api){
			$api->get('', 'PostController@index');
			$api->post('','PostController@store');
			$api->get('{id}','PostController@show');
			$api->put('{id}','PostController@update');
			$api->delete('{id}','PostController@destroy');
		});
        
    });

});
