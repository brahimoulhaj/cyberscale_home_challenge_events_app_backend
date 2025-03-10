<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command(
    'inspire', function () {
        $this->comment(Inspiring::quote());
    }
)->purpose('Display an inspiring quote');

// Artisan::command('event:join', function () {
//     $event = App\Models\Event::find(24);
//     $user = User::inRandomOrder()->first();

//     $event->participants()->attach($user->id);
//     $this->comment("UserJoinAnEvent::class ---> JoinEvent.{$event->user_id}");

//     broadcast(new \App\Events\UserJoinAnEvent($event, $user));
// });
