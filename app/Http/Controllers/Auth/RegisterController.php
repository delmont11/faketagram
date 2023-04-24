<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index ()
    {
        return view('auth.register');
    }
    public function store (Request $request)
    {
        // dd($request);
        // Validate the user
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|max:255|unique:users|min:3|max:30',
            'email' => 'required|email|max:60|unique:users',
            'password' => 'required|confirmed|min:6|max:30',
        ]);
        //Modificar el request
        $request->request->add([
            'username' => Str::slug($request->username)
        ]);

        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username) ,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //Autenticar al usuario

        // auth()->attempt(
        //     [
        //         'email' => $request->email,
        //         'password' => $request->password
        //     ]
        // );

        auth()->attempt($request->only('email', 'password'));

        //Redireccionar
        return redirect()->route('posts.index', auth()->user());
    }
}
