<x-app-layout>
    <div class="container mt-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <h2 class="mb-3 mb-md-0">Tickets</h2>

            <a href="{{ route('user.tickets.create') }}" class="btn btn-primary">Create</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ Str::limit($ticket->description, 50) }}</td>
                            <td>{{ ucfirst($ticket->status) }}</td>
                            <td>{{ $ticket->created_at ? $ticket->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('user.tickets.show', $ticket->id) }}"
                                    class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No tickets found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
