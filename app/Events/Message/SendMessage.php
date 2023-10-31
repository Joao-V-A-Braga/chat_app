<?php

namespace App\Events\Message;

//use Illuminate\Broadcasting\Channel;
use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Message $message
     */
    private $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {
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
            new PrivateChannel('message_to_chat.'.$this->message->chat_id),
        ];
    }

    public function broadcastAs()
    {
        return 'SendMessage';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message
        ];
    }
}
