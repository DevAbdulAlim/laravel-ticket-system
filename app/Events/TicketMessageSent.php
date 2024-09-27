<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TicketMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messageContent;
    public $userName;
    public $ticketId;

    /**
     * Create a new event instance.
     */
    public function __construct($message)
    {
        // Extracting only the necessary data to broadcast
        $this->messageContent = $message->message;
        $this->userName = $message->user->name;
        $this->ticketId = $message->ticket_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('ticket.' . $this->ticketId);
    }

    /**
     * Custom broadcast event name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'ticket.message.sent';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'messageContent' => $this->messageContent,
            'userName' => $this->userName,
        ];
    }
}
