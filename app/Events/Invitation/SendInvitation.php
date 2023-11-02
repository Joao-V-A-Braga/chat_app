<?php

namespace App\Events\Invitation;

use App\Models\ChatInvitation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendInvitation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ChatInvitation $invitation
     */
    private $invitation;

    /**
     * Create a new event instance.
     */
    public function __construct(ChatInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('send_invitation_to.'.$this->invitation->destiny),
        ];
    }

    public function broadcastAs()
    {
        return 'SendInvitation';
    }

    public function broadcastWith()
    {
        return [
            'invitation' => $this->invitation,
            'sender' => $this->invitation->senderUser()->first()
        ];
    }
}
