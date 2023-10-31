<?php

namespace App\Http\Controllers;

use App\Models\ChatInvitation;
use App\Models\User;
use App\Models\UsersChats;

class ChatController extends Controller
{
    public function index() {

        /** @var User $user */
        $userId = auth()->user()->id;
        $chats = UsersChats::where('user_id', $userId)->select('chat_id')->get();

        $userChats = UsersChats::query()
            ->where('user_id', '!=', $userId)
            ->whereIn('chat_id', $chats);

        $chatInvitations = ChatInvitation::where('destiny', $userId);

        $selected = request()->get('selected') ? UsersChats::find(request()->get('selected')) : (($userChats->get()->count())?$userChats->get()[0]:null);

        return view('chats', ['chats' => $userChats->get(), 'invitations' => $chatInvitations->get(), 'selected' => $selected]);
    }
}
