<?php

namespace App\Http\Controllers\Admin;

use App\Events\TicketMessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $messages = Message::where('ticket_id', $ticket->id)->get();

        return view('admin.tickets.show', compact('ticket', 'messages'));
    }

    public function open(Ticket $ticket)
    {
        $ticket->status = 'open';
        $ticket->save();
        return redirect()->route('admin.tickets.show', $ticket->id)->with('success', 'ticket re-opened successfully');
    }

    public function close(Ticket $ticket)
    {
        $ticket->status = 'closed';
        $ticket->save();
        return redirect()->route('admin.tickets.show', $ticket->id)->with('success', 'ticket closed successfully');
    }

    public function sendMessage(Request $request, $ticketId)
    {
        $message = Message::create([
            'ticket_id' => $ticketId,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        TicketMessageSent::dispatch($message);

        return response()->json(['status' => 'Message sent!']);
    }
}
