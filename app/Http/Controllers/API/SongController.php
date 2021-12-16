<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Songs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $songs = Songs::all();
            return response()->json([
                'status' => 'successful',
                'message' => 'songs  fetched successfully',
                'data' => $songs,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $input = $request->all();
        $song = Songs::create($input);

        return response()->json([
            'status' => 'success',
            'message' => 'added successfully',
            'data' => $song
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
          try {
        $song = Songs::findOrFail($id);
    
        if($song) return response()->json([
            'data' => $song,
            'status' => true,
            'message' => 'retrieved Song'
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $song = Songs::findOrFail($id);
         $song->title = $request->input('title');
         $song->year = $request->input('year');
         $song->description = $request->input('description');
         $song->image_url = $request->input('image_url');
         $song->song_url = $request->input('song_url');
         $song->save();

        return response()->json([
            'status' => 'success',
            'message' => 'update success',
            'data' => $song
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
        try{
            $song = Songs::findOrFail($id);
            $song->delete();
            if($song){
                return response()->json([
                    'message' => 'Song deleted successfully',
                    'status' => true
                ]);
            } else {
                return response()->json([
                    'message'=> 'Not found',
                    'status' => true
                ]);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Something went wrong!',
                'status' => false
            ], 500);
        }
    }
    
}
