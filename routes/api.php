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
                Route::get('/featured-users', 'AuthController@get_featured_users');
                Route::put('/user/editProfile', 'AuthController@editProfile');
                Route::put('/changePassword', 'AuthController@changePassword');
                Route::post('/forgotPassword', 'AuthController@forgotPassword');
                Route::get('/user/{id}', 'AuthController@getUser');
                Route::get('/all', 'AuthController@allUsers');
                Route::put('/avatar', 'AuthController@avatar');
                Route::get('logout', 'AuthController@logout');
            });

            Route::group(['prefix'=> '/follow'], function () {
                Route::post('/', 'FollowController@store');
                Route::get('following/{user_id}', 'FollowController@followings');
                Route::get('/followers/{user_id}', 'FollowController@followers');
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
                    Route::get('/user/events', 'EventController@userEvents');
                    Route::delete('/{id}', 'EventController@destroy');
            });

            Route::group(['prefix'=> '/posts'], function () {
                    Route::post('/', 'PostController@store');
                    Route::put('/{id}', 'PostController@update');
                    Route::get('/all', 'PostController@index');
                    Route::get('/user/post', 'PostController@userPosts');
                    Route::get('/{id}', 'PostController@show');
                    Route::delete('/{id}', 'PostController@destroy');
            });

            Route::group(['prefix' => '/interests'], function () {
                    Route::post('/', 'InterestController@store');
                    Route::put('/{id}', 'InterestController@update');
                    Route::get('/', 'InterestController@index');
                    Route::get('/{id}', 'InterestController@show');
                    Route::delete('/{id}', 'InterestController@destroy');
            });

            Route::group(['prefix' => '/comments'], function () {
                Route::resource('/', 'CommentController');
            });

            Route::group(['prefix' => '/notification'], function () {
                Route::get('read/{id}', 'NotificationController@read');
                Route::get('read/all', 'NotificationController@read_all');
                Route::get('delete', 'NotificationController@delete');
            });

            Route::group(['prefix' => '/collections'], function () {
                Route::post('/', 'CollectionController@store');
                Route::get('/', 'CollectionController@index');
                Route::get('/{id}', 'CollectionController@show');
                Route::delete('/{id}', 'CollectionController@destroy');
            });

              Route::group(['prefix' => '/genre'], function () {
                Route::post('/', 'GenreController@store');
                Route::get('/', 'GenreController@index');
                Route::get('/{id}', 'GenreController@show');
                Route::delete('/{id}', 'GenreController@destroy');
            });

              Route::group(['prefix' => '/album'], function () {
                Route::post('/', 'AlbumController@store');
                Route::get('/', 'AlbumController@index');
                Route::get('/{id}', 'AlbumController@show');
                Route::delete('/{id}', 'AlbumController@destroy');
            });

            Route::group(['prefix' => '/userInterest'], function () {
                Route::post('/', 'UserInterestController@store');
                // Route::get('/', 'UserInterestController@index');
                // Route::get('/{id}', 'UserInterestController@show');
                // Route::delete('/{id}', 'UserInterestController@destroy');
            });

            Route::group(['prefix' => '/playlists'], function () {
                Route::post('/', 'PlaylisController@store');
                Route::get('/', 'PlaylisController@index');
                Route::get('/{id}', 'PlaylisController@show');
                Route::put('/{id}', 'PlaylisController@update');
                Route::delete('/{id}', 'PlaylisController@destroy');
            });

             Route::group(['prefix' => '/subscribes'], function () {
                 Route::post('/', 'EventSubscriptionController@store');
                 Route::get('/', 'EventSubscriptionController@index');
            }); 
            
            Route::group(['prefix' => '/playlist_keyword'], function () {
                Route::post('/', 'PlaylistKeywordController@store');
                Route::get('/', 'PlaylistKeywordController@index');
                Route::get('/{id}', 'PlaylistKeywordController@show');
                Route::delete('/{id}', 'PlaylistKeywordController@destroy');
            });
            
            Route::group(['prefix' => '/keywords'], function () {
                 Route::post('/', 'KeywordController@store');
                 Route::get('/', 'KeywordController@index');
                 Route::get('/{id}', 'KeywordController@show');
                 Route::delete('/{id}', 'KeywordController@destroy');
                 Route::put('/{id}', 'KeywordController@update');
            });

             Route::group(['prefix' => '/songs'], function () {
                 Route::post('/', 'SongController@store');
                 Route::get('/', 'SongController@index');
                 Route::get('/{id}', 'SongController@show');
                 Route::delete('/{id}', 'SongController@destroy');
                 Route::put('/{id}', 'SongController@update');
            });
            
            Route::group(['prefix' => '/playlist_songs'], function () {
                 Route::post('/', 'PlaylistSongController@store');
                 Route::get('/', 'PlaylistSongController@index');
                 Route::get('/{id}', 'PlaylistSongController@show');
                 Route::delete('/{id}', 'PlaylistSongController@destroy');
                //  Route::put('/{id}', 'PlaylistSongController@update');
            });

            Route::group(['prefix' => '/song_album'], function () {
                 Route::post('/', 'SongAlbumController@store');
                 Route::get('/', 'SongAlbumController@index');
                 Route::get('/{id}', 'SongAlbumController@show');
                 Route::delete('/{id}', 'SongAlbumController@destroy');
                //  Route::put('/{id}', 'PlaylistSongController@update');
            });

             Route::group(['prefix' => '/song_artist'], function () {
                 Route::post('/', 'SongArtistController@store');
                 Route::get('/', 'SongArtistController@index');
                 Route::get('/{id}', 'SongArtistController@show');
                 Route::delete('/{id}', 'SongArtistController@destroy');
                //  Route::put('/{id}', 'PlaylistSongController@update');
            });
            
            
            Route::group(['prefix' => '/song_genre'], function () {
                 Route::post('/', 'SongGenreController@store');
                 Route::get('/', 'SongGenreController@index');
                 Route::get('/{id}', 'SongGenreController@show');
                 Route::delete('/{id}', 'SongGenreController@destroy');
                //  Route::put('/{id}', 'PlaylistSongController@update');
            }); 
            
            Route::group(['prefix' => '/song_keyword'], function () {
                 Route::post('/', 'SongKeywordController@store');
                 Route::get('/', 'SongKeywordController@index');
                 Route::get('/{id}', 'SongKeywordController@show');
                 Route::delete('/{id}', 'SongKeywordController@destroy');
                //  Route::put('/{id}', 'PlaylistSongController@update');
            });

             Route::group(['prefix' => '/videos'], function () {
                 Route::post('/', 'VideoController@store');
                 Route::get('/', 'VideoController@index');
                 Route::get('/{id}', 'VideoController@show');
                 Route::delete('/{id}', 'VideoController@destroy');
                 Route::put('/{id}', 'VideoController@update');
            });


             Route::group(['prefix' => '/category'], function () {
                 Route::post('/', 'CategoryController@store');
                 Route::get('/', 'CategoryController@index');
                 Route::get('/{id}', 'CategoryController@show');
                 Route::delete('/{id}', 'CategoryController@destroy');
                 Route::put('/{id}', 'CategoryController@update');
            });


              Route::group(['prefix' => '/video_category'], function () {
                 Route::post('/', 'VideoCategoryController@store');
                 Route::get('/', 'VideoCategoryController@index');
                 Route::get('/{id}', 'VideoCategoryController@show');
                 Route::delete('/{id}', 'VideoCategoryController@destroy');
                 Route::put('/{id}', 'VideoCategoryController@update');
            });

             Route::group(['prefix' => '/video_collection'], function () {
                 Route::post('/', 'VideoCollectionController@store');
                 Route::get('/', 'VideoCollectionController@index');
                 Route::get('/{id}', 'VideoCollectionController@show');
                 Route::delete('/{id}', 'VideoCollectionController@destroy');
                 Route::put('/{id}', 'VideoCollectionController@update');
            });

             Route::group(['prefix' => '/video_keyword'], function () {
                 Route::post('/', 'VideoKeywordController@store');
                 Route::get('/', 'VideoKeywordController@index');
                 Route::get('/{id}', 'VideoKeywordController@show');
                 Route::delete('/{id}', 'VideoKeywordController@destroy');
                //  Route::put('/{id}', 'VideoKeywordController@update');
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
