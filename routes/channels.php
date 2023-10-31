<?php

use Illuminate\Support\Facades\Broadcast;
use \App\Models\UsersChats;
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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('message_to_chat.{id}', function ($user, $id) {
    $userChat = UsersChats::where('user_id', $user->id)->where('chat_id', $id)->first();

    return (int) $userChat->user_id === (int) $user->id;
});
