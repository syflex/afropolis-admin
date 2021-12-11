<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interests = Interest::all();
        return response()->json(['Interests' => $interests ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
         //
         $this->validate($request, [
            'interest' => 'required|string|unique:interests'
        ]);

        // $user = Auth::user()->id;

        try {
            $interest = new Interest;
            $interest->interest = $request->input('interest');
            // $interest->user_id = $user;
            $interest->save();
            return response()->json(['interest' => $interest, 'message' => 'Interest created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'interest creation Failed!'.$e, 'status' => false], 500);
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
       $interest = Interest::findOrFail($id);
         if($interest) return response()->json(['interest' => $interest], 200);
        }       
         catch(\Exception $e){
            return response()->json(['error' => 'not found'], 500);  
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $this->validate($request, [
            'interest' => 'required|string'
        ]);

        try {
            $interest = Interest::findOrFail($id);
            $interest->interest = $request->input('interest');
            $interest->save();
            return response()->json(['interest' => $interest, 'message' => 'Interest created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'interest creation Failed!', 'status' => false], 500);
        }
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
            $interest = Interest::findOrFail($id);
            $interest->delete();
            if($interest){                
                return response()->json(['message'=> 'interest deleted successfully'], 200);  
            } else {
                return response()->json(['message'=> 'Not found', 'status' => true], 200);  
            }
        }
        catch(\Exception $e){
            return response()->json(['error' => 'not found went', 'status' => false], 500);

        }
    }
}
