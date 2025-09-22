
@extends('layouts.defaultLayout')

    @section('header')
    @endsection
        
    @section('mainContent')
        <h1>Contact</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <div>
            <label for="comment">Your Message:</label>
            <textarea id="comment" name="comment" required>{{ old('comment') }}</textarea>
            @error('comment')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Send</button>
    </form>
    @endsection
