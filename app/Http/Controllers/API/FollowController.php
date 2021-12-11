<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Notifications\GeneralNotification;
use App\Models\Follow;
use App\Models\User;
use Auth;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkStatus = Follow::where('user_id', '=', (Auth::user()->id))->where('follow_id', $request->id)->count();
        $id = $request->user_id ? $request->user_id : Auth::user()->id;
        if (!$checkStatus) {
            $follow = new Follow([
                'user_id' => Auth::user()->id,
                'follow_id' => $request->id,
                'type' => $request->type,
            ]);
            $follow->save();
            $message = 'followed';
        } else {
            $follow =  Follow::where('user_id', (Auth::user()->id))->where('follow_id', $request->id);
            $follow->delete();
            $message = 'unfollowed';
        }

        $user = auth()->user();
        $follow = User::where('id', $request->id)->first();

        $title = $message . ' Notification';
        $content_title = $request->title;
        $body = 'You '. $message. ' ' .$follow->name;
        $user_data = $follow;
         // current user
        // $user->notify(new GeneralNotification($user, $title, $content_title, $body, $follow));
        // liked user
        // $follow->notify(new GeneralNotification($follow, $title, $content_title, $body, $user));

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $follow
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * get all followings
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function followings($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $followings = Follow::where('user_id', $user->id)->with('followings','followings.followed')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'fetched followings',
            'data' => $followings
        ]);
    }

    public function followers($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $followers = Follow::where('follow_id', $user->id)->with('followers','followers.followed')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'fetched followers',
            'data' => $followers
        ]);
    }

}
