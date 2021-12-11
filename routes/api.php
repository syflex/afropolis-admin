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

    // New implementation
    Route::prefix('/v1')->group(function () {

        Route::group(['prefix'=> '/accounts'], function () {
            Route::post('/signup', 'AuthController@signUp');
            Route::post('/signin', 'AuthController@signIn');
        });

        Route::group(['middleware' => 'auth:api'], function () {
            // Route::resource('users', 'UsersController');
            // Route::post('user/avatar', 'UsersController@avatar');
            // Route::get('user/post', 'UsersController@post');
            // Route::post('user/validate', 'UsersController@validate_password');

            Route::group(['prefix'=> '/accounts'], function () {
                Route::get('user', 'AuthController@user');
                Route::get('featured-users', 'AuthController@get_featured_users');
                Route::put('/user/editProfile', 'AuthController@editProfile');
                Route::get('/user/{id}', 'AuthController@getUser');
                Route::get('/all', 'AuthController@allUsers');
                Route::post('/avatar', 'AuthController@avatar');
                Route::get('logout', 'AuthController@logout');
            });

            Route::group(['prefix'=> '/follow'], function () {
                Route::post('/', 'FollowController@store');
                Route::get('following/{user_id}', 'FollowController@followings');
                Route::get('followers/{user_id}', 'FollowController@followers');
            });

            Route::group(['prefix'=> '/like'], function () {
               Route::post('/', 'LikeController@store');
            });

                // events
            Route::group(['prefix'=> '/events'], function () {
                    Route::post('/create', 'EventController@store');
                    Route::put('/{id}', 'EventController@update');
                    Route::get('/', 'EventController@index');
                    Route::get('/{id}', 'EventController@show');
                    Route::delete('/{id}', 'EventController@destroy');
            });

            Route::group(['prefix'=> '/posts'], function () {
                    Route::post('/', 'PostController@store');
                    Route::put('/{id}', 'PostController@update');
                    Route::get('/all', 'PostController@index');
                    Route::get('/{id}', 'PostController@show');
                    Route::delete('/{id}', 'PostController@destroy');
            });

            Route::group(['prefix' => '/interests'], function () {
                    Route::post('/', 'InterestController@store');
                    Route::put('/{id}', 'InterestController@update');
                    Route::get('/all', 'InterestController@index');
                    Route::get('/{id}', 'InterestController@show');
                    Route::delete('/{id}', 'InterestController@destroy');
            });

            Route::group(['prefix' => '/comment'], function () {
                Route::resource('comment', 'CommentController');
            });

        });

    });





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


});
