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
                @endif
            </div>
            <div>
                @if(session()->has('success'))
                    <div>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <h2>Projects</h2>
                <a href="{{ route('admin.createProject') }}"><button type="button">Create Project</button></a>
        <!----  Projects Section  ----->  
            <div id="ProjectsTableAdmin" class="table-responsive">
                <table class="table table-hover table-dark table-striped table-sm w-100">
                    <tr>
                        <th>Title</th>
                        <th>Languages</th>
                        <th>Github Link</th>
                        <th>Summary</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->languages }}</td>
                            <td><a href="{{ $project->github_link }}"><button type="button">View on Github</button></a></td>
                            <!-- <td>{{ $project->full_description }}</td> ## Too long and is a README available on github -->
                            <td>{{ $project->short_description }}</td>
                            <td><a href="{{ route('admin.editProject', ['project' => $project]) }}"><button type="button">Edit</button></a></td>
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
        <!----------------------------->
        <!----  Comments Section  ----->
        <br>
        <h2>Comments</h2>
            <div id="CommentsTableAdmins" class="table-responsive">
                <table class="table table-hover table-dark table-striped table-sm w-100">
                    <tr>
                        <th>Comment</th>
                    <!-- <th>Email</th> These will come from users table     -->
                    <!-- <th>Name</th>                                       -->

                    </tr>
                    <!-- @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->languages }}</td>
                            <td><a href="{{ $project->github_link }}"><button type="button">View on Github</button></a></td>
                            <!-- <td>{{ $project->full_description }}</td> ## Too long and is a README available on github --><!--
                            <td>{{ $project->short_description }}</td>
                            <td><a href="{{ route('admin.editProject', ['project' => $project]) }}"><button type="button">Edit</button></a></td>
                            <td>
                                <form method="post" action="{{ route('admin.deleteProject', ['project' => $project]) }}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach -->
                </table>
            </div>
        <!----------------------------->



        </div>
        <div id="commentsSection">

        </div>
        <div id="usersSection">

        </div>
    @endsection