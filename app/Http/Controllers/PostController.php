<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $user = Auth::user();
        $post->user_id = $user->id;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $newFileName = time() . "_" . $file->getClientOriginalName();
            $path = $file->storeAs('images', $newFileName, 'public');
            $post->image = $path;
        }
        $post->save();
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        if ($request->hasFile('image')) {
            if ($post->image) {
                unlink(storage_path('app/public/' . $post->image));
            }
            $path = $request->file('image')->store('images', 'public');
            $post->image = $path;
        }
        $post->update();
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        if ($post->image) {
            unlink(storage_path('app/public/' . $post->image));
        }
        return redirect()->back();
    }
}
