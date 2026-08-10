@extends('layouts.app')

@section('titulo', 'Lugares turísticos')

@section('contenido')
    <h1 class="text-3xl font-bold mb-2">Destinos turísticos de El Salvador</h1>
    <p class="text-gray-600 mb-6">Explora los lugares disponibles en nuestro catálogo.</p>

    <div class="flex flex-wrap gap-2 mb-8">
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
            <div class="block bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">

                {{-- Clic en la foto: la amplía sin salir del catálogo --}}
                <button type="button"
                        onclick='abrirLightbox({!! json_encode($lugar['galeria']) !!}, 0)'
                        class="block w-full h-40 relative group cursor-zoom-in">
                    <img src="{{ $lugar['galeria'][0]['imagen'] }}" alt="{{ $lugar['titulo'] }}"
                         class="w-full h-full object-cover">
                    <span class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition"></span>
                </button>

                <a href="{{ route('lugares.show', $lugar['id']) }}" class="block p-4 hover:bg-gray-50 transition">
                    <span class="text-xs uppercase tracking-wide text-blue-700 font-semibold">
                        {{ $lugar['categoria'] }}
                    </span>
                    <h2 class="text-lg font-bold mt-1">{{ $lugar['titulo'] }}</h2>
                    <p class="text-sm text-gray-500">{{ $lugar['departamento'] }}</p>
                </a>
            </div>
        @endforeach
    </div>
@endsection
