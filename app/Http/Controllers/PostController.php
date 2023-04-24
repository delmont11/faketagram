<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index (User $user)
    {
        // $posts = Post::latest()->paginate(20);
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create (Request $request)
    {
        return view('posts.create');
    }

    public function store (Request $request)
    {
        // dd("creando post");
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required|max:255',
            'img' => 'required|max:255',
        ]);

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'img' => $request->img,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', auth()->user());
    }

    public function show(User $user, Post $post) {
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(User $user, Post $post) {
        $this->authorize('delete', $post);
        $post->delete();

        //eliminar imagen
        $image_path = public_path('uploads/'.$post->img);
        if(File::exists($image_path)) {
            unlink($image_path);
        }

        return redirect()->route('posts.index', auth()->user());
    }
}
