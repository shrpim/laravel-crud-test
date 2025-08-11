<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'comments')->latest()->get();
        return view('home', compact('posts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'body' => 'required|string|max:500',
        ]);

        Post::create($data);

        return redirect()->route('home')->with('success', 'Пост создан!');
    }
}
