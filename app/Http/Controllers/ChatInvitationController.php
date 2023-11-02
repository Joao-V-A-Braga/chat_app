<?php

namespace App\Http\Controllers;

use App\Events\Invitation\AcceptInvitation;
use App\Events\Invitation\SendInvitation;
use App\Models\Chat;
use App\Models\ChatInvitation;
use App\Models\User;
use App\Models\UsersChats;
use App\Models\UsersChatsConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class ChatInvitationController extends Controller
{
    public function new(User $user)
    {
        $has = ChatInvitation::query()->where('sender', auth()->user()->id)->where('destiny', $user->id)->get();

        if ($has->containsOneItem())
            return response()->json('Você já enviou um convite a este usuário.', 400);

        $chat = new Chat();
        $chat->type = "DUAL";
        $chat->save();

        $chatInvitation = new ChatInvitation();
        $chatInvitation->chat_id = $chat->id;
        $chatInvitation->active = true;
        $chatInvitation->sender = auth()->user()->id;
        $chatInvitation->destiny = $user->id;
        $chatInvitation->save();
        Event::dispatch(new SendInvitation($chatInvitation));
        return response()->json('Convite enviado com sucesso.', 200);
    }

    public function acceptInvitation(ChatInvitation $chatInvitation)
    {
        $destiny = $chatInvitation->destinyUser()->first();
        $sender = $chatInvitation->senderUser()->first();

        $chatInvitation->active = false;
        $chat = $chatInvitation->chat()->first();
        $destinyUserChat = $this->newUserChat($destiny, $chat);
        $senderUserChat = $this->newUserChat($sender, $chat);
        $chatInvitation->save();

        Event::dispatch(new AcceptInvitation($senderUserChat, $destinyUserChat, "Aceitou o seu convite!!"));
        Event::dispatch(new AcceptInvitation($destinyUserChat, $senderUserChat, "Você aceitou o convite."));

        return response()->json('Convite aceito com sucesso.', 200);
    }

    public function refuseInvitation(ChatInvitation $chatInvitation)
    {
        $chatInvitation->active = false;
        $chatInvitation->save();

        return response()->json('Convite recusado com sucesso.', 200);
    }

    private function newUserChat(User $user, Chat $chat)
    {
        $userChat = new UsersChats();
        $userChat->user_id = $user->id;
        $userChat->chat_id = $chat->id;

        $userChatConfiguration = new UsersChatsConfiguration();
        $userChatConfiguration->save();

        $userChat->users_chats_configuration_id = $userChatConfiguration->id;
        $userChat->save();

        return $userChat;
    }
}
