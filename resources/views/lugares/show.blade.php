@extends('layouts.app')

@section('titulo', $lugar['titulo'])

@section('contenido')
    <a href="{{ route('lugares.index') }}" class="text-blue-700 text-sm">&larr; Volver al catálogo</a>

    @php
        $fotosJson = json_encode($lugar['galeria']);
    @endphp

    <div class="bg-white rounded-lg shadow mt-4 overflow-hidden">

        {{-- Foto principal: clic para ampliar y recorrer la galería --}}
        <button type="button"
                onclick='abrirLightbox({{ $fotosJson }}, 0)'
                class="block w-full h-64 md:h-80 relative group cursor-zoom-in">
            <img src="{{ $lugar['galeria'][0]['imagen'] }}" alt="{{ $lugar['titulo'] }}"
                 class="w-full h-full object-cover">
            <span class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition flex items-center justify-center">
                <span class="opacity-0 group-hover:opacity-100 transition text-white text-sm font-semibold bg-black/60 px-3 py-1 rounded">
                    Ampliar fotos
                </span>
            </span>
        </button>

        {{-- Miniaturas: si hay más de una foto, se pueden recorrer todas --}}
        @if (count($lugar['galeria']) > 1)
            <div class="flex gap-2 p-3 bg-gray-50 overflow-x-auto">
                @foreach ($lugar['galeria'] as $index => $foto)
                    <button type="button"
                            onclick='abrirLightbox({{ $fotosJson }}, {{ $index }})'
                            class="flex-shrink-0 w-20 h-16 rounded overflow-hidden border-2 border-transparent hover:border-blue-700 transition">
                        <img src="{{ $foto['imagen'] }}" alt="{{ $lugar['titulo'] }}" class="w-full h-full object-cover">
                    </button>
                @endforeach
            </div>
        @endif

        <div class="p-6">
            <span class="text-xs uppercase tracking-wide text-blue-700 font-semibold">
                {{ $lugar['categoria'] }}
            </span>
            <h1 class="text-3xl font-bold mt-1">{{ $lugar['titulo'] }}</h1>
            <p class="text-gray-500 mb-4">{{ $lugar['departamento'] }}</p>

            <p class="text-gray-700 mb-6">{{ $lugar['descripcion'] }}</p>

            <div class="mb-6">
                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-2">Lo más atractivo</h2>
                <ul class="space-y-1">
                    @foreach ($lugar['galeria'] as $foto)
                        <li class="flex items-start gap-2 text-sm text-gray-600">
                            <span class="text-blue-700 mt-0.5">&bull;</span>
                            <span>{{ $foto['descripcion'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

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
