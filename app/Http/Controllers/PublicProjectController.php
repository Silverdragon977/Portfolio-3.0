<?php

namespace App\Http\Controllers;

use App\Models\GithubProjects;
use Illuminate\Http\Request;

class PublicProjectController extends Controller
{
    // This is to render the projects to the public projects webpage without CRUD
    public function index()
    {
        $projects = GithubProjects::all();
        return view('webpages.projects', compact('projects'));
    }
}
