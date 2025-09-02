<?php

namespace App\Http\Controllers;

use App\Models\comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(Type $var = null) {
        $this->middleware(['auth', 'is_admin'])->only(['create', 'store', 'edit', 'update', 'destroy']);

    }
    public function index()
    {
        //
        $projects = comments::all();

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.comments.index', compact('comments'));
        }

        return view('webpages.comments', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('admin.github_projects.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(comments $comments)
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
    public function destroy(comments $comments)
    {
        $comments->delete();
        returrn redirect()->route('admin.comments.index')->with('success', 'Comment Deleted');
    }
}
