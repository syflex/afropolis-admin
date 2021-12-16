<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerifiedUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class VerifiedUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = VerifiedUser::with('user')->get();
            return response()->json([
                'status' => 'successful',
                'message' => 'fetched successfully',
                'data' => $users,
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
        $user = Auth::user();
        $input = $request->all();
        $input['user_id'] = $user->id;
        $verify = VerifiedUser::create($input);

        return response()->json([
            'status' => 'success',
            'message' => 'verify successfully',
            'data' => $verify
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
        $verify = VerifiedUser::findOrFail($id);
    
        if($song) return response()->json([
            'data' => $verify,
            'status' => true,
            'message' => 'retrieved successfully'
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
            $verify = VerifiedUser::findOrFail($id);
            $verify->delete();
            if($verify){
                return response()->json([
                    'message' => 'Song deleted successfully',
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
