@extends('layouts.app')

@section('titulo', 'Contacto - ' . $lugar['titulo'])

@section('contenido')
    <a href="{{ route('lugares.show', $lugar['id']) }}" class="text-blue-700 text-sm">
        &larr; Volver a {{ $lugar['titulo'] }}
    </a>

    <div class="bg-white rounded-lg shadow mt-4 p-6 max-w-lg">
        <h1 class="text-2xl font-bold mb-1">Solicitar información</h1>
        <p class="text-gray-500 mb-6">Sobre: {{ $lugar['titulo'] }}</p>

        @if ($errors->any())
            <div class="mb-4 rounded bg-red-100 border border-red-400 text-red-800 px-4 py-3">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('contacto.store', $lugar['id']) }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Nombre completo</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Correo electrónico</label>
                <input type="email" name="correo" value="{{ old('correo') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Teléfono (opcional)</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Mensaje</label>
                <textarea name="mensaje" rows="4"
                          class="w-full border rounded px-3 py-2">{{ old('mensaje') }}</textarea>
            </div>

            <button type="submit" class="bg-blue-900 text-white px-5 py-2 rounded hover:bg-blue-800">
                Enviar solicitud
            </button>
        </form>
    </div>
@endsection
