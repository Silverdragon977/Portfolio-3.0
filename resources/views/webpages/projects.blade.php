
@extends('layouts.defaultLayout')

    @section('header')
    @endsection
        
    @section('mainContent')
        <h1>Projects</h1>
        <div id="ProjectsTablePublic"  class="table-responsive">
                <table class="table table-hover table-dark table-striped table-sm w-100">
                    <tr>
                        <th>Title</th>
                        <th>Languages</th>
                        <th>Github Link</th>
                        <th>Summary</th>
                    </tr>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->languages }}</td>
                            <td><a href="{{ $project->github_link }}"><button type="button">View on Github</button></a></td>
                            <!-- <td>{{ $project->full_description }}</td> ## Too long and is a README available on github -->
                            <td>{{ $project->short_description }}</td>
                        </tr>
                    @endforeach
                </table>
    @endsection
