<x-app-layout>
    <div class="container mt-5">
        <h2>Create Ticket</h2>


        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('user.tickets.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Ticket</button>
        </form>
    </div>
</x-app-layout>
