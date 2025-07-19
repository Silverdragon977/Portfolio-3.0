@extends('layouts.defaultLayout')

@section('title', 'Register')

@section('mainContent')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="formContainer table-responsive">
        <h2>Register</h2><br><br>
        <table class="table authTable">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <tr class="d-block d-sm-table-row">
            <!-- Name -->
                <th class="d-block d-sm-table-cell text-start">
                    <label for="name">Name: </label><br />
                </th>
                <td class="d-block d-sm-table-cell">
                    <input class="" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                    @error('name')
                        <div>{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr class="d-block d-sm-table-row">
            <!-- Email Address -->
                <th class="d-block d-sm-table-cell text-start">
                    <label for="email">Email: </label><br />
                </th>
                <td class="d-block d-sm-table-cell">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr class="d-block d-sm-table-row">
            <!-- Password -->
                <th class="d-block d-sm-table-cell text-start">
                    <label for="password">Password: </label><br />
                </th>
                <td class="d-block d-sm-table-cell">
                    <input id="password" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <div>{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr class="d-block d-sm-table-row">
            <!-- Confirm Password -->
                <th class="d-block d-sm-table-cell text-start">
                    <label for="password_confirmation">Confirm Password: </label><br />
                </th>
                <td>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                    @error('password_confirmation')
                        <div style="color: red; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr class="d-block d-sm-table-row">
                <th class="d-block d-sm-table-cell text-start">
                </th>
                <td>
                    <button type="submit">
                        Register
                    </button>
                </td>
            </tr>
        </form>
        </table>
        <p style="margin-top: 1rem;">
            Already registered?
        </p>
        <a href="{{ route('login') }}">Login here</a>
    </div>
@endsection
