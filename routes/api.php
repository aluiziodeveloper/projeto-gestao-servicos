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

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    Route::name('login')->post('login', 'AuthController@login');
    Route::name('refresh')->post('refresh', 'AuthController@refresh');

    Route::group(['middleware' => ['auth:api','jwt.refresh']], function () {
        Route::name('logout')->post('logout', 'AuthController@logout');
        Route::name('me')->get('me', 'AuthController@me');
        Route::resource('atividades', 'AtividadeController', ['except' => ['create','edit']]);
        Route::resource('atividades.fotos', 'AtividadeFotoController', ['except' => ['create','edit']]);
        Route::resource('users', 'UserController', ['except' => ['create','edit']]);
    });
});
