<div class="container">
    <div class="mb-4">
        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
    
        <table class="table auth-table table-bordered table-striped-columns ">
            <!-- Email Address -->
            <tr>
                <td class="pr-4 py-2">
                    <label for="email">{{ __('Email') }}</label>
                </td>
                <td class="py-2">
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <!-- Password -->
            <tr>
                <td class="pr-4 py-2">
                    <label for="password">{{ __('Password') }}</label>
                </td>
                <td class="py-2">
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <!-- Remember Me -->
            <tr>
                <td class="pr-4 py-2 align-top">{{ __('Remember me') }}</td>
                <td class="py-2">
                    <div class="form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label"></label>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Actions -->
        <div class="d-flex justify-content-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-decoration-underline text-muted me-3" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-primary ms-3">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</div>