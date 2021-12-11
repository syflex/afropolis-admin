<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json(['posts' => $posts ]);
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
            'title' => 'string',
            'description' => 'stringsss',
            'video' => 'required|string',
        ]);

            $user = Auth::user()->id;

        try {
            $post = new Post;
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->video = $request->input('video');
            $post->user_id = $user;
            $post->save();
            return response()->json(['post' => $post, 'message' => 'Post created successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Post creation Failed!'.$e, 'status' => false], 500);
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
        $post = Post::findOrFail($id);
        if($post) return response()->json(['post' => $post], 200);
        }       
         catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong', 'status' => true], 500);  
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
            'title' => 'string',
            'description' => 'string|',
            'video' => 'required|string',
        ]);

        try {
            $post = Post::findOrFail($id);
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->video = $request->input('video');
            $post->user_id = $user;
            $post->save();
            return response()->json(['post' => $post, 'message' => 'Post updated successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Post creation Failed!', 'status' => false], 500);
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
                return response()->json(['message'=> 'Post deleted successfully'], 200);  
            } else {
                return response()->json(['message'=> 'Not found', 'status' => true], 200);  
            }
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong!', 'status' => false], 500);

        }
    }
}