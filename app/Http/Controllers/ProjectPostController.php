<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectPost;
use Illuminate\Support\Facades\Storage;

class ProjectPostController extends Controller
{
    // Admin: List posts with pagination (blade view)
    public function index()
    {
        $posts = ProjectPost::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.posts', compact('posts'));
    }

    // Admin: Show create post form
    public function create()
    {
        return view('admin.create_post');
    }

    // Admin: Store new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'git_url'     => 'required|string|max:255',
            'project_url' => 'required|string|max:255',
            'content'     => 'required|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        ProjectPost::create($validated);

        return redirect()->route('admin.posts')->with('success', 'Post created successfully!');
    }

    // Admin: Show edit form
    public function edit($id)
    {
        $post = ProjectPost::findOrFail($id);
        return view('admin.edit_post', compact('post'));
    }

    // Admin: Update post
    public function update(Request $request, $id)
    {
        $post = ProjectPost::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'git_url'     => 'required|string|max:255',
            'project_url' => 'required|string|max:255',
            'content'     => 'required|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('admin.posts')->with('success', 'Post updated successfully!');
    }

    // Admin: Delete post
    public function destroy($id)
    {
        $post = ProjectPost::findOrFail($id);

        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts')->with('success', 'Post deleted successfully!');
    }

    // Public: List posts with pagination for site
    public function publicList()
    {
        $posts = ProjectPost::orderBy('created_at', 'desc')->paginate(6);
        return view('site.posts', compact('posts'));
    }

    // Public: Show single post by slug
    public function publicSingle($slug)
    {
        $post = ProjectPost::where('slug', $slug)->firstOrFail();
        return view('site.single_post', compact('post'));
    }
}
