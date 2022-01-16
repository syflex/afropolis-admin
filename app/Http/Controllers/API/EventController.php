<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\EventSession;
use App\Models\EventAttendee;
use App\Models\EventLocation;
use App\Models\EventSubscribers;
use App\Models\EventSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Doctrine\Common\EventSubscriber;
use Illuminate\Support\Str;
use Carbon\Carbon;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Events::with('event_session')
        ->with('event_location')
        ->with('eventSubscription')
        ->with('user')
        ->get();
        return response()->json([
            'data' => $events,
            'status' => 'success',
            'message' => 'Events retrieved successfully'
        ]);
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
       $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"

        $user = Auth::user();
        $input = $request->all();
        $input['user_id'] = $user->id;
        $input['slug'] = Str::slug($request->title.'-'.$current_date_time);
        $event = Events::create($input);
        $input['event_id'] = $event->id;

        $eventId = $event->id;
         $event_location = EventLocation::create($input);
         $event_session = EventSession::create([
             'event_id' => $eventId,
             'title' => $request->title,
             'start' => $request->start,
             'end' => $request->end,
             'price' => $request->price,
             'session' => $request->session,
             'discount' => $request->discount,
             'time' => $request->time
         ]);

         
        //  $event_session = EventSession::create($request->session());
        // $event_subscribers = EventAttendee::create($request->subscribers());
        // $event_subscription =EventSubscribers::create($request->subscription());

        return response()->json([
            'message' => 'Event created successfully',
            'data' => $event,
            'status' => true
        ], 201);
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
        $event = Events::where('id',$id)
        ->with('event_session')
        ->with('event_location')
        ->with('eventSubscription')
        ->with('user')
        ->get();
        if($event) return response()->json([
            'data' => $event,
            'status' => true,
            'message' => 'event retrieved successfully'
        ]);
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
        // $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"
        // $user = Auth::user();
        // $input = $request->all();
        // // $input['user_id'] = $user->id;
        // $input['slug'] = Str::slug($request->title.'-'.$current_date_time);
        
        // try {
        //     $event = Events::findOrFail($id);
        //     $event->update($input);
        //     // $input['event_id'] = $event->id;
        //     $eventId = $event->id;
        //     $event->update($input);
        //  $event->update([
        //     //  'event_id' => $eventId,
        //      'title' => $request->title,
        //      'start' => $request->start,
        //      'end' => $request->end,
        //      'price' => $request->price,
        //      'session' => $request->session,
        //      'discount' => $request->discount,
        //      'time' => $request->time
        //  ]);

        
        // return response()->json([
        //     'message' => 'Event updated successfully',
        //     'data' => $event,
        //     'status' => true
        // ], 201);
        // } catch (\Throwable $e) {
        //     return response()->json([
        //         'message' => 'Something went wrong'.$e,
        //         'status' => true
        //     ], 500);
        // }
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

            if(!$event){
                return response()->json([
                    'message'=> 'Not found',
                    'status' => true
                ], 200);
            }

            return response()->json([
                'message' => 'Event deleted successfully',
                'status' => true
            ], 200);
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
         $event = Events::where('user_id', Auth::user()->id)
          ->with('event_session')
          ->with('event_location')
         ->with('user')->get();
        return response()->json([
            'status' => 'success',
            'data' => $event,
            'message'=> 'Fetched successfully'
        ]);
    }

    /**
     * fetch user events by is id
     */
    public function getUserEventById ($id)
    {
         $event = Events::where('user_id', $id)
          ->with('event_session')
          ->with('event_location')
         ->with('user')->get();
        return response()->json([
            'status' => 'success',
            'data' => $event,
            'message'=> 'Fetched successfully'
        ]);
    }
}
