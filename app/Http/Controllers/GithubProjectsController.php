<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\GithubProjects;

use Illuminate\Http\Request;



class GithubProjectsController extends Controller
{
    // Constructs this controller if the user if verified and isAdmin
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin'])->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = GithubProjects::all();

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.github_projects.index', compact('projects'));
        }

        return view('webpages.projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only accesable from admin!
        return view('admin.github_projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only accesable from admin!
                $validated = $request->validate([
            'title' => 'required|string',
            'languages' => 'required|string',
            'github_link' => 'required|url',
            'short_description' => 'required|string|max:1000',
            'full_description' => 'required|string',
        ]);

        GithubProjects::create($validated);
        return redirect()->route('admin.github_projects.index')->with('success', 'Project created!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(GithubProjects $githubProjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GithubProjects $githubProjects)
    {
        // Only accesable from admin!
        return view('admin.github_projects.edit', compact('githubProjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GithubProjects $githubProjects)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'languages' => 'required|string',
            'github_link' => 'required|url',
            'short_description' => 'required|string|max:1000',
            'full_description' => 'required|string',
        ]);

        $githubProjects->update($validated);

        return redirect()->route('admin.github_projects.index')->with('success', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GithubProjects $githubProjects)
    {
        $githubProjects->delete();
        return redirect()->route('admin.github_projects.index')->with('success', 'Project deleted!');
    }
}
