<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GithubProjects;
use App\Models\Comment;
use App\Models\User;
use App\Models\ClickerGame;

class AdminRouteController extends Controller
{
    public function index(){
        
        ## Add other tables here
        ## Add use App\Models\newModel 
        ## also add to view compact()
        $projects = GithubProjects::all();
        $comments = Comment::all();
        $users = User::select('id', 'name', 'email', 'role')->get();
        

        return view('protectedWebPages.indexAdmin', compact('projects', 'comments', 'users'));
        
    }
    public function deleteUser(User $user){
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }
        if ($user->role === 'admin') {
            return back()->with('error', 'You cannot delete another admin.');
        }

        $user->delete();

        return back()->with('success', 'User ' . $user->name . ' deleted successfully.');
    }

    public function showClickerStats(User $user){
        $clickerStats = ClickerGame::where('user_id', $user->id)->first(); 
        return view('protectedWebPages.adminClickerStats', [
            'user' => $user,
            'clickerData' => $clickerStats
        ]);
    }
    public function resetClickerStats(User $user)
    {
        ClickerGame::updateOrCreate(
            ['user_id' => $user->id],
            [
                'score' => 0,
                'multiplier' => 1,
                'passive_income_level' => 0,
                'prestige_level' => 0,
                'background_color' => 'default',
                'frame_choice' => 'default',
            ]
        );
    
        return redirect()
            ->route('admin.users.games.clicker', $user->id)
            ->with('success', 'Clicker stats reset successfully.');
    }

}
//     public function createProject(){
//         return view('protectedWebPages.createProject');
//     }
//     public function storeProject(Request $request){
//         $data = $request->validate([
//             'title' => 'required',
//             'languages' => 'required',
//             'github_link' => 'required',
//             'full_description' => 'required',
//             'short_description' => 'required'
//         ]);
        
//         $newProject = GithubProjects::create($data);
//         return redirect(route('admin.index'));
//     }
//     public function editProject(GithubProjects $project){
//         return view('admin.editProject', ['project' => $project]);
//     }

//     public function updateProject(GithubProjects $project, Request $request){
//         $data = $request->validate([
//             'title' => 'required',
//             'languages' => 'required',
//             'github_link' => 'required',
//             'full_description' => 'required',
//             'short_description' => 'required'
//         ]);
        
//         $project->update($data);
//         return redirect(route('admin.index'))->with('success', 'Project Updated Successfully');
//     }
//     public function deleteProject(GithubProjects $project){
//         $project->delete();
//         return redirect(route('admin.index'))->with('success', 'Project Deleted Successfully');
//     }
// }