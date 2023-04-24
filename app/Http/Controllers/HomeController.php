<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    public function index() {
        // pluck permite obtener una columna de una coleccion
        $ids = auth()->user()->following->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(5);
        return view('home', [
            'posts' => $posts
        ]);
    }
}
