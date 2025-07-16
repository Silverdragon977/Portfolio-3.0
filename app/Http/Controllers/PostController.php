<?php
// Example Controller

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()   // This method is when the link is accessed
    {
        // Return page
        $posts = Post::all(); // Array with all posts in database
        return view('posts.index', compact('posts'));  
        // posts folder has file index.php
        // compact() passes posts into variable
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // When we submit this form, so validate, create, and return
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Post::create($validated);
        return redirect()->route('posts.index')->with('success','Post created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // When we submit this form, so validate, create, and return
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = Post::findOrFail($id);    // Find the post
        $post->update($validated);           // Update the post with valid content
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Deletes the post
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success',
         'Post deleted successfully!');
    }
}
