
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
                <div id="gameContent">
                    <p>Game coming soon!</p>
                </div>
            </div>
        @else
            <p>Hello Guest!</p>
        @endif




    @endsection
