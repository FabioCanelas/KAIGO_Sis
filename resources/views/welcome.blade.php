<!DOCTYPE html>

<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="description" content="KIVO - Catálogo interactivo de productos tecnológicos premium y accesorios.">
    <title>KIVO | Catálogo Web Artículos Tecnólogicos</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

    <!-- Icono del sitio (Favicon) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/white-l.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/white-l.png') }}">

    <!-- Motor 3D -->
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-surface text-on-surface font-body-md">
    <!-- TopAppBar -->
    <header class="bg-surface/40 backdrop-blur-md border-b border-border-subtle/30 sticky top-0 z-50 transition-colors duration-300">
        <div class="flex justify-between items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="flex items-center gap-4">
                <button aria-label="Abrir menú" class="material-symbols-outlined text-primary p-2 Active: scale-95 transition-transform" data-icon="menu" id="menu-trigger">menu</button>
                <div class="font-display-lg text-display-lg-mobile tracking-tighter text-primary">KIVO</div>
            </div>
            <nav class="hidden md:flex gap-8">
                <a class="font-label-sm text-label-sm uppercase text-on-surface hover:text-secondary transition-colors duration-200" href="#inicio">Inicio</a>
                <a class="font-label-sm text-label-sm uppercase text-on-surface hover:text-secondary transition-colors duration-200" href="#destacados">Destacados</a>
                <a class="font-label-sm text-label-sm uppercase text-on-surface hover:text-secondary transition-colors duration-200" href="#catalogo">Catálogo</a>
                <a class="font-label-sm text-label-sm uppercase text-on-surface hover:text-secondary transition-colors duration-200" href="#sobre-nosotros">Nosotros</a>
            </nav>
            <div class="flex items-center gap-4">
                <a aria-label="Ir a la tienda" href="{{ route('catalogo') }}" class="material-symbols-outlined text-primary p-2 Active: scale-95 transition-transform" data-icon="storefront">storefront</a>
            </div>
        </div>
    </header>
    <main id="inicio" class="relative w-full">
    <!-- Hero Section -->
    <section class="relative z-10 w-full min-h-[calc(100vh-80px)] flex flex-col items-center justify-center bg-surface pt-10 pb-20 overflow-hidden hero">
        <!-- Huge Background Text -->
        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none z-0 leading-none select-none overflow-hidden opacity-90 hero-title">
            <h1 class="text-[22vw] md:text-[18vw] font-black tracking-tighter text-primary whitespace-nowrap m-0 p-0 leading-[0.85]">KIVO</h1>
            <h1 class="text-[22vw] md:text-[18vw] font-black tracking-tighter text-primary whitespace-nowrap m-0 p-0 leading-[0.85]">CATÁLOGO</h1>
        </div>

        <!-- Center content: The Owl and side elements -->
            <div class="relative z-10 w-full max-w-container-max mx-auto flex flex-col md:flex-row items-center justify-between px-margin-mobile md:px-margin-desktop h-full mt-8 md:mt-0">
                <!-- Left Text -->
                <div class="w-full md:w-1/3 flex flex-col items-center md:items-start text-center md:text-left mb-12 md:mb-0 reveal-on-scroll hero-copy">
                    <div class="bg-surface/80 backdrop-blur-md p-6 rounded-1xl border border-border-subtle natural-shadow">
                        <span class="font-label-sm text-label-sm uppercase text-accent-coral block mb-3 font-bold tracking-widest">
                            {{ $siteContent['home_left_title'] ?? 'NUESTRO OBJETIVO' }}
                        </span>
                        <p class="font-body-md text-body-md text-primary font-medium max-w-xs">
                            {{ $siteContent['home_left_text'] ?? 'Ser los N°1 en este ámbito ganándonos la confianza de nuestros clientes mediante un servicio de calidad y productos premium.' }}
                        </p>
                    </div>
                </div>

                <!-- The Owl -->
                <div class=" w-full md:w-1/3 flex justify-center reveal-on-scroll relative z-20" style="transition-delay: 100ms;">
                    <div class="relative flex items-center justify-center w-full h-[400px] md:h-[500px]">
                        <div class="owl-stage scale-110 md:scale-125" aria-hidden="true" data-owl-stage>
                            <div class="owl-aura" style="background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 60%);"></div>
                            <div class="owl-shadow"></div>
                            <div class="owl-rig" data-owl-rig>
                                <img class="owl-layer owl-layer-base" src="{{ asset('images/KivoCara-cutout.webp') }}" alt="" data-depth="2" draggable="false" />
                                <img class="owl-layer owl-layer-head" src="{{ asset('images/KivoCara-cutout.webp') }}" alt="" data-depth="2.10" draggable="false" />
                                <img class="owl-layer owl-layer-eyes" src="{{ asset('images/KivoCara-cutout.webp') }}" alt="" data-depth="2.18" draggable="false" />
                                <img class="owl-layer owl-layer-beak" src="{{ asset('images/KivoCara-cutout.webp') }}" alt="" data-depth="2.24" draggable="false" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right text -->
                <div class="w-full md:w-1/3 flex flex-col items-center md:items-start text-center md:text-left mb-12 md:mb-0 reveal-on-scroll hero-copy">
                    <div class="bg-surface/80 backdrop-blur-md p-6 rounded-1xl border border-border-subtle natural-shadow">
                        <span class="font-label-sm text-label-sm uppercase text-accent-coral block mb-3 font-bold tracking-widest">
                            {{ $siteContent['home_right_title'] ?? 'KIVO' }}
                        </span>
                        <p class="font-body-md text-body-md text-primary font-medium max-w-xs">
                            {{ $siteContent['home_right_text'] ?? 'Somos un equipo de emprendedores que buscan ofrecerte y traerte lo mejor en productos tecnológicos.' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-center reveal-on-scroll hero-cta pointer-events-auto" style="transition-delay: 200ms;">
                <a href="/catalogo" class="px-8 py-4 bg-surface/80 backdrop-blur-md text-primary rounded-2xl font-label-sm text-label-sm uppercase font-bold hover:bg-white transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 inline-flex items-center gap-3 border border-border-subtle group natural-shadow">
                    Ver Catálogo 
                    <span class="material-symbols-outlined text-[20px] group-hover:text-accent-coral group-hover:translate-x-1 transition-all">arrow_forward</span>
                </a>
            </div>
    </section>

    <!-- Navigation Drawer (Overlay) -->
    <div class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[60] opacity-0 pointer-events-none transition-opacity duration-300" id="drawer-overlay"></div>
        <div class="fixed inset-y-0 left-0 z-[70] w-80 bg-surface transform -translate-x-full transition-transform duration-300 ease-in-out p-6 shadow-2xl flex flex-col" id="drawer">
            <div class="flex justify-between items-center mb-12">
                <h2 class="font-headline-md text-headline-md text-primary">Menú</h2>
                <button class="material-symbols-outlined" id="close-drawer">close</button>
            </div>
            <ul class="space-y-8">
                <li><a class="flex items-center gap-4 text-on-surface-variant font-body-lg text-body-lg hover:pl-2 transition-all duration-300" href="#"><span class="material-symbols-outlined" data-icon="storefront">storefront</span>Ver todo el catálogo</a></li>
                <li><a class="flex items-center gap-4 text-on-surface-variant font-body-lg text-body-lg hover:pl-2 transition-all duration-300" href="#"><span class="material-symbols-outlined" data-icon="new_releases">new_releases</span>Productos Nuevos</a></li>
                <li><a class="flex items-center gap-4 text-on-surface-variant font-body-lg text-body-lg hover:pl-2 transition-all duration-300" href="#"><span class="material-symbols-outlined" data-icon="local_offer">local_offer</span>Productos en Oferta</a></li>
            </ul>
            <div class="mt-auto pt-4 border-t border-border-subtle">
                <p class="font-label-sm text-label-sm text-text-secondary uppercase mb-4">Soporte</p>
                <li><a class="flex items-center gap-4 text-on-surface-variant font-body-lg text-body-lg hover:pl-2 transition-all duration-300" href="#"><span class="material-symbols-outlined" data-icon="support_agent">support_agent</span>Consultas</a></li>                
            </div>
        </div>

        <!-- Seccion Vitrina Premium (Modelos 3D Estáticos) -->
        <section id="premium-showcase" class="relative z-20 w-full flex flex-col justify-center bg-surface mt-20 pt-10 pb-10">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop w-full">
                
                <div class="text-center mb-12">
                    <span class="reveal-on-scroll font-label-sm text-label-sm uppercase text-accent-coral inline-flex items-center gap-2 mb-4 font-bold tracking-widest justify-center">
                        <span class="w-1 h-1 bg-accent-coral animate-ping-slow"></span>
                        Vitrina Premium
                    </span>
                    <h2 class="texto-emergente reveal-on-scroll font-semibold text-display-lg-mobile md:text-display-lg text-primary">
                        Interactúa con el Futuro
                    </h2>
                    <p class="texto-emergente reveal-on-scroll font-body-lg text-body-lg text-text-secondary max-w-xl mx-auto mt-4">
                        Toca, gira y explora nuestros modelos más exclusivos en 3D.
                    </p>
                </div>

                <!-- Contenedor Principal B (Selector + Visor) -->
                <div class="flex flex-col md:flex-row gap-8 items-stretch justify-center max-w-6xl mx-auto">
                    
                    <!-- Selector de modelos (Botones) -->
                    <div class="flex flex-row md:flex-col gap-4 w-full md:w-1/4 overflow-x-auto pb-4 md:pb-0" id="model-selector">
                        
                        <button class="model-btn group flex-shrink-0 flex items-center justify-between p-4 rounded-2xl border-2 border-accent-coral bg-accent-coral/5 transition-all text-left w-64 md:w-full" data-model="{{ asset('images/3d-models/phone_17_pro_max.glb') }}">
                            <div>
                                <h3 class="font-bold text-primary group-hover:text-accent-coral transition-colors">iPhone 17 Pro Max</h3>
                                <p class="text-sm text-text-secondary">Apple</p>
                            </div>
                            <span class="material-symbols-outlined text-accent-coral">chevron_right</span>
                        </button>

                        <button class="model-btn group flex-shrink-0 flex items-center justify-between p-4 rounded-2xl border-2 border-transparent hover:border-border-subtle bg-surface-muted transition-all text-left w-64 md:w-full" data-model="{{ asset('images/3d-models/samsung_galaxy_s25_ultra.glb') }}">
                            <div>
                                <h3 class="font-bold text-primary group-hover:text-accent-coral transition-colors">Samsung S25 Ultra</h3>
                                <p class="text-sm text-text-secondary">Samsung</p>
                            </div>
                            <span class="material-symbols-outlined text-text-secondary group-hover:text-accent-coral transition-colors">chevron_right</span>
                        </button>

                        <button class="model-btn group flex-shrink-0 flex items-center justify-between p-4 rounded-2xl border-2 border-transparent hover:border-border-subtle bg-surface-muted transition-all text-left w-64 md:w-full" data-model="{{ asset('images/3d-models/samsung_galaxy_z_flip_7.glb') }}">
                            <div>
                                <h3 class="font-bold text-primary group-hover:text-accent-coral transition-colors">Galaxy Z Flip 7</h3>
                                <p class="text-sm text-text-secondary">Samsung</p>
                            </div>
                            <span class="material-symbols-outlined text-text-secondary group-hover:text-accent-coral transition-colors">chevron_right</span>
                        </button>

                    </div>
                    
                    <!-- Visor 3D Gigante -->
                    <div class="w-full md:w-3/4 h-[500px] md:h-[600px] bg-gradient-to-tr from-surface-muted to-[#f8f9fa] rounded-3xl overflow-hidden relative shadow-lg border border-border-subtle/50 flex items-center justify-center">
                        <model-viewer 
                            id="main-3d-viewer" 
                            src="{{ asset('images/3d-models/phone_17_pro_max.glb') }}" 
                            alt="Modelo 3D" 
                            auto-rotate 
                            camera-controls 
                            shadow-intensity="1.5" 
                            exposure="1.2"
                            environment-image="neutral"
                            class="w-full h-full">
                        </model-viewer>
                        
                        <!-- Indicador flotante -->
                        <div class="absolute bottom-6 bg-white/90 backdrop-blur px-4 py-2 rounded-full text-xs font-bold text-primary flex items-center gap-2 shadow-md pointer-events-none animate-pulse">
                            <span class="material-symbols-outlined text-[18px] text-accent-coral">360</span> 
                            Desliza para rotar
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Lógica del Selector B -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const viewer = document.getElementById('main-3d-viewer');
                const buttons = document.querySelectorAll('.model-btn');
                
                buttons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        // Limpiar estilos de todos los botones
                        buttons.forEach(b => {
                            b.classList.remove('border-accent-coral', 'bg-accent-coral/5');
                            b.classList.add('border-transparent', 'bg-surface-muted');
                            const icon = b.querySelector('span.material-symbols-outlined');
                            icon.classList.remove('text-accent-coral');
                            icon.classList.add('text-text-secondary');
                        });
                        
                        // Agregar estilos al botón activo
                        btn.classList.remove('border-transparent', 'bg-surface-muted');
                        btn.classList.add('border-accent-coral', 'bg-accent-coral/5');
                        const activeIcon = btn.querySelector('span.material-symbols-outlined');
                        activeIcon.classList.remove('text-text-secondary');
                        activeIcon.classList.add('text-accent-coral');
                        
                        // Cambiar el modelo 3D
                        viewer.src = btn.dataset.model;
                    });
                });
            });
        </script>

        <!-- Seccion Productos Destacados -->
        <section id="destacados" class="relative z-20 w-full flex flex-col justify-center bg-surface mt-30 mb-30 pt-10 pb-10">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop w-full">

                <div class="max-w-4xl mb-10 flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                    <div>
                        <span class="reveal-on-scroll font-label-sm text-label-sm uppercase text-accent-coral inline-flex items-center gap-2 mb-6 font-bold tracking-widest">
                            <span class="w-1 h-1 bg-accent-coral animate-ping-slow"></span>
                            Destacados
                        </span>
                        <h1 class="texto-emergente reveal-on-scroll font-semibold text-display-lg-mobile md:text-display-lg mb-6">
                            Descubre Nuestros<br/>Productos <span class="text-accent-coral">Destacados</span>
                        </h1>
                        <p class="texto-emergente reveal-on-scroll font-body-lg text-body-lg text-text-secondary max-w-xl break-words">
                            Una colección de productos innovadores, seleccionados para quienes conocen de tecnología y buscan lo mejor.
                        </p>
                    </div>
                    <span class="reveal-on-scroll hidden md:inline-flex font-label-sm text-label-sm text-text-secondary items-center gap-2 shrink-0 mb-2">
                        <span class="text-primary font-bold">{{ str_pad($featuredProducts->count(), 2, '0', STR_PAD_LEFT) }}</span>
                        productos seleccionados
                    </span>
                </div>

            </div> <!-- Cierra el contenedor del texto -->

            <!-- CARRUSEL HORIZONTAL PARA PRODUCTOS DESTACADOS -->
            <div class="w-full relative max-w-container-max mx-auto group/carousel">
                <div id="destacados-slider"
                    class="flex overflow-x-auto overflow-y-hidden snap-x snap-mandatory gap-6 md:gap-2 px-margin-mobile md:px-margin-desktop w-full carousel-fade-edges pb-8"
                            style="scrollbar-width: none; -ms-overflow-style: none;">

                            @foreach($featuredProducts as $index => $product)
                                <div class="shrink-0 w-[75vw] sm:w-[280px] md:w-[320px] snap-center md:snap-start group cursor-pointer reveal-on-scroll" style="transition-delay: {{ $index * 100 }}ms;">

                                    <div class="relative aspect-square w-full overflow-hidden rounded-3xl bg-surface-muted transition-all duration-500 natural-shadow group-hover:shadow-2xl group-hover:-translate-y-2">

                                        <img loading="lazy" class="absolute inset-0 object-contain p-8 w-full h-full transition-transform duration-700 group-hover:scale-110 bg-white"
                                            src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : 'https://placehold.co/600x600/eeeeed/666666?text=Sin+Imagen' }}"
                                            alt="{{ $product->name }}" />

                                        <!-- Badge Destacado -->
                                        <div class="absolute top-5 left-5 bg-accent-coral text-white font-label-sm text-[11px] px-3 py-1.5 rounded-md uppercase tracking-wider shadow-md inline-flex items-center gap-1">
                                            <span class="material-symbols-outlined transform scale-75">favorite</span>
                                            Destacado
                                        </div>

                                        <!-- Overlay Vista rápida -->
                                        <div class="absolute inset-x-0 bottom-0 p-5 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 flex justify-center">
                                            <button class="open-quick-view bg-white/95 backdrop-blur-md px-4 py-2 rounded-full font-label-sm text-label-sm font-bold text-primary inline-flex items-center gap-2 shadow-lg hover:bg-primary hover:text-white transition-colors" data-product="{{ json_encode($product) }}">
                                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                                Vista rápida
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex justify-between items-start px-2">
                                        <div>
                                            <h3 class="text-xl font-semibold text-primary group-hover:text-accent-coral transition-colors duration-300">{{ $product->name }}</h3>
                                            <span class="inline-block font-label-sm text-[11px] text-text-secondary uppercase mt-2 bg-surface-muted px-3 py-1 rounded-full">
                                                {{ $product->category ? $product->category->name : 'General' }}
                                            </span>
                                        </div>
                                        <!-- Precio -->
                                        <div class="bg-white/70 backdrop-blur-md px-4 py-2 rounded-sm shadow-lg font-label-sm font-bold text-neutral-500 flex items-center justify-center">
                                            ${{ number_format($product->price, 2) }}
                                        </div>
                                    
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
            </section>

        <!-- Sección Invitación al Catálogo -->
        <section id="invitacion-catalogo" class="relative w-full bg-surface mt-30 pb-30 overflow-hidden">

            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop text-center relative">

                <span class="reveal-on-scroll font-label-sm text-label-sm uppercase text-accent-coral inline-flex items-center gap-2 mb-6 font-bold tracking-widest">
                    <span class="w-1 h-1 bg-accent-coral animate-ping-slow"></span>
                    Catálogo
                </span>

                <h1 class="texto-emergente reveal-on-scroll font-semibold text-display-lg-mobile md:text-display-lg text-primary mb-6" style="transition-delay: 60ms;">
                    Todo un mundo de <span class="text-accent-coral">tecnología</span>
                </h1>
                <p class="texto-emergente reveal-on-scroll font-body-lg text-body-lg text-text-secondary max-w-2xl mx-auto mb-16" style="transition-delay: 120ms;">
                    Explora nuestra colección completa de dispositivos, accesorios y gadgets seleccionados para ofrecerte la mejor experiencia.
                </p>

                <!-- Wrapper relativo: grid + botón flotante -->
                <div class="relative">

                    <!-- Bento Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 grid-rows-2 gap-4 md:gap-3">

                        <!-- Item 1 (Grande) -->
                        <div class="tilt-card reveal-on-scroll col-span-2 md:col-span-2 row-span-2 aspect-square overflow-hidden group/zoom cursor-pointer shadow-xl relative rounded-[2rem]" style="transition-delay: 180ms;">
                            <img loading="lazy" src="{{ asset('images/accesorios/Celulares.png') }}" class="w-full h-full object-cover bg-surface-muted transition-transform duration-700 group-hover/zoom:scale-110" alt="Smartphones">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-black/0 opacity-0 group-hover/zoom:opacity-100 transition-opacity duration-500"></div>
                            <div class="absolute bottom-0 left-0 p-6 translate-y-4 opacity-0 group-hover/zoom:translate-y-0 group-hover/zoom:opacity-100 transition-all duration-500">
                                <span class="text-white font-label-sm text-label-sm uppercase font-bold tracking-wide inline-flex items-center gap-2">
                                    Smartphones
                                </span>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="tilt-card reveal-on-scroll aspect-square overflow-hidden group/zoom cursor-pointer shadow-md relative rounded-3xl" style="transition-delay: 240ms;">
                            <img loading="lazy" src="{{ asset('images/accesorios/Cases.png') }}" class="w-full h-full object-cover bg-surface-muted transition-transform duration-700 group-hover/zoom:scale-110" alt="Fundas y protección">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-black/0 opacity-0 group-hover/zoom:opacity-100 transition-opacity duration-500"></div>
                            <span class="absolute bottom-4 right-4 text-white font-label-sm text-label-sm uppercase font-bold translate-y-2 opacity-0 group-hover/zoom:translate-y-0 group-hover/zoom:opacity-100 transition-all duration-500">Fundas</span>
                        </div>

                        <!-- Item 3 -->
                        <div class="tilt-card reveal-on-scroll aspect-square overflow-hidden group/zoom cursor-pointer shadow-md relative rounded-3xl" style="transition-delay: 300ms;">
                            <img loading="lazy" src="{{ asset('images/accesorios/Perifericos.png') }}" class="w-full h-full object-cover bg-surface-muted transition-transform duration-700 group-hover/zoom:scale-110" alt="Periféricos">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-black/0 opacity-0 group-hover/zoom:opacity-100 transition-opacity duration-500"></div>
                            <span class="absolute bottom-4 right-4 text-white font-label-sm text-label-sm uppercase font-bold translate-y-2 opacity-0 group-hover/zoom:translate-y-0 group-hover/zoom:opacity-100 transition-all duration-500">Periféricos</span>
                        </div>

                        <!-- Item 4 (Ancho) -->
                        <div class="tilt-card reveal-on-scroll col-span-2 md:col-span-2 aspect-[2/1] overflow-hidden group/zoom cursor-pointer shadow-lg relative rounded-3xl" style="transition-delay: 360ms;">
                            <img loading="lazy" src="{{ asset('images/accesorios/acesorios.png') }}" class="w-full h-full object-cover bg-surface-muted transition-transform duration-700 group-hover/zoom:scale-110" alt="Accesorios">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-black/0 opacity-0 group-hover/zoom:opacity-100 transition-opacity duration-500"></div>
                            <span class="absolute bottom-4 right-4 text-white font-label-sm text-label-sm uppercase font-bold translate-y-2 opacity-0 group-hover/zoom:translate-y-0 group-hover/zoom:opacity-100 transition-all duration-500">Accesorios</span>
                        </div>
                    </div>

                    <!-- Botón flotante, superpuesto entre el grid y el texto -->
                    <div class="absolute left-0 w-full -bottom-9 flex justify-center z-20 pointer-events-none">
                        <div class="pointer-events-auto">
                            <a href="#catalogo" class="px-9 py-4 bg-surface/90 backdrop-blur-md text-primary rounded-2xl font-label-sm text-label-sm uppercase font-bold hover:bg-white transition-all duration-300 shadow-2xl hover:shadow-accent-coral/20 transform hover:-translate-y-1 inline-flex items-center gap-3 border border-border-subtle group natural-shadow animate-float">
                                Ver Catálogo
                                <span class="material-symbols-outlined text-[20px] group-hover:text-accent-coral group-hover:translate-x-1 transition-all">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="marcas-aliadas" class="relative z-20 w-full bg-surface py-12 md:py-14 overflow-hidden">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop text-center mb-12">
                <span class="reveal-on-scroll font-label-sm text-label-sm uppercase text-accent-coral inline-flex items-center gap-2 mb-4 font-bold tracking-widest justify-center">
                    <span class="w-1 h-1 bg-accent-coral animate-ping-slow"></span>
                    Marcas Aliadas
                </span>
                <p class="texto-emergente revea l-on-scroll font-body-lg text-body-lg text-text-secondary max-w-xl mx-auto">
                    Trabajamos con las marcas que lideran la industria tecnológica a nivel mundial.
                </p>
            </div>

            <!-- Marquee infinito -->
            <div class="relative w-full marquee-fade-edges">
                <div class="marquee-track flex items-center gap-16 md:gap-24 w-max">

                    {{-- Se repite la lista 3 veces para que el loop sea continuo (seamless) --}}
                    @for ($i = 0; $i < 3; $i++)
                        @foreach ($brands as $brand)
                            <div class="flex-none flex items-center justify-center h-10 md:h-12 grayscale opacity-40 hover:opacity-100 hover:grayscale-0 transition-all duration-500">
                                <img src="{{ asset('storage/' . $brand->logo_path) }}"
                                    alt="{{ $brand->name }}"
                                    class="h-full w-auto object-contain">
                            </div>
                        @endforeach
                    @endfor

                </div>
            </div>
        </section>

