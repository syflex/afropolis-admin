<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SongAlbum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SongAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $songs = SongAlbum::with('song')
          ->with('album')
          ->get();
            return response()->json([
                'status' => 'successful',
                'message' => 'song album  fetched successfully',
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
        $song = SongAlbum::create($input);

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
        $song = SongAlbum::findOrFail($id)
        ->with('song')
        ->with('album')
        ->get();
    
        if($song) return response()->json([
            'data' => $song,
            'status' => true,
            'message' => 'retrieved Song album '
        ]);
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
         try{
            $song = SongAlbum::findOrFail($id);
            $song->delete();
            if($song){
                return response()->json([
                    'message' => 'deleted successfully',
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
