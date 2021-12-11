<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;


class VideoController extends Controller
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
        //store video
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $video = Video::create($input);
        return response()->json([
            'status' => 'success',
            'message' => 'video created successfully',
            'user' => $video
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
        $video = Video::find($id);
        return response()->json([
            'status' => 'success',
            'message' => 'video updated successfully',
            'user' => $video
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
            'user' => $video
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
            'user' => $video
        ]);
    }
}
