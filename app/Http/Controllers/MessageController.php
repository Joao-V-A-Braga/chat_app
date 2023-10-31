<?php

namespace App\Http\Controllers;

use App\Events\Message\SendMessage;
use App\Models\Chat;
use App\Models\Message;
use App\Models\UsersChats;
use Illuminate\Support\Facades\Event;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    public function new(Chat $chat)
    {
        $user = auth()->user();

        $message = new Message();
        $message->chat_id = $chat->id;
        $message->user_id = $user->id;
        $message->text = request()->get('text');
        $message->save();

        Event::dispatch(new SendMessage($message));

        return response()->json('Menssagem enviada com sucesso.', 200);
    }

    public function list(Chat $chat) {
        $hasUserChat = UsersChats::where('user_id', auth()->user()->id)->where('chat_id', $chat->id)->count('id');
        if ($hasUserChat) {
            $messages = Message::where('chat_id', $chat->id)->get();

            $messagesArray = [];
            foreach ($messages as $message) {
                $messagesArray[] = [
                    ...$message->toArray()
                ];
            }
            return response()->json($messagesArray, 200);
        }

        return response()->json('Você não tem acesso a esse chat.', Response::HTTP_FORBIDDEN);
    }
}
