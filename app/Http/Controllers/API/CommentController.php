<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentMail;
use App\Notifications\CommentNotification;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $comments = Comment::all();
        return response()->json(['comments' => $comments ], 200);
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
        $inpute = $request->all();
        $inpute['user_id'] = Auth::user()->id;
        $comment = Comment::create($inpute);

        // $user = User::where()

        // $title ='New Comment';
        // $body = 'Comment is '. ' ' .$request->content;

        //    Mail::to($user)->send(new CommentMail($follow));
        //     $title = 'comment Notification';
        //     $body = 'New user is following You ';
        //     $user->notify(new CommentNotification($user, $title, $body));

        return response()->json([
            'status' => 'success',
            'message' => 'success',
            'data' => $comment->load('user:id,name,avatar,email')->refresh()
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
        //get comment
        $comment = Comment::find($id);
        //check if comment exist
        if(!$comment){
            return response()->json([
                'status' => 'error',
                'message' => 'comment not found'
            ]);
        }
        //check if user is comment owner
        if(Auth::user()->id != $comment->user_id){
            return response()->json([
                'status' => 'error',
                'message' => 'you are not comment owner'
            ]);
        }
        //return comment
        return response()->json([
            'status' => 'success',
            'message' => 'success',
            'data' => $comment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get comment
        $comment = Comment::find($id);
        //check if comment exist
        if(!$comment){
            return response()->json([
                'status' => 'error',
                'message' => 'comment not found'
            ]);
        }
        //check if user is comment owner
        if(Auth::user()->id != $comment->user_id){
            return response()->json([
                'status' => 'error',
                'message' => 'you are not comment owner'
            ]);
        }
        //return comment
        return response()->json([
            'status' => 'success',
            'message' => 'success',
            'data' => $comment
        ]);
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
        //update comment
        $comment = Comment::find($id);
        $comment->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'success',
            'data' => $comment->load('user','likes','liked')->refresh()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete comment
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'success',
            'data' => $comment
        ]);

    }
}
