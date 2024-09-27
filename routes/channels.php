<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('ticket.{ticketId}', function ($user, $ticketId) {
    $ticket = Ticket::find($ticketId);
    return $ticket && ($ticket->user_id === $user->id || $user->isAdmin());
});
