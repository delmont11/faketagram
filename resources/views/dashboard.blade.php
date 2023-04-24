@extends('layouts.app')

@section('titulo')
    Perfil de {{ $user->username }}
@endsection

@section('')

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w6/12 px-5">
                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}"
                    alt="Imagen de perfil" />
            </div>
            <div class="md:w-8/12 lg:w6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                    @auth
                        @if (auth()->user()->id == $user->id)
                            <a href="{{ route('perfil.index') }}" class="text-gray-500 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>
                <p class="text-gray-800 text-sm mb-3 frotn.bold mt-5">
                    {{ $user->followers->count() }}
                    <span class="text-gray-500">@choice('Seguidor|Seguidores', $user->followers->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 frotn.bold">
                    {{ $user->following->count() }}
                    <span class="text-gray-500">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 frotn.bold">
                    {{ $user->posts->count() }}
                    <span class="text-gray-500">Publicaciones</span>
                </p>

                @auth
                    @if (auth()->user()->id !== $user->id)
                        @if ($user->siguiendo(auth()->user()))
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit"
                                    class="bg-red-600  text-white uppercase rounded-lg px-4 py-1  text-xs font-bold cursor-pointer"
                                    value="Dejar de seguir" />
                            </form>
                        @else
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf
                                <input type="submit"
                                    class="bg-blue-600  text-white uppercase rounded-lg px-4 py-1  text-xs font-bold cursor-pointer"
                                    value="Seguir" />
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <section>
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        <x-listar-post :posts="$posts" />
        {{-- @if ($posts->count() == 0)
            <p class="text-center text-gray-600 uppercase text-sm font-bold">No hay publicaciones</p>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div> --}}
                        {{-- SECCIÓN 19, CLASE 118 --}}
                        {{-- <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->img }}"
                                alt="Imagen del post {{ $post->title }}" />
                        </a> --}}
                        {{-- <p>{{$post->content}}</p> --}}
                    {{-- </div>
                @endforeach
            </div>
            <div class="my-10">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @endif --}}
    </section>

@endsection
