<!-- Posts File -->
@extends('layouts.defaultLayout')

    @section('header')

    @endsection
        
    @section('mainContent')

        <h1>All Posts!</h1>

        <!-- Create Posts -->
        <button><a href="{{ route('posts.create') }}">Create New Post</a></button>

        <!-- Read Posts -->
        @foreach($posts as $post)
            <div>
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->body }}</p>
                <button style="display:inline"><a href="{{ route('posts.edit', $post->id) }}">Edit</a></button>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                </form>
            </div>
        @endforeach

    @endsection
