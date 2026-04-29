@extends('layouts.defaultLayout')

@section('mainContent')

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                required autofocus autocomplete="username"
                class="form-control"
            />
            @error('email')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                required autocomplete="new-password"
                class="form-control"
            />
            @error('password')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required autocomplete="new-password"
                class="form-control"
            />
            @error('password_confirmation')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">
                Reset Password
            </button>
        </div>
    </form>
@endsection