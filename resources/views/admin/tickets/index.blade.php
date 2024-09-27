<x-admin-layout>
    <div class="container mt-5">

        <h2 class="mb-3 mb-md-0">Tickets</h2>


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
                                <a href="{{ route('admin.tickets.show', $ticket->id) }}"
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
</x-admin-layout>
