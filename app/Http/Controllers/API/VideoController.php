<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;


class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::with('user','like','category','view')->get();
        return response()->json([
            'status' => 'successful',
            'message' => 'fetched successfully',
            'data' => $videos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create video

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        //store video
        $input = $request->all();
        $input['user_id'] = $user->id;
        $video = Video::create($input);
        return response()->json([
            'status' => 'success',
            'message' => 'video created successfully',
            'data' => $video
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
        //get a video
        $video = Video::where('id',$id)
        ->with('user','like','category','view')
        ->first();
        return response()->json([
            'status' => 'success',
            'message' => 'video fetch successfully',
            'data' => $video
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
        //update video
        $video = Video::findOrFail($id);
        $input = $request->all();
        $video->update($input);
        return response()->json([
            'status' => 'success',
            'message' => 'video updated successfully',
            'data' => $video
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
        //delete video
        $video = Video::findOrFail($id);
        $video->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'video deleted successfully',
            'data' => $video
        ]);
    }
}
