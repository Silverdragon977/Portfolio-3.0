@extends('layouts.defaultLayout')


@section('header')
@endsection
        
@section('mainContent')

    <div class="container mt-4">

        <h2>Clicker Hero Stats</h2>

        <div class="card p-3 mb-3">
            <h5>User Info</h5>
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        <div class="card p-3">
            <h5>Game Data</h5>

            @if($clickerData)
                <p><strong>Score:</strong> {{ $clickerData->score }}</p>
                <p><strong>Multiplier:</strong> {{ $clickerData->multiplier }}</p>
                <p><strong>Passive Level:</strong> {{ $clickerData->passive_income_level }}</p>
                <p><strong>Prestige Level:</strong> {{ $clickerData->prestige_level }}</p>
                <p><strong>Background:</strong> {{ $clickerData->background_color }}</p>
                <p><strong>Frame:</strong> {{ $clickerData->frame_choice }}</p>
            @else
                <p>No Clicker Hero data found for this user.</p>
            @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
            @endif

            <form method="POST"
                  action="{{ route('admin.users.games.clicker.reset', $user->id) }}">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Reset Clicker Stats
                </button>
            </form>
        </div>
    </div>
@endsection 

