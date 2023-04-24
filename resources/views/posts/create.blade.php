@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación
@endsection
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 p-10">
            <form id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center"
                action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            </form>
        </div>

        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-lg mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST">
                {{-- @csrf es un helper de Laravel que nos permite generar un token de seguridad  contra CROSS SITE REQUEST --}}
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input type="text" id="title" name="title" placeholder="Titulo de la publicación"
                        class="border p-3 w-full rounded-lg @error('title') border-red-500 @enderror" {{-- esto conserva el valor de los campos --}}
                        value="{{ old('title') }}" />
                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="body" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea type="text" id="body" name="body" placeholder="Descripcion de la publicación"
                        class="border p-3 w-full rounded-lg @error('body') border-red-500 @enderror" {{-- esto conserva el valor de los campos --}}> {{ old('titulo') }} </textarea>
                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-5">

                    <input
                        type="hidden"
                        name="img"
                        id="img"
                        value="{{old('img')}}" />
                    @error('img')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="submit" value="Publicar"
                    class="bg-blue-500 hover:bg-blue-700 text-white transition-colors font-bold py-2 px-4 rounded cursor-pointer" />
            </form>
        </div>
    </div>
@endsection
