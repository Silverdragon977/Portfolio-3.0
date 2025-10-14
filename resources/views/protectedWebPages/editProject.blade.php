@extends('layouts.defaultLayout')

    @section('header')
    @endsection
        
    @section('mainContent')
        <h1>Admin Page</h1>
        <h2>Edit Project:</h2>
        <div>
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <form method="post" action="{{ route('admin.projects.edit', ['project' => $project]) }}">
            @csrf
            @method('put')
            <!-- To submit form we need a Route::post() -->
            <div>
                <label>*Title:</label>
                <input type="text" name="title" value="{{ $project->title }}" required>
            </div>
            <div>
                <label>*Languages Used:</label>
                <input type="text" name="languages" value="{{ $project->languages }}" required>
            </div>
            <div>
                <label>*Github Link:</label>
                <input type="text" name="github_link" value="{{ $project->github_link }}" required>
            </div>
            <div>
                <label>*Full description:</label>
                <input type="text" name="full_description" value="{{ $project->full_description }}" required>
            </div>
            <div>
                <label>*Summary:</label>
                <input type="text" name="short_description" value="{{ $project->short_description }}" required>
            </div>
            <div>
                <input type="submit" value="Update">
            </div>
        </form>
    @endsection
