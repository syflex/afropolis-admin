<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostMail;
use App\Notifications\PostNotification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')
         ->with('comments','comments.user')
         ->with('likes')
        ->get();
        return response()->json(['data' => $posts, 'message' => "fetched successfully", 'status' => true ]);
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
        $this->validate($request, [
            'video' => 'required|string',
        ]);

        $user = Auth::user();

        try {
            $post = new Post;
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->video_url = $request->input('video');
            $post->image_url = $request->input('image_url');
            $post->user_id = $user->id;
            $post->save();

            $users = Follow::where('follow_id', $user->id)->where('type', 'post')->get();
            $title ='New Post from'. $user->name;

            // Mail::to($users)->send(new PostMail($users));
            // $body = 'New post alert ';
            // $user->notify(new PostNotification($users, $title, $body));

            return response()->json([
                'post' => $post,
                'message' => 'Post created successfully',
                'status' => true
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Post creation Failed!'.$e,
                'status' => false
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
        $post = Post::findOrFail($id)
         ->with('user')
         ->with('comments', 'comments.user')
         ->with('likes')
        ->get();
        if($post) return response()->json([
            'data' => $post,
            'status' => true,
            'message' => 'retrieved post'
        ], 200);
        }
         catch(\Exception $e){
            return response()->json([
                'error' => 'Something went wrong',
                'status' => true
            ], 500);
        }
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
         $this->validate($request, [
            'video' => 'required|string',
        ]);

        try {
            $post = Post::findOrFail($id);
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->video = $request->input('video');
            $post->image_url = $request->input('image_url');
            $post->user_id = Auth::user()->id;
            $post->save();

            return response()->json([
                'data' => $post,
                'message' => 'Post updated successfully',
                'status' => true
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Post creation Failed!',
                'status' => false
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try{
            $post = Post::findOrFail($id);
            $post->delete();
            if($post){
                return response()->json([
                    'status' => true,
                    'message' => 'Post deleted successfully'
                ], 200);
            } else {
                return response()->json([
                    'message'=> 'Not found',
                    'status' => true
                ], 200);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Something went wrong!',
                'status' => false
            ], 500);

        }
    }

    // user post
    public function userPosts ()
    {
         $posts = Post::with('comments')
         ->with('likes')
         ->where('user_id', Auth::user()->id)
         ->get();
        return response()->json([
            'status' => 'success',
            'message'=> 'Post fetched',
            'data' => $posts
        ]);
    }
}
