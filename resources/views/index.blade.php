<!-- // HomePage -->
@extends('layouts.defaultLayout')

    @section('header')
        
    @endsection
        
    @section('mainContent')

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
