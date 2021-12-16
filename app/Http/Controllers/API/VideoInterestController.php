<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoInterest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VideoInterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $videos = VideoInterest::with('video')->with('interest')->get();
            return response()->json([
                'status' => 'successful',
                'message' => 'fetched successfully',
                'data' => $videos,
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
        $video = VideoInterest::create($input);

        return response()->json([
            'status' => 'success',
            'message' => 'added successfully',
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
         try {
        $video = VideoInterest::findOrFail($id)
        ->with('video')
        ->with('interest')
        ->get();
    
        if($video) return response()->json([
            'data' => $video,
            'status' => true,
            'message' => 'retrieved Song'
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
            $video = VideoInterest::findOrFail($id);
            $video->delete();
            if($video){
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
