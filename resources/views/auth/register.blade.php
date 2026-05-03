@extends('layouts.defaultLayout')

@section('title', 'Register')

@section('mainContent')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
<div class="uiverse__login-form-container">
    <div class="uiverse__login-form-card">

        <form method="POST"
              action="{{ route('register') }}"
              class="uiverse__login-form"
              novalidate>

            @csrf

            <p class="uiverse__login-form-heading">Register</p>

            {{-- Name --}}
            <div class="uiverse__login-form-field">
                <input id="name"
                       type="text"
                       name="name"
                       placeholder="Full Name"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       autocomplete="name"
                       class="uiverse__login-form-input">
            </div>

            @error('name')
                <div class="uiverse__login-form-error">{{ $message }}</div>
            @enderror


            {{-- Email --}}
            <div class="uiverse__login-form-field">
                <input id="email"
                       type="email"
                       name="email"
                       placeholder="Email Address"
                       value="{{ old('email') }}"
                       required
                       autocomplete="username"
                       class="uiverse__login-form-input">
            </div>

            @error('email')
                <div class="uiverse__login-form-error">{{ $message }}</div>
            @enderror


            {{-- Password --}}
            <div class="uiverse__login-form-field">
                <input id="password"
                       type="password"
                       name="password"
                       placeholder="Password"
                       required
                       autocomplete="new-password"
                       class="uiverse__login-form-input">
            </div>

            @error('password')
                <div class="uiverse__login-form-error">{{ $message }}</div>
            @enderror


            {{-- Confirm Password --}}
            <div class="uiverse__login-form-field">
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       placeholder="Confirm Password"
                       required
                       autocomplete="new-password"
                       class="uiverse__login-form-input">
            </div>

            @error('password_confirmation')
                <div class="uiverse__login-form-error">{{ $message }}</div>
            @enderror


            {{-- Buttons --}}
            <div class="uiverse__login-form-buttons">

                <button type="submit"
                        class="uiverse__login-form-btn uiverse__login-form-btn--primary">
                    Register
                </button>

                <a href="{{ route('login') }}"
                   class="uiverse__login-form-btn uiverse__login-form-btn--secondary text-decoration-none">
                    Login to Account
                </a>

            </div>

        </form>

    </div>
</div>
@endsection
