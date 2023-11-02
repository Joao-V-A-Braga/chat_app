<?php

namespace App\Events\Invitation;

use App\Models\User;
use App\Models\UsersChats;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AcceptInvitation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var UsersChats $userChat
     */
    private $userChat;

    /**
     * @var UsersChats $destiny
     */
    private $destiny;

    /**
     * @var string $message
     */
    private $message;

    /**
     * Create a new event instance.
     */
    public function __construct(UsersChats $userChat, UsersChats $destiny, string $message)
    {
        $this->userChat = $userChat;
        $this->destiny = $destiny;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('accept_chat.'.$this->userChat->user_id),
        ];
    }

    public function broadcastAs()
    {
        return 'AcceptInvitation';
    }

    public function broadcastWith()
    {
        return [
            'userChat' => $this->userChat,
            'user' => $this->destiny->user()->first(),
            'message' => $this->message,
            'destinyUserChat' => $this->destiny
        ];
    }
}
