@extends('layouts.app')

@section('titulo')
    Iniciar Sesión en Devstagram
@endsection

@section('contenido')
    <div class="md:flex justify-center md:gap-4 md:items-center">
        <div class="md:w-6/12">
            <img src="{{asset('img/login.jpg')}}" alt="imagen login de usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form method="POST" action="{{ route('login')}}" novalidate>
                {{-- @csrf es un helper de Laravel que nos permite generar un token de seguridad  contra CROSS SITE REQUEST--}}
                @csrf

                @if(session('status'))
                    <p class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                        {{session('status')}}
                    </p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Tu email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        {{-- esto conserva el valor de los campos --}}
                        value="{{old('email')}}"
                    />
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Ingrese una contraseña"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-5">
                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        class="mr-2"
                    />
                    <label for="remember" class="text-gray-500  text-sm">
                        Recordarme
                    </label>
                </div>

                <input
                    type="submit"
                    value="Iniciar Sesión"
                    class="bg-blue-500 hover:bg-blue-700 text-white transition-colors font-bold py-2 px-4 rounded cursor-pointer"
                />
            </form>
        </div>
    </div>
@endsection
