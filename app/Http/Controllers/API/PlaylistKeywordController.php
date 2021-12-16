<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlaylistKeyword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlaylistKeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $playlist_keyword = PlaylistKeyword::with('keyword')
        ->with('playlist')
        ->get();
            return response()->json([
                'status' => 'successful',
                'message' => 'Playlist Keyword fetched successfully',
                'data' => $playlist_keyword,
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
        $playlist = PlaylistKeyword::create($input);

        return response()->json([
            'status' => 'success',
            'message' => 'success',
            'data' => $playlist
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
        $playlist_keyword = PlaylistKeyword::findOrFail($id)
        ->with('keyword')
        ->with('playlist')->get();

    
        if($playlist_keyword) return response()->json([
            'data' => $playlist_keyword,
            'status' => true,
            'message' => 'retrieved playlist_keyword'
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
            $playlist_keyword = PlaylistKeyword::findOrFail($id);
            $playlist_keyword->delete();
            if($playlist_keyword){
                return response()->json([
                    'message' => 'playlist deleted successfully',
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
