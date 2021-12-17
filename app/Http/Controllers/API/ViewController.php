<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = View::all();
        return response()->json(['data' => $videos, 'message' => "fetched successfully", 'status' => true ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user()->id;

        $alreadyViewed =  View::where('user_id', $user)
               ->where('video_id', $request->video_id)
               ->first();
        if(!$alreadyViewed) {
             $input = $request->all();
             $input['user_id'] = $user;
            $view = View::create($input);

        return response()->json([
            'status' => 'success',
            'message' => 'viewed successfully',
            'data' => $view
        ]);        
    }

    return response()->json([
        'status' => 'success',
        'message' => 'already viewed',
        'data' => $alreadyViewed
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
        //
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
        //
    }
}
