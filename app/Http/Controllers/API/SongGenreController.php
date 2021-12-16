<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SongGenre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SongGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genre = SongGenre::with('song')->with('genre')->get();
        return response()->json(['data' => $genre, 
         'status' => true,
        'message' => 'retrieved  Song Genreg artist ']);
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
        $song = SongGenre::create($input);

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
         {
         try {
            $genre = SongGenre::findOrFail($id)
            ->with('song')
            ->with('genre')
            ->get();
            if($genre) return response()->json(['data' => $genre]);
        }       
         catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong', 'status' => true], 500);  
        }
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
            $genre = SongGenre::findOrFail($id);
            $genre->delete();
            if($genre){                
                return response()->json(['message'=> 'genre deleted successfully']);  
            } else {
            return response()->json(['message'=> 'Not found', 'status' => true], 404);  
            }
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong!', 'status' => false], 500);
        }
    
    }
    
}
