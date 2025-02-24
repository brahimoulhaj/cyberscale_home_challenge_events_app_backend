<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('JoinEvent.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('JoinEvent.{id}.{event}', function ($user, $id, $event) {
    return (int) $user->id === (int) $id;
});
