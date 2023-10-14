<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('event.index', [
            'events' => Event::orderBy('event_date')->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $validations = $request->validate([
            'event_name' => 'required',
            'event_date' => 'required',
            'event_location' => 'required',
            'event_description' => 'required',
        ]);


        if (Event::create($validations)) {
            $msg = ['msg' => 'Event successfully created', 'msg_class' => 'success', 'msg_highlight' => 'Succeed'];
        } else {
            $msg = ['msg' => 'Event failed to create', 'msg_class' => 'danger', 'msg_highlight' => 'Failed'];
        }

        return redirect('/event')->with($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('event.edit', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $validations = $request->validate([
            'event_name' => 'required',
            'event_date' => 'required',
            'event_location' => 'required',
            'event_description' => 'required',
        ]);


        if (Event::where('id',$event->id)->update($validations)) {
            $msg = ['msg' => 'Event successfully updated', 'msg_class' => 'success', 'msg_highlight' => 'Succeed'];
        } else {
            $msg = ['msg' => 'Event failed to update', 'msg_class' => 'danger', 'msg_highlight' => 'Failed'];
        }

        return redirect('/event')->with($msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if (Event::destroy($event->id)) {
            $msg = ['msg' => 'Event successfully deleted', 'msg_class' => 'success', 'msg_highlight' => 'Succeed'];
        } else {
            $msg = ['msg' => 'Event failed to delete', 'msg_class' => 'danger', 'msg_highlight' => 'Failed'];
        }
        return redirect('/event')->with($msg);
    }
}
