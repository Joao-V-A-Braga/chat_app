<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatInvitation;
use App\Models\User;
use App\Models\UsersChats;
use Illuminate\Http\Request;

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

        return view('chats', ['chats' => $userChats->get(), 'invitations' => $chatInvitations->get()]);
    }
}
