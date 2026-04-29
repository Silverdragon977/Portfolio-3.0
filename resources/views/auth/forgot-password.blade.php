{{--  Tailwind css version incase I switch back or something 


<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.defaultLayout')

@section('mainContent')
<div class="container py-5" style="max-width: 500px;">

    <h3 class="mb-4">Forgot Password</h3>

    <p class="text-muted">
        Enter your email address and we’ll send you a password reset link.
    </p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label>Email Address</label>
            <input 
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control"
                required
                autofocus
            >

            @error('email')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">
                Send Reset Link
            </button>
        </div>

    </form>

</div>
@endsection