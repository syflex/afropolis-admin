<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserInterest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserInterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkStatus = UserInterest::where('user_id', '=', (Auth::user()->id))->where('category_id', $request->id)->count();
        if (!$checkStatus) {
            $interests = new  UserInterest;
            $interests->user_id = Auth::user()->id;
            $interests->interest_id = $request->id;
            $interests->save();
            $message = 'added';
        }else {
            $interests =  UserInterest::where('user_id', (Auth::user()->id))->where('category_id', $request->id);
            $interests->delete();
            $message = 'unfollowed';
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $interests
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
