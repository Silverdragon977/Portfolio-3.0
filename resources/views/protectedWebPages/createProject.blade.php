@extends('layouts.defaultLayout')

    @section('header')
    @endsection
        
    @section('mainContent')
        <h1>Admin Page</h1>
        <h2>Create Project:</h2>
        <div>
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div>
        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        </div>
        <form method="post" action="{{route('admin.projects.store')}}">
            @csrf
            @method('post')
            <!-- To submit form we need a Route::post() -->
            <div>
                <label>*Title:</label>
                <input type="text" name="title" required>
            </div>
            <div>
                <label>*Languages Used:</label>
                <input type="text" name="languages" required>
            </div>
            <div>
                <label>*Github Link:</label>
                <input type="text" name="github_link" required>
            </div>
            <div>
                <label>*Full description:</label>
                <input type="text" name="full_description" required>
            </div>
            <div>
                <label>*Summary:</label>
                <input type="text" name="short_description" required>
            </div>
            <div>
                <input type="submit" value="Save">
            </div>
        </form>
    @endsection
