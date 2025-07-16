<!-- Create Posts File           ---->
<!-- I need a new layout for login -->
@extends('layouts.defaultLayout')

    @section('header')
        <h1>Create Your Post!</h1>
        <!-- include sidemenu below -->
    @endsection
        
    @section('mainContent')
                <!-- <a href="{{ route("testpage") }}">Go to test page</a>  Laravel Link with a name-->
        <br><br><br>
        <!-- post.store is a method in the PostController.php -->
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf <!-- Cross-site forgery protection from laravel -->

            <label>Title: </label><br>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required><br>

            <label>Body: </label><br>
            <textarea name="body">{{ old('body') }}</textarea>

            <button type="submit">Submit</button>

        </form>

        @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        
        @endif


    @endsection
