@extends('layouts.app')

@section('titulo')
    {{ $post->title }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->img }}" alt="Imagen del post {{ $post->title }}" />
            <div class="p-3 flex items-center gap-4">
                @auth
                    @php
                        $mensaje = 'hola mundo desde una variable';
                    @endphp
                    <livewire:like-post :post="$post" />

                @endauth

            </div>

            <div class="">
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->body }}
                </p>
            </div>
            @auth()
                @if ($post->user_id == auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar publicación"
                            class="bg-red-500 hover:bg-red-600 p-2 text-white font-bold cursor-pointer rounded" />
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth()
                    <p class="text-xl font-bold text-center mb-4">Agregar un nuevo comentario</p>

                    @if (session('status'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                Comentario
                            </label>
                            <textarea type="text" id="comentario" name="comentario" placeholder="Agraga un comentario"
                                class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"></textarea>
                            @error('comentario')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar"
                            class="bg-blue-500 hover:bg-blue-700 text-white transition-colors font-bold py-2 px-4 rounded cursor-pointer" />
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gary-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}"
                                    class="font-bold">{{ $comentario->user->username }}</a>
                                <p class="mt-5">
                                    {{ $comentario->comentario }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $comentario->created_at->diffForHumans() }}
                                </p>


                            </div>
                        @endforeach
                    @else
                        <p class="text-center p-10">No hay comentarios</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
