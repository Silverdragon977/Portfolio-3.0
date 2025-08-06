@extends('layouts.defaultLayout')

    @section('header')
    @endsection
        
    @section('mainContent')
        <h1>Admin Page</h1>
        <div id="projectsSection">
            <div>
                @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                @if(session()->has('sucess'))
                    <div>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
                <button><a href="{{ route('admin.createProject') }}">Create Project</a></button>
            <div>
                <table border="1">
                    <tr>
                        <th>Title</th>
                        <th>Languages</th>
                        <th>Github Link</th>
                        <th>Description</th>
                        <th>TLDR</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->languages }}</td>
                            <td>{{ $project->github_link }}</td>
                            <td>{{ $project->full_description }}</td>
                            <td>{{ $project->short_description }}</td>
                            <td><a href="{{ route('admin.editProject', ['project' => $project]) }}"></a></td>
                            <td>
                                <form method="post" action="{{ route('admin.deleteProject', ['project' => $project]) }}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>

                    @endforeach
                </table>
            </div>
        </div>
        <div id="commentsSection">

        </div>
        <div id="usersSection">

        </div>
    @endsection