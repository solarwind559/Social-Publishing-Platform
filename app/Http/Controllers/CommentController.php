<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:3',
            'post_id' => 'required|exists:posts,id',
        ]);

        // Sanitize input data
        $content = e($request->input('content'));

        Comment::create([
            'content' => $content,
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.show', $request->post_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
        $this->authorize('update', $comment);

        return view('auth.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        // Make ssure the user is authorized to update the comment
        if (Auth::id() != $comment->user_id) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $request->validate([
            'content' => 'required|string|min:3',
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully');

    }
}
