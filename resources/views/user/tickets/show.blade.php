<x-app-layout>
    <div class="container mt-5">
        <h1 class="mb-4">{{ $ticket->subject }}</h1>

        <div id="messages" class="mb-4 p-3 border rounded" style="max-height: 300px; overflow-y: auto;">
            @foreach ($messages as $message)
                <div class="mb-2 p-2 bg-light rounded">
                    <strong>{{ $message->user->name }}:</strong> {{ $message->message }}
                </div>
            @endforeach
        </div>

        @if ($ticket->status === 'open')
            <div class="input-group mb-3">
                <textarea id="message-input" class="form-control" placeholder="Type your message..."></textarea>
                <button onclick="sendMessage()" class="btn btn-primary">Send</button>
            </div>
        @endif
    </div>

    <script>
        // Ensure that Vite's Echo and other assets have been loaded before this script executes
        window.addEventListener('load', function() {
            // Listen for incoming messages on the private channel
            window.Echo.private('ticket.{{ $ticket->id }}')
                .listen('.ticket.message.sent', (e) => {
                    console.log('Received broadcasted message:', e);
                    let messagesDiv = document.getElementById('messages');
                    let newMessage = document.createElement('div');
                    newMessage.classList.add('mb-2', 'p-2', 'bg-light', 'rounded');
                    newMessage.innerHTML = `<strong>${e.userName}:</strong> ${e.messageContent}`;
                    messagesDiv.appendChild(newMessage);
                    messagesDiv.scrollTop = messagesDiv.scrollHeight;
                });

            // Define the sendMessage function
            window.sendMessage = function() {
                let messageInput = document.getElementById('message-input');
                let message = messageInput.value;

                axios.post('/user/tickets/{{ $ticket->id }}/message', {
                        message: message
                    })
                    .then(response => {
                        console.log('Message sent successfully:', response.data);
                        messageInput.value = '';
                    })
                    .catch(error => {
                        console.error('Error sending message:', error);
                    });
            };
        });
    </script>
</x-app-layout>
