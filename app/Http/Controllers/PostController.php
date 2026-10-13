<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        // with('user') = eager loading: penulis diambil sekaligus, menghindari query N+1
        $posts = Post::with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string|min:10',
        ]);

        $request->user()->posts()->create($data);

        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string|min:10',
        ]);

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        try {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->route('posts.index')->with('error', 'Gagal menghapus post.');
        }
    }
}