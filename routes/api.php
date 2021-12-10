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
//     return $request->user();
// });


Route::namespace('App\Http\Controllers\API')->group(function () {

    // Route::post('login', 'AuthController@login');
    // Route::post('signup', 'AuthController@signup');
    // Route::get('featured_category', 'CategoryController@featurd');


    // //password reset routes
    // Route::group(['middleware' => 'api', 'prefix' => 'password'], function () {
    //     Route::post('create', 'PasswordResetController@create');
    //     Route::get('find/{token}', 'Auth\PasswordResetController@find');
    //     Route::post('reset', 'Auth\PasswordResetController@reset');
    // });

    // Route::group(['middleware' => 'auth:api'], function () {
    //     Route::get('logout', 'AuthController@logout');
    //     Route::get('user', 'AuthController@user');

    //     Route::resource('users', 'UsersController');
    //     Route::post('user/avatar', 'UsersController@avatar');
    //     Route::get('user/post', 'UsersController@post');
    //     Route::post('user/validate', 'UsersController@validate_password');

    // });


    // New implementation
Route::group(['prefix'=> '/v1/accounts'], function () {
        Route::post('/signup', 'AuthController@signUp');
        Route::post('/signin', 'AuthController@signIn');
        Route::get('/user', 'AuthController@user');

    });

});
