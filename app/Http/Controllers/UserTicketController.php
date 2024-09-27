<?php

namespace App\Http\Controllers;

use App\Events\TicketMessageSent;
use App\Mail\UserTicketCreated;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->get();
        return view('user.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('user.tickets.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);

        $adminUser = User::where('role', 'admin')->get();

        foreach ($adminUser as $admin) {
            Mail::to($admin->email)->send(new UserTicketCreated($ticket));
        }


        return redirect()->route('user.tickets.show', ['ticket' => $ticket->id]);
    }

    public function show($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $messages = Message::where('ticket_id', $ticket->id)->get();

        return view('user.tickets.show', compact('ticket', 'messages'));
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
