<!DOCTYPE html>
<html>

<head>
    <title>Ticket Status Changed</title>
</head>

<body>
    @if ($status == 'closed')
        <h1>Your ticket has been closed</h1>
    @elseif($status == 'open')
        <h1>Your ticket has been reopened</h1>
    @endif

    <p>Subject: {{ $ticket->subject }}</p>
    <p>Status: {{ ucfirst($status) }}</p>
</body>

</html>
