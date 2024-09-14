<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function dashboard()
    {
        $posts = Post::with(['user', 'categories'])->withCount('comments')->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        return view('dashboard', compact('posts', 'categories'));
    }

    public function filterByCategory(Category $category)
    {
        $posts = $category->posts()->with(['user', 'categories'])->withCount('comments')->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        return view('dashboard', compact('posts', 'categories'));
    }

    public function myPosts()
    {
        $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->get();
        return view('auth.posts.myposts', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('auth.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        // Get category IDs from the request or set default category if empty
        $categoryIds = $request->input('categories', []);
        if (empty($categoryIds)) {
            $defaultCategory = Category::where('name', 'Unsorted')->first();
            if ($defaultCategory) {
                $categoryIds[] = $defaultCategory->id;
            } else {
                // If the default category does not exist
                return redirect()->route('posts.create')
                                 ->withErrors(['categories' => 'Default category "Unsorted" does not exist.']);
            }
        }

        $post->categories()->sync($categoryIds);

        return redirect()->route('posts.myposts')
                        ->with('success', 'Post created successfully.');
    }


    public function show($id)
    {
        $post = Post::with('categories')->findOrFail($id);
        return view('auth.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        // Make sure the user is authorized to edit the post
        $this->authorize('update', $post);

        $categories = Category::all();
        return view('auth.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        try {
            // Make sure the user is authorized to update the post
            $this->authorize('update', $post);

            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'categories' => 'nullable|array',
                'categories.*' => 'exists:categories,id', // Ensure each category exists
            ]);

            $updated = $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            $synced = $post->categories()->sync($request->input('categories', []));

            return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully.');

        } catch (\Exception $e) {
            \Log::error('An error occurred:', ['error' => $e->getMessage()]);
            return redirect()->route('posts.edit', $post)->with('error', 'An error occurred.');
        }
    }



    public function destroy(Post $post)
    {
        // Make sure the user is authorized to delete the post
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.myposts')->with('success', 'Post deleted successfully.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $posts = Post::where('title', 'LIKE', "%{$keyword}%")
                     ->orWhere('content', 'LIKE', "%{$keyword}%")
                     ->get();

        $categories = Category::all();

        return view('dashboard', compact('posts', 'keyword', 'categories'));
    }

}

