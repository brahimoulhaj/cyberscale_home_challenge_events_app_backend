<?php

namespace App\Http\Controllers;

use App\Events\UserJoinAnEvent;
use App\Models\Event;
use App\Notifications\JoinEvent;
use Illuminate\Http\Request;

class JoinEventController extends Controller
{
    public function __invoke(Request $request, Event $event)
    {
        if ($event->max_participants <= $event->participants()->count()) {
            return response()->json([
                'success' => false,
                'message' => 'Event is full',
            ]);
        }

        if ($event->host->is($request->user())) {
            return response()->json([
                'success' => false,
                'message' => 'You are the host of this event',
            ]);
        }

        if ($event->participants()->where('user_id', $request->user()->id)->exists()) {
            $event->participants()->detach($request->user()->id);

            return response()->json([
                'success' => true,
                'message' => "You left '".$event->title."' event",
            ]);
        }

        $event->participants()->attach($request->user()->id);
        $event->host->notify(new JoinEvent(event: $event, participant: $request->user()));

        broadcast(new UserJoinAnEvent($event, $request->user()));

        return response()->json([
            'success' => true,
            'message' => "You joined '".$event->title."' event successfully.",
        ]);
    }
}
