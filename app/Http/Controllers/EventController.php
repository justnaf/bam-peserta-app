<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\ModelActiveEvent;
use App\Models\ModelHasRestroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeEvent = ModelActiveEvent::where('user_id', Auth::id())->whereHas('event', function ($query) {
            $query->where('status', '!=', 'done');
        })->with(['user', 'event.sesi'])->first();
        if ($activeEvent) {
            $sesi = $activeEvent->event->sesi;
            $roomEvent = ModelHasRestroom::where('user_id', Auth::id())->where('event_id', $activeEvent->event_id)->first();
            return view('event.index', compact(['activeEvent', 'event', 'roomEvent', 'sesi']));
        }
        $event = Event::where('status', 'registration')->get();

        return view('event.index', compact(['activeEvent', 'event']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