<style>
    .marquee-fade-edges {
        -webkit-mask-image: linear-gradient(to right, transparent 0, black 8%, black 92%, transparent 100%);
        mask-image: linear-gradient(to right, transparent 0, black 8%, black 92%, transparent 100%);
    }

    .marquee-track {
        animation: marquee-scroll 32s linear infinite;
    }

    /* Se pausa al pasar el mouse, buen detalle de usabilidad */
    #marcas-aliadas:hover .marquee-track {
        animation-play-state: paused;
    }

    @keyframes marquee-scroll {
        from { transform: translateX(0); }
        to   { transform: translateX(-50%); }
    }

    /* Respeta a usuarios que piden menos movimiento */
    @media (prefers-reduced-motion: reduce) {
        .marquee-track {
            animation: none;
        }
    }
</style>   
        
        <!-- Sección Sobre Nosotros -->
        <section id="sobre-nosotros" class="relative w-full bg-surface mt-30 mb-30"> 
            <div class="w-full max-w-[1600px] mx-auto px-margin-mobile md:px-8 xl:px-16 reveal-on-scroll">
                <div class="flex flex-col lg:flex-row justify-between items-stretch gap-12 lg:gap-24 mb-16">
                    <!-- Izquierda: Título Gigante -->
                    <div class="w-full lg:w-[60%]">
                        <span class="reveal-on-scroll font-label-sm text-label-sm uppercase text-accent-coral inline-flex items-center gap-2 mb-6 font-bold tracking-widest">
                            <span class="w-1 h-1 bg-accent-coral animate-ping-slow"></span>
                            Sobre Nosotros
                        </span>
                        <h2 class="texto-emergente text-[14vw] lg:text-[6.5vw] font-black leading-[0.85] tracking-tighter text-primary uppercase break-words">
                            {{ $siteContent['about_title'] ?? 'APASiONADOS POR LA TECNOLOGÍA' }}
                        </h2>
                    </div>
                    
                    <!-- Derecha: Texto y Botones -->
                    <div class="w-full lg:w-[40%] flex flex-col items-start justify-end lg:pt-12 ">
                        <p class="texto-emergente font-body-lg text-body-lg text-text-secondary mb-10 leading-relaxed">
                            {{ $siteContent['about_text'] ?? 'Tecnología que inspira. En KIVO curamos experiencias a través de gadgets premium, donde el diseño excepcional y la potencia se encuentran."' }}
                        </p>
                        
                        <div class="flex flex-wrap items-center gap-6">
                            <!-- Botón de WhatsApp -->
                            <a href="https://wa.me/TUNUMERODEWHATSAPP" target="_blank" class="px-8 py-4 backdrop-blur-md text-accent-coral rounded-2xl font-label-sm text-label-sm uppercase font-bold hover:bg-opacity-90 transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-1 flex items-center justify-center gap-2 group">
                                Contáctanos
                                <span class="material-symbols-outlined text-[18px] transition-transform group-hover:translate-x-1"><x-si-whatsapp class="w-5 h-5" /></span>
                            </a>
                            
                            <!-- Redes Sociales -->
                            <div class="flex gap-3 items-center">
                                <a href="#" target="_blank" class="w-12 h-12 rounded-2xl border border-border-subtle flex items-center justify-center text-primary hover:text-accent-coral hover:border-accent-coral hover:bg-surface-muted hover:-translate-y-1 hover:shadow-md transition-all duration-300" title="Instagram">
                                    <x-si-instagram class="w-5 h-5" />
                                </a>
                                <a href="#" target="_blank" class="w-12 h-12 rounded-2xl border border-border-subtle flex items-center justify-center text-primary hover:text-accent-coral hover:border-accent-coral hover:bg-surface-muted hover:-translate-y-1 hover:shadow-md transition-all duration-300" title="TikTok">
                                    <x-si-tiktok class="w-5 h-5" />
                                </a>
                                <a href="#" target="_blank" class="w-12 h-12 rounded-2xl border border-border-subtle flex items-center justify-center text-primary hover:text-accent-coral hover:border-accent-coral hover:bg-surface-muted hover:-translate-y-1 hover:shadow-md transition-all duration-300" title="Facebook">
                                    <x-si-facebook class="w-5 h-5" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cursor-pointer w-full aspect-[16/9] md:aspect-[32/9] rounded-2xl overflow-hidden natural-shadow group mt-16">
                    <img loading="lazy" class="object-cover w-full h-full transition-transform duration-1000 group-hover:scale-105" 
                        src="{{ asset('images//imgAbout.png') }}" 
                        alt="Equipo Kivo" />
                </div>
            </div>
        </section>

        <section id="por-que-elegirnos" class="relative z-20 w-full bg-surface py-24 md:py-14">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">

                <div class="max-w-2xl mb-16">
                    <span class="reveal-on-scroll font-label-sm text-label-sm uppercase text-accent-coral inline-flex items-center gap-2 mb-6 font-bold tracking-widest">
                        <span class="w-1 h-1 bg-accent-coral animate-ping-slow"></span>
                        Por qué elegirnos
                    </span>
                    <h2 class="texto-emergente reveal-on-scroll font-semibold text-display-lg-mobile md:text-display-lg text-primary mb-6">
                        Comprar con nosotros es <span class="text-accent-coral">tranquilidad</span>
                    </h2>
                    <p class="texto-emergente reveal-on-scroll font-body-lg text-body-lg text-text-secondary">
                        Cuatro razones por las que miles de clientes confían en nuestra tienda.
                    </p>
                </div>

                <!-- Franja de beneficios con divisores -->
                <div class="grid grid-cols-2 md:grid-cols-4 border-t border-border-subtle">

                    @php
                        $benefits = [
                            [
                                'icon' => 'local_shipping',
                                'title' => 'Envíos a todo el país',
                                'text' => 'Recibe tu pedido estés donde estés, con seguimiento en tiempo real.',
                            ],
                            [
                                'icon' => 'verified_user',
                                'title' => 'Garantía oficial',
                                'text' => 'Hasta 3 meses de garantía respaldada directamente por la marca.',
                            ],
                            [
                                'icon' => 'credit_card',
                                'title' => 'Pagos seguros',
                                'text' => 'Paga en cuotas o al contado, con toda la protección de tus datos.',
                            ],
                            [
                                'icon' => 'support_agent',
                                'title' => 'Soporte especializado',
                                'text' => 'Técnicos certificados listos para ayudarte antes y después de tu compra.',
                            ],
                        ];
                    @endphp

                    @foreach ($benefits as $index => $benefit)
                        <div class="benefit-card reveal-on-scroll group relative border-b border-r border-border-subtle {{ $index == 0 || $index == 2 ? '' : '' }} p-8 md:p-10 flex flex-col items-start gap-6 overflow-hidden transition-colors duration-500"
                            style="transition-delay: {{ $index * 100 }}ms;">

                            <!-- Numero de fondo -->
                            <span class="absolute -top-2 right-4 font-semibold text-6xl text-text-secondary/5 select-none transition-colors duration-500 group-hover:text-accent-coral/10">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>

                            <div class="w-14 h-14 rounded-2xl bg-surface-muted flex items-center justify-center transition-all duration-500 group-hover:bg-accent-coral group-hover:-rotate-6 group-hover:scale-110">
                                <span class="material-symbols-outlined text-[26px] text-primary transition-colors duration-500 group-hover:text-white">
                                    {{ $benefit['icon'] }}
                                </span>
                            </div>

                            <div class="relative z-10">
                                <h3 class="text-lg md:text-xl font-semibold text-primary mb-2">
                                    {{ $benefit['title'] }}
                                </h3>
                                <p class="font-body-sm text-body-sm text-text-secondary leading-relaxed">
                                    {{ $benefit['text'] }}
                                </p>
                            </div>

                            <!-- Linea inferior que se dibuja al hover -->
                            <span class="absolute bottom-0 left-0 h-[2px] bg-accent-coral w-0 group-hover:w-full transition-all duration-500"></span>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    <!-- Footer -->
    <footer class="bg-neutral-100 relative z-30 w-full pt-16 pb-8 md:pt-24 border-t border-border-subtle rounded-t-[2rem] md:rounded-t-[4rem] shadow-lg"> 
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-col h-full">
            
            <!-- Top Grid Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-8 mb-24">
                
                <!-- Column 1: Brand Info -->
                <div class="flex flex-col pr-0 lg:pr-8">
                    <h3 class="font-display-md text-display-md-mobile md:text-display-md text-primary mb-4 leading-tight">
                        Innovación. Tecnología. <br/>// Calidad Premium.
                    </h3>
                    <p class="font-body-md text-body-md text-text-secondary">
                        Nos asociamos con las mejores marcas tecnológicas para traerte un catálogo vanguardista, diseñado para superar cualquier expectativa.
                    </p>
                </div>
                
                <!-- Column 2: Navigation Links -->
                <div class="flex flex-col border-t border-border-subtle">
                    <a href="#inicio" class="group flex justify-between items-center py-5 border-b border-border-subtle text-primary font-label-md text-label-md uppercase transition-colors hover:text-accent-coral">
                        <span>Inicio</span>
                        <span class="material-symbols-outlined text-[18px] transition-transform group-hover:-translate-y-1 group-hover:translate-x-1">arrow_outward</span>
                    </a>
                    <a href="#destacados" class="group flex justify-between items-center py-5 border-b border-border-subtle text-primary font-label-md text-label-md uppercase transition-colors hover:text-accent-coral">
                        <span>Destacados</span>
                        <span class="material-symbols-outlined text-[18px] transition-transform group-hover:-translate-y-1 group-hover:translate-x-1">arrow_outward</span>
                    </a>
                    <a href="#catalogo" class="group flex justify-between items-center py-5 border-b border-border-subtle text-primary font-label-md text-label-md uppercase transition-colors hover:text-accent-coral">
                        <span>Catálogo</span>
                        <span class="material-symbols-outlined text-[18px] transition-transform group-hover:-translate-y-1 group-hover:translate-x-1">arrow_outward</span>
                    </a>
                    <a href="#sobre-nosotros" class="group flex justify-between items-center py-5 border-b border-border-subtle text-primary font-label-md text-label-md uppercase transition-colors hover:text-accent-coral">
                        <span>Sobre Nosotros</span>
                        <span class="material-symbols-outlined text-[18px] transition-transform group-hover:-translate-y-1 group-hover:translate-x-1">arrow_outward</span>
                    </a>
                </div>
                
                <!-- Column 3: Contact / CTA -->
                <div class="flex flex-col lg:pl-12">
                    <h3 class="font-display-md text-display-md-mobile md:text-display-md text-primary mb-4 leading-tight">
                        ¿Listo para renovar tu ecosistema?
                    </h3>
                    <p class="font-body-md text-body-md text-text-secondary mb-6">
                        Explora nuestro catálogo y descubre cómo la tecnología puede transformar tu día a día.
                    </p>
                    <a href="#catalogo" class="px-8 py-4 bg-surface/80 backdrop-blur-md text-primary rounded-2xl font-label-sm text-label-sm uppercase font-bold hover:bg-white transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 inline-flex items-center gap-3 border border-border-subtle group natural-shadow">
                        Ver Catálogo 
                        <span class="material-symbols-outlined text-[20px] group-hover:text-accent-coral group-hover:translate-x-1 transition-all">arrow_forward</span>
                    </a>
                </div>
                
            </div>

            <!-- Middle Section: Address & Copyright -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12 group reveal-on-scroll">
                <div class="text-text-secondary font-label-sm text-label-sm">
                    <p>Tienda Virtual</p>
                    <p>contacto@kivo.com</p>
                </div>
                <div class="flex flex-col md:flex-row gap-2 md:gap-12 text-text-secondary font-label-sm text-label-sm uppercase group reveal-on-scroll">
                    <p>KIVO © 2026</p>
                </div>
            </div>

            <!-- Bottom Huge Text -->
            <div class="w-full overflow-hidden flex justify-center items-end border-t border-border-subtle pt-8 group reveal-on-scroll">
                <h1 class="texto-emergente font-black text-neutral-900 leading-[0.75] tracking-tighter w-full text-center m-0 p-0" style="font-size: clamp(5rem, 24vw, 20rem);">KIVO</h1>
            </div>

        </div>
    </footer>

    </main> <!-- Fin stacking-container -->
    
    <!-- BottomNavBar (Mobile Only) -->
    <nav class="md:hidden fixed bottom-0 w-full h-16 bg-surface border-t border-border-subtle flex justify-around items-center z-40 shadow-sm px-4">
        <button class="flex flex-col items-center text-primary"><span class="material-symbols-outlined" data-icon="bolt">bolt</span><span class="text-[10px] uppercase font-bold">New</span></button>
        <button class="flex flex-col items-center text-outline"><span class="material-symbols-outlined" data-icon="bar_chart_4_bars">bar_chart_4_bars</span><span class="text-[10px] uppercase">Charts</span></button>
        <button class="flex flex-col items-center text-outline"><span class="material-symbols-outlined" data-icon="search">search</span><span class="text-[10px] uppercase">Search</span></button>
        <button class="flex flex-col items-center text-outline"><span class="material-symbols-outlined" data-icon="person">person</span><span class="text-[10px] uppercase">Account</span></button>
    </nav>

    @include('components.quick-view-drawer')

</body></html>