<!-- Edit Posts -->
@extends('layouts.defaultLayout')

    @section('header')
        <h1>Edit Posts</h1>
        <!-- include sidemenu below -->
    @endsection
        <form method="POST" action="{{ route('posts.update', $post->id) }}">
            @csrf
            @method('PUT')

            <label>Title: </label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}">

            <label>Body: </label>
            <textarea name="body">{{ old('body', $posts->body) }}</textarea>

            <button type="submit">Update</button>
        </form>

        @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        
        @endif

    @section('mainContent')

    @endsection
