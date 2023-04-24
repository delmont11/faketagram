@extends('layouts.app')

@section('titulo')
    Editar Perfil de {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('perfil.store')}}" enctype="multipart/form-data" class="mt-10 md-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="Tu username"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        {{-- esto conserva el valor de los campos --}} value="{{ auth()->user()->username }}" />
                    @error('username')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input type="text" id="email" name="email" placeholder="Tu email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        {{-- esto conserva el valor de los campos --}} value="{{ auth()->user()->email }}" />
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de perfil
                    </label>
                    <input type="file" id="imagen" name="imagen"
                        class="border p-3 w-full rounded-lg value="" accept=".jpg, .jpeg, .png" />
                </div>

                <input type="submit" value="Guardar Cambios"
                    class="bg-blue-500 hover:bg-blue-700 text-white transition-colors font-bold py-2 px-4 rounded cursor-pointer" />
            </form>
        </div>
    </div>
@endsection
