<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectPost;
use Illuminate\Support\Facades\Storage;

class ProjectPostController extends Controller
{
    // List posts with pagination
    public function index()
{
    // Order posts by created_at descending (newest first)
    $posts = ProjectPost::orderBy('created_at', 'desc')->paginate(6);

    $posts->getCollection()->transform(function ($post) {
        $post->image_url = $post->image ? asset('storage/' . $post->image) : null;
        return $post;
    });

    return response()->json($posts);
}

    // Create a new post with optional image upload
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'git_url'   => 'required|string|max:255',
            'project_url'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }

        $post = ProjectPost::create($validated);
        $post->image_url = $post->image ? asset('storage/' . $post->image) : null;

        return response()->json([
            'message' => 'Post created successfully!',
            'post'    => $post,
        ], 201);
    }

    // Show single post
    public function show($id)
    {
        $post = ProjectPost::findOrFail($id);
        $post->image_url = $post->image ? asset('storage/' . $post->image) : null;

        return response()->json($post);
    }

    // Update post with optional image upload
    public function update(Request $request, $id)
    {
        $post = ProjectPost::findOrFail($id);

        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'git_url'   => 'required|string|max:255',
            'project_url'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }

        $post->update($validated);
        $post->image_url = $post->image ? asset('storage/' . $post->image) : null;

        return response()->json([
            'message' => 'Post updated successfully!',
            'post'    => $post,
        ]);
    }

    // Delete post and image file
    public function destroy($id)
    {
        $post = ProjectPost::findOrFail($id);

        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully!']);
    }
}
