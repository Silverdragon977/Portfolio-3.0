@extends('layouts.defaultLayout')

    @section('header')
    @endsection
        
    @section('mainContent')
        <h1>Admin Page</h1>
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
        <div id="projectsSection">
        <!----------------------------------------------------------->
        <!----------------------------------------------------------->
        <!---------     Projects Section     ------------------------>
        <!----------------------------------------------------------->
            <h2>Projects</h2>
                <a href="{{ route('admin.projects.create') }}"><button type="button">Create Project</button></a>
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
                    @forelse($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->languages }}</td>
                            <td><a href="{{ $project->github_link }}"><button type="button">View on Github</button></a></td>
                            <!-- <td>{{ $project->full_description }}</td> ## Too long and is a README available on github -->
                            <td>{{ $project->short_description }}</td>
                            <td><a href="{{ route('admin.projects.edit', ['project' => $project]) }}"><button type="button">Edit</button></a></td>
                            <td>
                                <form method="post" action="{{ route('admin.projects.destroy', ['project' => $project]) }}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td>No Projects Available</td>
                            </tr>
                    @endforelse
                </table>
            </div>
        <!----------------------------------------------------------->
        <!----------------------------------------------------------->
        <!------------    Comments Section    ----------------------->
        <!----------------------------------------------------------->
        <br>
        <div id="CommentsTableAdmins">  {{-- class="table-responsive"--}}
            <h2>Comments</h2>
            <table class="table table-hover table-dark table-striped table-sm w-100">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Comment</th> 
                    <th>Delete</th>                                     
                </tr>
                @forelse($comments as $comment)
                    <tr>
                        <td>{{ $comment->fullName }}</td>
                        <td>{{ $comment->email }}</td>
                        <td>{{ $comment->comment }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td>No Comments</td>
                        </tr>
                @endforelse
            </table>
        </div>
        <!----------------------------------------------------------->
        <!----------------------------------------------------------->
        <!------------      Users Section     ----------------------->
        <!----------------------------------------------------------->
        <br>
        <div id="usersSection">
            <h2>Users</h2>
            <table class="table table-hover table-dark table-striped table-sm w-100">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Role</th>
                    <th>ClickerHero Stats</th>
                    <th>Delete</th>
                </tr>
                
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td><a href="{{ route('admin.users.games.clicker', $user->id) }}"><button type="button">View Stats</button></a></td>
                        <td>
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No Users Found</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <!----------------------------------------------------------->
        <!----------------------------------------------------------->
        <!------------      IP Tracker Stats     -------------------->
        <!---------------------------------------------------------->
        <h2>Visitor Stats</h2>

        <div style="display: flex; gap: 20px;">
            <div>
                <h3>Today</h3>
                <p>Unique: {{ $stats['today']['unique'] }}</p>
                <p>Total: {{ $stats['today']['total'] }}</p>
            </div>
        
            <div>
                <h3>This Week</h3>
                <p>Unique: {{ $stats['week']['unique'] }}</p>
                <p>Total: {{ $stats['week']['total'] }}</p>
            </div>
        
            <div>
                <h3>This Month</h3>
                <p>Unique: {{ $stats['month']['unique'] }}</p>
                <p>Total: {{ $stats['month']['total'] }}</p>
            </div>
        
            <div>
                <h3>All Time</h3>
                <p>Unique: {{ $stats['all']['unique'] }}</p>
                <p>Total: {{ $stats['all']['total'] }}</p>
            </div>
        </div>        
        <hr>
        <h3>Visits Per Day</h3>

        <table border="1">
            <tr>
                <th>Date</th>
                <th>Unique Visitors</th>
                <th>Total Visits</th>
            </tr>
        
            @foreach ($stats['uniquePerDay'] as $index => $day)
                <tr>
                    <td>{{ $day->date }}</td>
                    <td>{{ $day->unique_visitors }}</td>
                    <td>{{ $stats['totalPerDay'][$index]->total_visits ?? 0 }}</td>
                </tr>
            @endforeach
        </table>  
        <h3>Recent Visitors</h3>
            
        <table border="1">
            <tr>
                <th>IP</th>
                <th>Country</th>
                <th>City</th>
                <th>First Seen</th>
            </tr>
        
            @foreach ($visitors as $v)
                <tr>
                    <td>{{ $v->ip }}</td>
                    <td>{{ $v->country }}</td>
                    <td>{{ $v->city_name }}</td>
                    <td>{{ $v->created_at }}</td>
                </tr>
            @endforeach
        </table>



    @endsection
