@extends('layouts.defaultLayout')
@section('mainContent')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
<div class="uiverse__login-form-container">
    <div class="uiverse__login-form-card">

        <form method="POST"
              action="{{ route('login') }}"
              class="uiverse__login-form"
              novalidate>

            @csrf

            <p class="uiverse__login-form-heading">Login</p>

            {{-- Email --}}
            <div class="uiverse__login-form-field @error('email') uiverse__login-form-field--error @enderror">
                <svg class="uiverse__login-form-icon"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 16 16">
                        <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643z"/>

                </svg>

                <input type="email"
                       name="email"
                       placeholder="Email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       class="uiverse__login-form-input">
            </div>

            @error('email')
                <div class="uiverse__login-form-error">{{ $message }}</div>
            @enderror


            {{-- Password --}}
            <div class="uiverse__login-form-field @error('password') uiverse__login-form-field--error @enderror">
                <svg class="uiverse__login-form-icon"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                </svg>

                <input type="password"
                       name="password"
                       placeholder="Password"
                       required
                       class="uiverse__login-form-input">
            </div>

            @error('password')
                <div class="uiverse__login-form-error">{{ $message }}</div>
            @enderror


            {{-- Remember --}}
            <div class="uiverse__login-form-checkbox-group">
            
                <label class="uiverse__checkbox">
                    <input type="checkbox" name="remember" id="remember">
                
                    <div class="uiverse__checkbox-frame">
                        <div class="uiverse__checkbox-box">
                            <div class="uiverse__checkbox-check-container">
                                <svg viewBox="0 0 24 24"
                                     class="uiverse__checkbox-check">
                                    <path d="M3,12.5l7,7L21,5"></path>
                                </svg>
                            </div>
                            <div class="uiverse__checkbox-glow"></div>
                        </div>
                    </div>
                </label>
            
                <label for="remember" style="margin-left: 16px;">
                    Remember me
                </label>
            
            </div>


            {{-- Buttons --}}
            <div class="uiverse__login-form-buttons">

                <div class="uiverse__login-form-buttons-row">
                    <button type="submit"
                            class="uiverse__login-form-btn uiverse__login-form-btn--primary">
                        Login
                    </button>
                    <a href="{{ route('register') }}"
                        class="uiverse__login-form-btn uiverse__login-form-btn--secondary text-decoration-none">
                            Sign Up
                    </a>
                </div>
                <a href="{{ route('password.request') }}"
                   class="uiverse__login-form-btn uiverse__login-form-btn--danger text-decoration-none">
                    Forgot Password
                </a>

            </div>

        </form>

    </div>
</div>
@endsection
