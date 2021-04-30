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
Route::group(['middleware' => ['auth:api']], function() use($router){
	$router->get('/logout', ['uses' => 'Auth\LoginController@logout']);
	$router->get('/products', ['uses' => 'ProductController@index']);
	$router->get('/single-prodct', ['uses' => 'ProductController@singleProduct']);
	$router->get('/cart', ['uses' => 'CartController@getCart']);
	$router->post('/add-cart', ['uses' => 'CartController@addCart']);
	$router->post('/remove-cart', ['uses' => 'CartController@removeCart']);
});
$router->post('/login', ['uses' => 'Auth\LoginController@authenticate']);