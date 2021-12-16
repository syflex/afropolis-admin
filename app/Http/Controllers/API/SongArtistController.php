<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SongArtist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SongArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $songs = SongArtist::with('song')
          ->with('user')
          ->get();
            return response()->json([
                'status' => 'successful',
                'message' => 'song artist  fetched successfully',
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
         $input['user_id']= Auth::user()->id;
        $song = SongArtist::create($input);

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
        $song = SongArtist::findOrFail($id)
        ->with('song')
        ->with('user')
        ->get();
    
        if($song) return response()->json([
            'data' => $song,
            'status' => true,
            'message' => 'retrieved Song artist '
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
            $song = SongArtist::findOrFail($id);
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
