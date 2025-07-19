@extends('layouts.defaultLayout')
@section('mainContent')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="formContainer table-responsive">
        <h2>Login</h2><br><br>
        <table class="table authTable">
            <form id="loginTable" method="POST" action="{{ route('login') }}">
                @csrf
                <tr class="d-block d-sm-table-row">
                    <th class="d-block d-sm-table-cell text-start">
                        <label for="email">Email:</label>
                    </th>
                    <td>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')<div>{{ $message }}</div>@enderror
                    </td>
                </tr>
                <tr class="d-block d-sm-table-row">
                    <th class="d-block d-sm-table-cell text-start">
                        <label for="password">Password:</label>
                    </th>
                    <td>
                        <input id="password" type="password" name="password" required>
                        @error('password')<div>{{ $message }}</div>@enderror
                    </td>
                </tr>
                <tr class="d-block d-sm-table-row">
                    <th class="d-block d-sm-table-cell text-start">
                        <button type="submit">Login</button>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                    </td>
                </tr>
            </form>
        </table>
    </div>
@endsection
