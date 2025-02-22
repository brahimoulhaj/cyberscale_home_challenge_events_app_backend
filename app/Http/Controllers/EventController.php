<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('participants')->with('category')->paginate(10);

        return EventResource::collection($events);
    }

    public function eventsAsHost()
    {
        $events = request()->user()->eventsAsHost()->withCount('participants')->with('category')->paginate(10);

        return EventResource::collection($events);
    }

    public function eventsAsParticipant()
    {
        $events = request()->user()
            ->eventsAsParticipant()
            ->withCount('participants')
            ->with(['category', 'host'])
            ->paginate(10);

        return EventResource::collection($events);
    }

    public function show(Event $event)
    {
        $event->load(['category', 'participants', 'host'])->loadCount('participants');

        return new EventResource($event);
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create([
            ...$request->validated(),
            'slug' => str()->slug($request->title),
            'user_id' => auth()->id(),
        ]);
        // dispatch event (new event created)
        $event->load(['category', 'participants', 'host'])->loadCount('participants');

        return new EventResource($event);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        abort_if($event->host->isNot($request->user()), 403, 'Cannot update this event');
        $event->update($request->validated());
        // dispatch event (an event was updated)
        $event->load(['category', 'participants', 'host'])->loadCount('participants');

        return new EventResource($event);
    }
}
