<?php
# /app/Http/Controllers/CommentController.php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin')->only(['index', 'destroy']);

    }
    public function index()
    {
        //
        $comments = Comment::all();

        if (auth()->check() && auth()->user()->role === 'admin') {
            #If user and user is admin
            return view('admin.comments.index', compact('comments'));
        }
        # If user
        return view('webpages.comments', compact('comments'));
    }

    /**
     * When we need to create a comment this is called
     */
    public function create()
    {
        $user = auth()->user(); ## Get user and pass session variable to view
        return view('webpages.contact', ['name' => $user->name, 'email' => $user->email]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Redundent auth check
        $user = auth()->user();

        $validated = $request->validate([
            'comment' => 'required|string|max:1000'
        ]);

        Comment::create([
            'name' => $user->name,
            'email' => $user->email,
            'comment' => $validated['comment']
        ]);
        
        return redirect()
        ->route('comments.create')
        ->with('success', 'Comment Posted!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(comments $comments)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, comments $comments)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
         if (auth()->check() && auth()->user()->role === 'admin') {
                $comment->delete();
                return redirect()->route('admin.comments.index')->with('success', 'Comment Deleted');
            }
        redirect()->route('homePage');
    }
}
