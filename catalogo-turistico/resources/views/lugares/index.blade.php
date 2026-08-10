@extends('layouts.app')

@section('titulo', 'Lugares turísticos')

@section('contenido')
    <div class="max-w-4xl mx-auto text-center mb-8">
        <h1 class="text-3xl font-bold mb-2">Destinos turísticos de El Salvador</h1>
        <p class="text-gray-600">Explora los lugares disponibles en nuestro catálogo.</p>
    </div>

    <div class="flex flex-wrap justify-center gap-2 mb-8">
        <a href="{{ route('lugares.index') }}"
           class="px-3 py-1 rounded-full text-sm {{ !$categoria ? 'bg-blue-900 text-white' : 'bg-gray-200 text-gray-700' }}">
            Todos
        </a>
        @foreach ($categorias as $cat)
            <a href="{{ route('lugares.index', ['categoria' => $cat]) }}"
               class="px-3 py-1 rounded-full text-sm {{ $categoria === $cat ? 'bg-blue-900 text-white' : 'bg-gray-200 text-gray-700' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    @if (count($lugares) === 0)
        <p class="text-gray-500">No hay lugares disponibles para esta categoría.</p>
    @endif

    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($lugares as $lugar)
            <a href="{{ route('lugares.show', $lugar['id']) }}"
               class="block bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">

                <div class="relative w-full h-40 bg-gray-200 overflow-hidden">
                    <div class="mini-carrusel relative w-full h-full" data-lugar="{{ $lugar['id'] }}">
                        @foreach ($lugar['galeria'] as $index => $foto)
                            <img src="{{ $foto['imagen'] }}" alt="{{ $lugar['titulo'] }}"
                                 class="mini-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}">
                        @endforeach
                    </div>
                </div>

                <div class="p-4">
                    <span class="text-xs uppercase tracking-wide text-blue-700 font-semibold">
                        {{ $lugar['categoria'] }}
                    </span>
                    <h2 class="text-lg font-bold mt-1">{{ $lugar['titulo'] }}</h2>
                    <p class="text-sm text-gray-500">{{ $lugar['departamento'] }}</p>
                </div>
            </a>
        @endforeach
    </div>

