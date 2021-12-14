<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Events::all();
        return response()->json([
            'data' => $events,
            'status' => 'success',
            'message' => 'Events retrieved successfully'
        ], 200);
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
            'title' => 'required|string',
            'price' => 'string',
            'eventType' => 'required|string',
            'discount' => 'string',
            'start' => 'required|string',
            'end' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'address' => 'required|string',
            'time' => 'required|string',
            // 'session' => 'required|string',
            // 'multiple' => 'string',
             'video' => 'required|string',
        ]);

            $user = Auth::user();

        try {
            $event = new Events;
            $event->title = $request->input('title');
            $event->about = $request->input('about');
            $event->description = $request->input('description');
            $event->price = $request->input('price');
            $event->eventType = $request->input('eventType');
            $event->discount = $request->input('discount');
            $event->start = $request->input('start');
            $event->end = $request->input('end');
            $event->city = $request->input('city');
            $event->country = $request->input('country');
            $event->address = $request->input('address');
            $event->time = $request->input('time');
            $event->session = $request->input('session');
            // $event->multiple = $request->input('multiple');
             $event->video = $request->input('video');
            $event->user_id = $user;
            $event->save();

            return response()->json([
                'message' => 'Event created successfully',
                'data' => $event,
                'status' => true
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Event creation Failed!'.$e,
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
        $event = Events::findOrFail($id);
        if($event) return response()->json([
            'data' => $event,
            'status' => true,
            'message' => 'event retrieved successfully'
        ], 200);
        }
         catch(\Exception $e){
            return response()->json([
                'message' => 'Something went wrong',
                'status' => true
            ], 500);
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
            'title' => 'required|string|min:4',
            // 'about' => 'required|string|',
            // 'description' => 'required|string|',
            // 'price' => 'string',
            // 'eventType' => 'required|string',
            // 'discount' => 'string',
            // 'start' => 'required|string',
            // 'end' => 'required|string',
            // 'city' => 'required|string',
            // 'country' => 'required|string',
            // 'address' => 'required|string',
            // 'time' => 'required|string',
            // 'session' => 'required|string',
            // // 'multiple' => 'string',
            // 'video' => 'required|string',
        ]);
        try {
            $event = Events::findOrFail($id);
            $event->title = $request->input('title');
            $event->about = $request->input('about');
            $event->description = $request->input('description');
            $event->price = $request->input('price');
            $event->eventType = $request->input('eventType');
            $event->discount = $request->input('discount');
            $event->start = $request->input('start');
            $event->end = $request->input('end');
            $event->city = $request->input('city');
            $event->country = $request->input('country');
            $event->address = $request->input('address');
            $event->time = $request->input('time');
            $event->session = $request->input('session');
            // $event->multiple = $request->input('multiple');
            $event->video = $request->input('video');
            $event->save();

            return response()->json([
                'data' => $event,
                'message' => 'Event updated successfully',
                'status' => true
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Event creation Failed!',
                'status' => false
            ], 500);
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
            $event = Events::findOrFail($id);
            $event->delete();
            if($event){
                return response()->json([
                    'message' => 'Event deleted successfully',
                    'status' => true
                ], 200);
            } else {
                return response()->json([
                    'message'=> 'Not found',
                    'status' => true
                ], 200);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Something went wrong!',
                'status' => false
            ], 500);
        }
    }

    /**
     * fetch user created events
     */
    public function userEvents ()
    {
         $event = Events::where('user_id', Auth::user()->id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $event
        ]);
    }
}
