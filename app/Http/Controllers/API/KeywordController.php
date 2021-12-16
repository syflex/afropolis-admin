<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keywords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Keywords = Keywords::all();
        return response()->json([
            'status' => 'successful',
            'message' => 'Keywords fetched successfully',
            'data' => $Keywords,
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
        $Keywords = Keywords::create($input);

        return response()->json([
            'status' => 'success',
            'message' => 'success',
            'data' => $Keywords
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
        $Keyword = Keywords::findOrFail($id);
        if($Keyword) return response()->json([
            'data' => $Keyword,
            'status' => true,
            'message' => 'retrieved Keyword'
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
         $Keywords = Keywords::findOrFail($id);
         $Keywords->word = $request->input('word');
         $Keywords->save();

        return response()->json([
            'status' => 'success',
            'message' => 'update success',
            'data' => $Keywords
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
            $Keyword = Keywords::findOrFail($id);
            $Keyword->delete();
            if($Keyword){
                return response()->json([
                    'status' => true,
                    'message' => 'Keyword deleted successfully'
                ], 200);
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
