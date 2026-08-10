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
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-center">
            <a href="{{ route('lugares.index') }}" class="text-xl font-bold text-center">
                Catálogo Turístico El Salvador
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8">
        @if (session('exito'))
            <div class="mb-6 rounded bg-green-100 border border-green-400 text-green-800 px-4 py-3">
                {{ session('exito') }}
            </div>
        @endif

        @yield('contenido')
    </main>

    <footer class="text-center text-sm text-gray-500 py-8">
        Turismo El Salvador | Italo Garcia
    </footer>

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
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function cerrarLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }

        function mostrarFotoActual() {
            const foto = lightboxFotos[lightboxIndex];
            if (!foto) return;
            document.getElementById('lightbox-img').src = foto.imagen;
            document.getElementById('lightbox-img').alt = foto.descripcion || '';
            document.getElementById('lightbox-caption').textContent = foto.descripcion || '';
        }

        function fotoSiguiente() {
            if (!lightboxFotos.length) return;
            lightboxIndex = (lightboxIndex + 1) % lightboxFotos.length;
            mostrarFotoActual();
        }

        function fotoAnterior() {
            if (!lightboxFotos.length) return;
            lightboxIndex = (lightboxIndex - 1 + lightboxFotos.length) % lightboxFotos.length;
            mostrarFotoActual();
        }

        document.addEventListener('keydown', function (e) {
            const lightbox = document.getElementById('lightbox');
            if (lightbox.classList.contains('hidden')) return;
            if (e.key === 'Escape') cerrarLightbox();
            if (e.key === 'ArrowRight') fotoSiguiente();
            if (e.key === 'ArrowLeft') fotoAnterior();
        });

        document.getElementById('lightbox').addEventListener('click', function (e) {
            if (e.target === this) {
                cerrarLightbox();
            }
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

            const showGalleries = document.querySelectorAll('.show-gallery');
            showGalleries.forEach(function (gallery) {
                const slides = Array.from(gallery.querySelectorAll('.show-slide'));
                const dots = Array.from(gallery.querySelectorAll('.show-dot'));
                if (slides.length <= 1) return;

                let currentSlide = 0;

                function activate(index) {
                    slides.forEach(function (slide, slideIndex) {
                        slide.classList.toggle('opacity-100', slideIndex === index);
                        slide.classList.toggle('opacity-0', slideIndex !== index);
                    });
                    dots.forEach(function (dot, dotIndex) {
                        dot.classList.toggle('opacity-100', dotIndex === index);
                        dot.classList.toggle('opacity-50', dotIndex !== index);
                    });
                    currentSlide = index;
                }

                if (!window.setShowSlide) {
                    window.setShowSlide = function (index) {
                        activate(index);
                    };
                }

                setInterval(function () {
                    activate((currentSlide + 1) % slides.length);
                }, 3000);
            });
        });
    </script>
</body>
</html>
