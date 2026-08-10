<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Turismo El Salvador')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-blue-900 text-white shadow">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('lugares.index') }}" class="text-xl font-bold">
                Catálogo Turístico El Salvador
            </a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-8">
        @if (session('exito'))
            <div class="mb-6 rounded bg-green-100 border border-green-400 text-green-800 px-4 py-3">
                {{ session('exito') }}
            </div>
        @endif

        @yield('contenido')
    </main>

    <footer class="text-center text-sm text-gray-500 py-8">
        Proyecto académico — Patrón MVC en Laravel
    </footer>

    {{-- Visor de fotos ampliado (lightbox), reutilizable en todas las páginas --}}
    <div id="lightbox" class="hidden fixed inset-0 z-50 bg-black/90 items-center justify-center">
        <button onclick="cerrarLightbox()" class="absolute top-4 right-5 text-white text-3xl leading-none">&times;</button>

        <button onclick="fotoAnterior()" class="absolute left-3 md:left-8 text-white text-4xl px-2 select-none">&#8249;</button>

        <img id="lightbox-img" src="" alt="" class="max-h-[85vh] max-w-[90vw] object-contain rounded">

        <button onclick="fotoSiguiente()" class="absolute right-3 md:right-8 text-white text-4xl px-2 select-none">&#8250;</button>

        <p id="lightbox-caption" class="absolute bottom-6 left-0 right-0 text-center text-white text-sm px-6"></p>
    </div>

    <script>
        let lightboxFotos = [];
        let lightboxIndex = 0;

        function abrirLightbox(fotos, indiceInicial) {
            lightboxFotos = fotos;
            lightboxIndex = indiceInicial;
            mostrarFotoActual();
            document.getElementById('lightbox').classList.remove('hidden');
            document.getElementById('lightbox').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function cerrarLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.getElementById('lightbox').classList.remove('flex');
            document.body.style.overflow = '';
        }

        function mostrarFotoActual() {
            const foto = lightboxFotos[lightboxIndex];
            document.getElementById('lightbox-img').src = foto.imagen;
            document.getElementById('lightbox-img').alt = foto.descripcion || '';
            document.getElementById('lightbox-caption').textContent = foto.descripcion || '';
        }

        function fotoSiguiente() {
            lightboxIndex = (lightboxIndex + 1) % lightboxFotos.length;
            mostrarFotoActual();
        }

        function fotoAnterior() {
            lightboxIndex = (lightboxIndex - 1 + lightboxFotos.length) % lightboxFotos.length;
            mostrarFotoActual();
        }

        document.addEventListener('keydown', function (e) {
            if (document.getElementById('lightbox').classList.contains('hidden')) return;
            if (e.key === 'Escape') cerrarLightbox();
            if (e.key === 'ArrowRight') fotoSiguiente();
            if (e.key === 'ArrowLeft') fotoAnterior();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const carruseles = document.querySelectorAll('.mini-carrusel');
            carruseles.forEach(function (carrusel) {
                const slides = Array.from(carrusel.querySelectorAll('.mini-slide'));
                if (slides.length <= 1) return;

                let indiceActual = 0;
                setInterval(function () {
                    slides[indiceActual].classList.remove('opacity-100');
                    slides[indiceActual].classList.add('opacity-0');

                    indiceActual = (indiceActual + 1) % slides.length;

                    slides[indiceActual].classList.remove('opacity-0');
                    slides[indiceActual].classList.add('opacity-100');
                }, 3000);
            });
        });
    </script>
</body>
</html>
