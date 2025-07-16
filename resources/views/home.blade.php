<!-- No longer used -->
@extends('layouts.defaultLayout')

    @section('header')
        <h1>Header!</h1>
        <!-- include sidemenu below -->
        @include('sidemenu')
    @endsection

    @section('mainContent')

        <a href="{{ route("testpage") }}">Go to test page</a> <!-- Laravel Link with a name-->
        <br><br><br>
        <form action="{{route("formSubmitted")}}" method="post">
            @csrf <!-- Cross-site forgery protection from laravel -->
            <label for="Email">Email: </label><br>
            <input type="text" id="Email" name="Email" placeholder="Email" required><br>

            <label for="Password">Password: </label><br>
            <input type="text" id="Password" name="Password" placeholder="Password" required><br><br>
            <button type="submit">Submit</button>

        </form>
    @endsection

    @section('footer')
        <h2>This is the footer!</h2>
    @endsection