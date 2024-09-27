<!DOCTYPE html>
<html>

<head>
    <title>New Ticket Created</title>
</head>

<body>
    <h1>A new ticket has been created</h1>
    <p>Subject: {{ $ticket->subject }}</p>
    <p>Description: {{ $ticket->description }}</p>
    <p>Created by: {{ $ticket->user->name }}</p>
</body>

</html>
