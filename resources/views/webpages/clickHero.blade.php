
@extends('layouts.defaultLayout')

    @section('header')
    @endsection
        
    @section('mainContent')
        <h1>Click Hero!</h1>
        @php
            $user = auth()->user();
        @endphp

        @if ($user)
            <div id="gameBorder">
                {{-- <div id="gameContent"> --}}
                    <div id="clicker-hero-root"></div>
                    
                    
                {{-- </div> --}}
            </div>
        @endif
        @if (!$user)
            <p class="text-center">Please log in to play the game.</p>
        @endif
    @endsection
