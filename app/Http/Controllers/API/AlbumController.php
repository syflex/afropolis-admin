<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Albums;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $album = Albums::all();
         return response()->json(['album' => $album], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'name' => '|required|string',
            'song' => 'required|string',
            'year' => 'required|string',
            'description' => 'string',
            'cover' => 'string',
        ]);

            // $user = Auth::user()->id;

        try {
            $album = new Albums;
            $album->name = $request->input('name');
            $album->cover = $request->input('cover');
            $album->description = $request->input('description');
            $album->song = $request->input('song');
            $album->year = $request->input('year');
            // $genre->user_id = $user;
            $album->save();
            return response()->json(['album' => $album, 'message' => 'album created successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Post creation Failed!'.$e, 'status' => false], 500);
        }
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
            $album = Albums::findOrFail($id);
            if($album) return response()->json(['album' => $album], 200);
        }       
         catch(\Exception $e){
            return response()->json(['error' => 'not found went wrong', 'status' => true], 404);  
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
            $album = Albums::findOrFail($id);
            $album->delete();
            if($album){                
                return response()->json(['message'=> 'album deleted successfully'], 200);  
            } else {
                return response()->json(['message'=> 'Not found', 'status' => true], 404);  
            }
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong!', 'status' => false], 500);

        }
    }
}
