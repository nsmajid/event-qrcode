<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Models\Event;
use App\Models\Participant;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $filters = [
            'event_id' => request()->event,
            'key' => request()->key
        ];

        return view('participant.index', [
            'participants' => Participant::filter($filters)->paginate(8)->withQueryString(),
            'events' => Event::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('participant.create', [
            'events' => Event::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreParticipantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParticipantRequest $request)
    {
        $validations = $request->validate([
            'event' => 'required',
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        unset($validations['event']);

        $validations['event_id'] = $request->event;
        $validations['uniq_code'] = $this->generateUniqueCode();


        if (Participant::create($validations)) {
            $msg = ['msg' => 'Participant successfully added', 'msg_class' => 'success', 'msg_highlight' => 'Succeed'];
        } else {
            $msg = ['msg' => 'Participant failed to add', 'msg_class' => 'danger', 'msg_highlight' => 'Failed'];
        }

        return redirect("/participant?event=$request->event")->with($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        return view("participant.show", [
            'participant' => $participant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParticipantRequest  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        if (Participant::destroy($participant->id)) {
            $msg = ['msg' => 'Participant successfully deleted', 'msg_class' => 'success', 'msg_highlight' => 'Succeed'];
        } else {
            $msg = ['msg' => 'Participant failed to delete', 'msg_class' => 'danger', 'msg_highlight' => 'Failed'];
        }
        return redirect("/participant?event=$participant->event_id")->with($msg);
    }

    private  function generateUniqueCode($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);


        $code = '';

        while (strlen($code) < $length) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }

        if (Participant::where('uniq_code', $code)->exists()) {
            $this->generateUniqueCode($length);
        }

        return $code;
    }
}
