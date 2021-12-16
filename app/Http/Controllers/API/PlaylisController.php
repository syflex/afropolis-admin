<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlists;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlaylisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $playlists = Playlists::all();

            if(!$playlists){
                return response()->json([
                    'status' => false,
                    'message' => 'No playlist found'
                ]);
            }

            return response()->json([
                'data' => $playlists,
                'status' => true,
                'message' => 'playlist retrieved successfully'
            ]);
        }
         catch(\Exception $e){
            return response()->json([
                'message' => 'Something went wrong',
                'status' => true
            ], 500);
         }
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
        $input['user_id']= Auth::user()->id;;
        $playlist = Playlists::create($input);

        return response()->json([
         'message' => 'Playlist created successfully',
         'data' => $playlist,
         'status' => true
        ], 201);
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
            $playlist = Playlists::findOrFail($id);
            if($playlist) return response()->json([
                'data' => $playlist,
                'status' => true,
                'message' => 'platlist retrieved successfully'
            ]);
        }
         catch(\Exception $e){
            return response()->json([
                'message' => 'Something went wrong',
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

        $playlist = Playlists::findOrFail($id);
         $playlist->name = $request->input('name');
         $playlist->image_url = $request->input('image_url');
         $playlist->description = $request->input('description');
         $playlist->save();

        return response()->json([
         'message' => 'Playlist updated successfully',
         'data' => $playlist,
         'status' => true
        ], 201);
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
            $playlist = Playlists::findOrFail($id);
            $playlist->delete();
            if($playlist){
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
