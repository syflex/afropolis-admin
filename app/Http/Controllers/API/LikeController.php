<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
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
        $checkStatus = Like::where('user_id', '=', (Auth::user()->id))
        ->where('likeable_id', $request->id)
        ->where('likeable_type', $request->type)->count();
            if(!$checkStatus){
                $like = new Like([
                    'user_id' => Auth::user()->id,
                    'likeable_id' => $request->id,
                    'likeable_type' => $request->type,
                ]);
                $like->save();
                $message = 'liked';
            }else{
                $like = Like::where('user_id', (Auth::user()->id))->where('likeable_id', $request->id);
                $like->delete();
                $message = 'unliked';
            }
            
            return response()->json([
                    'status' => 'success',
                    'message' => $message,
                    'data' => $like
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
}
