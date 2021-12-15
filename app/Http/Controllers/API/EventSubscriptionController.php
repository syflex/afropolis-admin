<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EventSubscription;


class EventSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
        $eventSubscription = EventSubscription::all();
        if($eventSubscription) return response()->json([
            'data' => $eventSubscription,
            'status' => true,
            'message' => 'eventSubscription retrieved successfully'
        ]);
        }
         catch(\Exception $e){
            return response()->json([
                'message' => 'Something went wrong'.$e,
                'status' => true
            ], 500);
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $checkStatus = EventSubscription::where('user_id', '=', (Auth::user()->id))
        ->where('event_id', $request->event_id)
        ->where('isSubscribe', $request->subscribe)->count();

         if(!$checkStatus){
                $sub = new EventSubscription([
                    'user_id' => Auth::user()->id,
                    'isSubscribe' => $request->subscribe,
                    'event_id' => $request->event_id,
                    "email" => Auth::user()->email,
                    "name" => Auth::user()->name,
                ]);
                $sub->save();
                $message = 'subscribed';
            }else{
                $sub = EventSubscription::where('user_id', (Auth::user()->id))->where('event_id', $request->event_id);
                $sub->delete();
                $message = 'unsubscribe';
            }
            
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $sub
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
