<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genre = Genre::all();
         return response()->json(['data' => $genre]);
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
            'name' => 'string',
            'image' => 'required|string',
        ]);

            // $user = Auth::user()->id;

        try {
            $genre = new Genre;
            $genre->name = $request->input('name');
            $genre->image = $request->input('image');
            // $genre->user_id = $user;
            $genre->save();
            return response()->json(['data' => $genre, 'message' => 'genre created successfully', 'status' => true], 201);
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
            $genre = Genre::findOrFail($id);
            if($genre) return response()->json(['data' => $genre], 200);
        }       
         catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong', 'status' => true], 500);  
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
            $genre = Genre::findOrFail($id);
            $genre->delete();
            if($genre){                
                return response()->json(['message'=> 'genre deleted successfully'], 200);  
            } else {
                return response()->json(['message'=> 'Not found', 'status' => true], 404);  
            }
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong!', 'status' => false], 500);

        }
    
    }
}
