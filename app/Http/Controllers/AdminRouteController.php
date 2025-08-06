<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GithubProjects;
use App\Models\comments;

class AdminRouteController extends Controller
{
    public function index(){
        $projects = GithubProjects::all();
        return view('protectedWebPages.indexAdmin', ['projects' => $projects]);
        
    }
    public function createProject(){
        return view('protectedWebPages.createProject');
    }
    public function storeProject(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'languages' => 'required',
            'github_link' => 'required',
            'full_description' => 'required',
            'short_description' => 'required'
        ]);
        
        $newProject = GithubProjects::create($data);
        return redirect(route('admin.index'));
    }
    public function editProject(GithubProjects $project){
        return view('admin.editProject', ['project' => $project]);
    }

    public function updateProject(GithubProjects $project, Request $request){
        $data = $request->validate([
            'title' => 'required',
            'languages' => 'required',
            'github_link' => 'required',
            'full_description' => 'required',
            'short_description' => 'required'
        ]);
        
        $project->update($data);
        return redirect(route('admin.index'))->with('sucess', 'Project Updated Successfully');
    }
    public function deleteProject(GithubProjects $project){
        $project->delete();
        return redirect(route('admin.index'))->with('sucess', 'Project Deleted Successfully');
    }
}
