<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(User $user)
    {
        return view('perfil.index', $user);
    }

    public function store(Request $request)
    {
        $request->request->add([
            'username' => Str::slug($request->username)
        ]);

        $this->validate($request, [
            'username' => ['required', 'max:255', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:30', 'not_in:admin,administrator,root,edit'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id],
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();
            $imagenServidor = Image::make($imagen)->fit(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('posts.index', $usuario);
    }
}
