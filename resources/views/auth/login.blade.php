<x-guest-layout>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form method="POST" action="{{ route('login') }}" class="w-100" style="max-width: 400px;">
            <h2 class="text-center mb-4">Login</h2>
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="password">
            </div>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
            <div class="mb-3">Don't have an acount?
                <a href="{{ route('register') }}">register</a>
            </div>
        </form>
    </div>
</x-guest-layout>
