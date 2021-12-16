<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoCategory;
use Illuminate\Support\Facades\Auth;

class VideoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = VideoCategory::with('video')
        ->with('interest')
        ->with('category')
        ->get();
         return response()->json(['data' => $category, "message" => 'data fetched successfully', 'status' => true]);
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
        $category = VideoCategory::create($input);
        return response()->json([
            'status' => 'success',
            'message' => 'created successfully',
            'data' => $category
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
        $category = VideoCategory::findOrFail($id);
    
        if($category) return response()->json([
            'data' => $category,
            'status' => true,
            'message' => 'retrieved Category'
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
          //update video
        $category = VideoCategory::findOrFail($id);
        $input = $request->all();
        $category->update($input);
        return response()->json([
            'status' => 'success',
            'message' => 'updated successfully',
            'data' => $category
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
        $category = VideoCategory::findOrFail($id);
        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'category deleted successfully',
            'data' => $category
        ]);
    }
}
