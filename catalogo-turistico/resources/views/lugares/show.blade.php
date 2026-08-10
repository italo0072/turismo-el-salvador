@extends('layouts.app')

@section('titulo', $lugar['titulo'])

@section('contenido')
    <a href="{{ route('lugares.index') }}" class="text-blue-700 text-sm">&larr; Volver al catálogo</a>

    @php
        $fotosJson = json_encode($lugar['galeria']);
    @endphp

    <div class="bg-white rounded-lg shadow mt-4 overflow-hidden">

        <div class="show-gallery group relative w-full h-64 md:h-80 overflow-hidden rounded-t-lg cursor-zoom-in"
             onclick='abrirLightbox({!! $fotosJson !!}, 0)'>
            @foreach ($lugar['galeria'] as $index => $foto)
                <img src="{{ $foto['imagen'] }}" alt="{{ $lugar['titulo'] }}"
                     class="show-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}">
            @endforeach

            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition"></div>
            <div class="absolute inset-x-0 bottom-4 z-20 flex justify-center gap-2 px-4">
                @foreach ($lugar['galeria'] as $index => $foto)
                    <button type="button"
                            onclick="event.stopPropagation(); setShowSlide({{ $index }});"
                            class="show-dot w-3 h-3 rounded-full bg-white/70 border border-white {{ $index === 0 ? 'opacity-100' : 'opacity-50' }}"></button>
                @endforeach
            </div>
            <div class="absolute top-3 right-3 z-20 w-10 h-10 rounded-full bg-white/80 backdrop-blur shadow flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-gray-800">
                    <path fill="currentColor" d="M10 2a8 8 0 015.292 13.708l4.5 4.5a1 1 0 01-1.414 1.414l-4.5-4.5A8 8 0 1110 2zm0 2a6 6 0 100 12 6 6 0 000-12z"/>
                </svg>
            </div>
        </div>

        <div class="p-6">
            <span class="text-xs uppercase tracking-wide text-blue-700 font-semibold">
                {{ $lugar['categoria'] }}
            </span>
            <h1 class="text-3xl font-bold mt-1">{{ $lugar['titulo'] }}</h1>
            <p class="text-gray-500 mb-4">{{ $lugar['departamento'] }}</p>

            <p class="text-gray-700 mb-6">{{ $lugar['descripcion'] }}</p>

           

            <dl class="grid sm:grid-cols-2 gap-4 mb-6">
                <div>
                    <dt class="text-sm text-gray-500">Precio de entrada</dt>
                    <dd class="font-semibold">{{ $lugar['precio_entrada'] }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Horario</dt>
                    <dd class="font-semibold">{{ $lugar['horario'] }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Clima recomendado</dt>
                    <dd class="font-semibold">{{ $lugar['clima'] }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Cómo llegar</dt>
                    <dd class="font-semibold">{{ $lugar['como_llegar'] }}</dd>
                </div>
            </dl>

            <a href="{{ route('contacto.create', $lugar['id']) }}"
               class="inline-block bg-blue-900 text-white px-5 py-2 rounded hover:bg-blue-800">
                Solicitar más información
            </a>
        </div>
    </div>
@endsection
