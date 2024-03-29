<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Collection::with('user')
        ->get();
        return response()->json([
            'status' => 'successful',
            'message' => 'collections fetched successfully',
            'data' => $collection,
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
        $this->validate($request, [
            'name' => 'string',
        ]);

        $user = Auth::user();

        try {
            $collection = new Collection;
            $collection->name = $request->input('name');
            $collection->description = $request->input('description');
            $collection->image = $request->input('image');
            $collection->user_id = $user->id;
            $collection->save();

            return response()->json([
                'data' => $collection,
                'message' => 'collection created successfully',
                'status' => true],
            201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Post creation Failed!'.$e,
                'status' => false]
            , 500);
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
            $collection = Collection::with('user')->findOrFail($id)
            ->with('user')
            ->get();
            if($collection) return response()->json([
                'data' => $collection,
                'message' => 'collection fetched successfully',
                'status' => true,
            ]);
        }
         catch(\Exception $e){
            return response()->json([
                'error' => 'Something went wrong',
                'status' => false
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
            $collection = Collection::findOrFail($id);
            $collection->delete();
            if($collection){
                return response()->json([
                    'message' => 'collection deleted successfully',
                    'status' => true
                ], 200);
            } else {
                return response()->json([
                    'message'=> 'Not found',
                    'status' => true
                ], 404);
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
