<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>KIVO | Catálogo Web Artículos Tecnólogicos</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

    <!-- Icono del sitio (Favicon) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/white-l.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/white-l.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-surface text-on-surface font-body-md">
    <!-- TopAppBar -->
    <header class="bg-surface sticky top-0 z-50">
        <div class="flex justify-between items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="flex items-center gap-4">
                <button class="material-symbols-outlined text-primary p-2 Active: scale-95 transition-transform" data-icon="menu" id="menu-trigger">menu</button>
                <div class="font-display-lg text-display-lg-mobile tracking-tighter text-primary">KIVO</div>
            </div>
            <nav class="hidden md:flex gap-8">
                <a class="font-label-sm text-label-sm uppercase text-on-surface hover:text-secondary transition-colors duration-200" href="#inicio">Inicio</a>
                <a class="font-label-sm text-label-sm uppercase text-on-surface hover:text-secondary transition-colors duration-200" href="#destacados">Destacados</a>
                <a class="font-label-sm text-label-sm uppercase text-on-surface hover:text-secondary transition-colors duration-200" href="#catalogo">Catálogo</a>
                <a class="font-label-sm text-label-sm uppercase text-on-surface hover:text-secondary transition-colors duration-200" href="#sobre-nosotros">Nosotros</a>
            </nav>
            <div class="flex items-center gap-4">
                <button class="material-symbols-outlined text-primary p-2 Active: scale-95 transition-transform" data-icon="search">search</button>
            </div>
        </div>
    </header>
    <main id="inicio" class="relative w-full">
    <!-- Hero Section -->
    <section class="relative z-10 w-full min-h-[calc(100vh-80px)] flex flex-col items-center justify-center bg-surface pt-10 pb-20 overflow-hidden">
        <!-- Huge Background Text -->
        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none z-0 leading-none select-none overflow-hidden opacity-90">
            <h1 class="text-[22vw] md:text-[18vw] font-black tracking-tighter text-primary whitespace-nowrap m-0 p-0 leading-[0.85]">KIVO</h1>
            <h1 class="text-[22vw] md:text-[18vw] font-black tracking-tighter text-primary whitespace-nowrap m-0 p-0 leading-[0.85]">CATÁLOGO</h1>
        </div>

        <!-- Center content: The Owl and side elements -->
            <div class="relative z-10 w-full max-w-container-max mx-auto flex flex-col md:flex-row items-center justify-between px-margin-mobile md:px-margin-desktop h-full mt-8 md:mt-0">
                <!-- Left Text -->
                <div class="w-full md:w-1/3 flex flex-col items-center md:items-start text-center md:text-left mb-12 md:mb-0 reveal-on-scroll">
                    <div class="bg-surface/80 backdrop-blur-md p-6 rounded-2xl border border-border-subtle natural-shadow">
                        <span class="font-label-sm text-label-sm uppercase text-accent-coral block mb-3 font-bold tracking-widest">
                            {{ $siteContent['home_left_title'] ?? 'NUESTRO OBJETIVO' }}
                        </span>
                        <p class="font-body-md text-body-md text-primary font-medium max-w-xs">
                            {{ $siteContent['home_left_text'] ?? 'Ser los N°1 en este ámbito ganándonos la confianza de nuestros clientes mediante un servicio de calidad y productos premium.' }}
                        </p>
                    </div>
                </div>

                <!-- The Owl -->
                <div class="w-full md:w-1/3 flex justify-center reveal-on-scroll relative z-20" style="transition-delay: 100ms;">
                    <div class="relative flex items-center justify-center w-full h-[400px] md:h-[500px]">
                        <div class="owl-stage scale-110 md:scale-125" aria-hidden="true" data-owl-stage>
                            <div class="owl-aura" style="background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 60%);"></div>
                            <div class="owl-shadow"></div>
                            <div class="owl-rig" data-owl-rig>
                                <img class="owl-layer owl-layer-base" src="{{ asset('images/KivoCara-cutout.png') }}" alt="" data-depth="2" draggable="false" />
                                <img class="owl-layer owl-layer-head" src="{{ asset('images/KivoCara-cutout.png') }}" alt="" data-depth="2.10" draggable="false" />
                                <img class="owl-layer owl-layer-eyes" src="{{ asset('images/KivoCara-cutout.png') }}" alt="" data-depth="2.18" draggable="false" />
                                <img class="owl-layer owl-layer-beak" src="{{ asset('images/KivoCara-cutout.png') }}" alt="" data-depth="2.24" draggable="false" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right text -->
                <div class="w-full md:w-1/3 flex flex-col items-center md:items-start text-center md:text-left mb-12 md:mb-0 reveal-on-scroll">
                    <div class="bg-surface/80 backdrop-blur-md p-6 rounded-2xl border border-border-subtle natural-shadow">
                        <span class="font-label-sm text-label-sm uppercase text-accent-coral block mb-3 font-bold tracking-widest">
                            {{ $siteContent['home_right_title'] ?? 'KIVO' }}
                        </span>
                        <p class="font-body-md text-body-md text-primary font-medium max-w-xs">
                            {{ $siteContent['home_right_text'] ?? 'Somos un equipo de emprendedores que buscan ofrecerte y traerte lo mejor en productos tecnológicos.' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-center reveal-on-scroll" style="transition-delay: 200ms;">
                <a href="#catalogo" class="px-8 py-4 bg-surface/80 backdrop-blur-md text-primary rounded-full font-label-sm text-label-sm uppercase font-bold hover:bg-white transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 inline-flex items-center gap-3 border border-border-subtle group natural-shadow">
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
                <li><a class="flex items-center gap-4 text-on-surface-variant font-body-lg text-body-lg hover:pl-2 transition-all duration-300" href="#"><span class="material-symbols-outlined" data-icon="auto_stories">auto_stories</span>Pendiente</a></li>
                <li><a class="flex items-center gap-4 text-on-surface-variant font-body-lg text-body-lg hover:pl-2 transition-all duration-300" href="#"><span class="material-symbols-outlined" data-icon="info">info</span>Pendiente</a></li>
                <li><a class="flex items-center gap-4 text-on-surface-variant font-body-lg text-body-lg hover:pl-2 transition-all duration-300" href="#"><span class="material-symbols-outlined" data-icon="edit_note">edit_note</span>Pendiente</a></li>
            </ul>
            <div class="mt-auto pt-12 border-t border-border-subtle">
                <p class="font-label-sm text-label-sm text-text-secondary uppercase mb-4">Soporte</p>
                <a class="block text-on-surface mb-2" href="#">Ayuda</a>
                
            </div>
        </div>

        <!-- Destacados Section Wrapper -->
        <div id="destacados-wrapper" class="relative h-[350vh] w-full">
            <section id="destacados" class="sticky top-20 h-[calc(100vh-50px)] overflow-hidden z-20 w-full flex flex-col justify-center bg-surface pt-10 pb-10 rounded-t-[3rem] md:rounded-t-[4rem] shadow-[0_-15px_40px_rgba(0,0,0,0.08)] border-t border-border-subtle">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <!-- BENTO GRID PARA PRODUCTOS DESTACADOS -->
            <div class="max-w-4xl mb-12">
                <h1 class="font-display-lg text-display-lg-mobile md:text-display-lg mb-6 reveal-on-scroll">
                    Descubre    Nuestros</span><br/>Productos <span class="text-accent-coral">Destacados.</span>
                </h1>
                <p class="font-body-lg text-body-lg text-text-secondary max-w-xl reveal-on-scroll" style="transition-delay: 100ms;">
                    Una colección de productos innovadores, seleccionados para quienes conocen de tecnología y buscan lo mejor.
                </p>
            </div>
            <!-- CARRUSEL HORIZONTAL PARA PRODUCTOS DESTACADOS -->
            <div class="w-full relative max-w-container-max mx-auto group/carousel">
                <div id="destacados-slider" class="flex overflow-hidden gap-6 md:gap-8 px-margin-mobile md:px-margin-desktop w-full select-none" 
                     style="scrollbar-width: none; -ms-overflow-style: none;">
                    
                    @foreach($featuredProducts as $index => $product)
                        <!-- Tarjeta del Producto (Todas iguales: grandes y cuadradas) -->
                        <div class="flex-none w-[85vw] md:w-[320px] snap-center md:snap-start group cursor-pointer reveal-on-scroll" style="transition-delay: {{ $index * 100 }}ms;">
                            
                            <!-- Imagen y contenedor -->
                            <div class="relative aspect-square w-full overflow-hidden rounded-2xl bg-surface-muted transition-all duration-500 natural-shadow group-hover:shadow-2xl">
                                
                                <img class="absolute inset-0 object-contain p-8 w-full h-full transition-transform duration-700 group-hover:scale-110 bg-white" 
                                     src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : 'https://placehold.co/600x600/eeeeed/666666?text=Sin+Imagen' }}" 
                                     alt="{{ $product->name }}" />
                                
                                <!-- Etiqueta Destacado -->
                                <div class="absolute top-5 left-5 bg-accent-coral text-white font-label-sm text-[11px] px-3 py-1.5 rounded-md uppercase tracking-wider shadow-md">
                                    Destacado
                                </div>

                                <!-- Precio flotante -->
                                <div class="absolute bottom-5 right-5 bg-white/95 backdrop-blur-md px-4 py-2 rounded-full shadow-lg font-label-sm font-bold z-10 text-primary">
                                    ${{ number_format($product->price, 2) }}
                                </div>
                            </div>
                            
                            <!-- Textos debajo de la imagen -->
                            <div class="mt-6 flex justify-between items-start px-2">
                                <div>
                                    <h3 class="font-headline-md text-headline-md text-primary group-hover:text-accent-coral transition-colors duration-300">{{ $product->name }}</h3>
                                    <p class="font-label-sm text-label-sm text-text-secondary uppercase mt-2">
                                        {{ $product->category ? $product->category->name : 'General' }}
                                    </p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-surface-muted flex items-center justify-center group-hover:bg-primary group-hover:text-on-primary transition-colors duration-300 shadow-sm">
                                    <span class="material-symbols-outlined text-[24px]">arrow_outward</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                </div>
            </div>
            </div>
        </section>
        </div> <!-- Cierra destacados-wrapper -->

        <!-- Product Grid Section -->
        <section id="catalogo" class="relative z-30 w-full bg-surface pt-16 pb-24 rounded-t-[3rem] md:rounded-t-[4rem] shadow-[0_-15px_40px_rgba(0,0,0,0.08)] border-t border-border-subtle">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
                <div class="text-center mb-16 max-w-2xl mx-auto">
                    <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg mb-4 reveal-on-scroll">
                        Mira Todo Lo <span class="text-accent-coral"> Que Tenemos </span> Para Ofrecerte.
                    </h2>
                    <p class="font-body-md text-body-md text-text-secondary reveal-on-scroll" style="transition-delay: 100ms;">
                        Explora la varidade de productos que tenemos para tí.
                    </p>
                </div>
                <!-- Filters -->
                <div class="flex justify-center gap-4 mb-12 flex-wrap">
                    <button class="px-6 py-2 rounded-full border border-primary bg-primary text-on-primary font-label-sm text-label-sm uppercase transition-all duration-200">Todos</button>
                    <button class="px-6 py-2 rounded-full border border-border-subtle bg-transparent text-on-surface font-label-sm text-label-sm uppercase hover:border-primary transition-all duration-200">Productos nuevos</button>
                    <button class="px-6 py-2 rounded-full border border-border-subtle bg-transparent text-on-surface font-label-sm text-label-sm uppercase hover:border-primary transition-all duration-200">Classic</button>
                </div>
                <!-- Product Items (Catálogo General Dinámico) -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-y-12 md:gap-y-16 gap-x-4 md:gap-x-gutter">
                    
                    @foreach($allProducts as $index => $product)
                        @php
                            // MAGIA: ¿Es un producto nuevo? (Subido en los últimos 7 días)
                            $isNew = $product->created_at->diffInDays(now()) <= 7;
                        @endphp
                        
                        <div class="group reveal-on-scroll" style="transition-delay: {{ ($index % 3) * 100 }}ms;">
                            <!-- Contenedor de la Imagen -->
                            <div class="relative aspect-[4/3] mb-4 md:mb-6 rounded-2xl bg-surface-muted overflow-hidden transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1">
                                
                                @if($isNew)
                                    <!-- Etiqueta de NUEVO (Calculada automáticamente) -->
                                    <span class="absolute top-3 left-3 md:top-5 md:left-5 bg-accent-coral text-white font-label-sm text-[9px] md:text-[11px] px-2 md:px-3 py-1 md:py-1.5 rounded-md shadow-sm z-10 tracking-widest uppercase">NUEVO</span>
                                @endif
                                
                                <img class="absolute inset-0 w-full h-full object-contain p-6 md:p-8 bg-white transition-transform duration-700 group-hover:scale-110" 
                                     src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : 'https://placehold.co/600x800/eeeeed/666666?text=Sin+Imagen' }}" 
                                     alt="{{ $product->name }}" />
                                
                                <!-- Botón flotante del carrito -->
                                <div class="absolute bottom-3 right-3 md:bottom-5 md:right-5 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                    <button class="bg-primary text-white p-2.5 md:p-3.5 rounded-full shadow-lg hover:bg-accent-coral transition-colors flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[20px] md:text-[24px]">add_shopping_cart</span>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Textos del Producto -->
                            <div class="flex flex-col justify-start items-start gap-1">
                                <h4 class="font-headline-md text-body-md md:text-headline-md text-primary group-hover:text-accent-coral transition-colors duration-300 line-clamp-2 md:line-clamp-1">
                                    {{ $product->name }}
                                </h4>
                                <p class="font-label-sm text-[11px] md:text-label-sm text-text-secondary uppercase">
                                    {{ $product->category ? $product->category->name : 'General' }}
                                </p>
                                <span class="font-body-lg text-body-md md:text-body-lg font-bold text-primary mt-2">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                <div class="flex justify-center mt-12 group reveal-on-scroll">
                    <a href="https://wa.me/TUNUMERODEWHATSAPP" target="_blank" class="px-8 py-4 bg-accent-coral text-white rounded-full font-label-sm text-label-sm uppercase font-bold hover:bg-opacity-90 transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-1 flex items-center justify-center gap-2 group">
                            Ver todo el catálogo
                            <span class="material-symbols-outlined text-[18px] transition-transform group-hover:translate-x-1"><x-si-whatsapp class="w-5 h-5" /></span>
                        </a>
                </div>
            </div>
        </section>
        
        <!-- Sección Sobre Nosotros -->
        <section id="sobre-nosotros" class="relative z-40 w-full bg-surface pt-16 pb-24 rounded-t-[3rem] md:rounded-t-[4rem] shadow-[0_-15px_40px_rgba(0,0,0,0.08)] border-t border-border-subtle">
            <div class="w-full max-w-[1600px] mx-auto px-margin-mobile md:px-8 xl:px-16 reveal-on-scroll">
            <div class="flex flex-col lg:flex-row justify-between items-stretch gap-12 lg:gap-24 mb-16">
                <!-- Izquierda: Título Gigante -->
                <div class="w-full lg:w-[60%]">
                    <span class="font-label-sm text-label-sm uppercase text-accent-coral block mb-6 font-bold tracking-widest">Sobre Nosotros</span>
                    <h2 class="text-[14vw] lg:text-[6.5vw] font-black leading-[0.85] tracking-tighter text-primary uppercase break-words">
                        {{ $siteContent['about_title'] ?? 'APASiONADOS POR LA TECNOLOGÍA' }}
                    </h2>
                </div>
                
                <!-- Derecha: Texto y Botones -->
                <div class="w-full lg:w-[40%] flex flex-col items-start justify-end lg:pt-12 ">
                    <p class="font-body-lg text-body-lg text-text-secondary mb-10 leading-relaxed">
                        {{ $siteContent['about_text'] ?? 'Tecnología que inspira. En KIVO curamos experiencias a través de gadgets premium, donde el diseño excepcional y la potencia se encuentran."' }}
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-6">
                        <!-- Botón de WhatsApp -->
                        <a href="https://wa.me/TUNUMERODEWHATSAPP" target="_blank" class="px-8 py-4 bg-accent-coral text-white rounded-full font-label-sm text-label-sm uppercase font-bold hover:bg-opacity-90 transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-1 flex items-center justify-center gap-2 group">
                            Contáctanos
                            <span class="material-symbols-outlined text-[18px] transition-transform group-hover:translate-x-1"><x-si-whatsapp class="w-5 h-5" /></span>
                        </a>
                        
                        <!-- Redes Sociales -->
                        <div class="flex gap-3 items-center">
                            <a href="#" target="_blank" class="w-12 h-12 rounded-full border border-border-subtle flex items-center justify-center text-primary hover:text-accent-coral hover:border-accent-coral hover:bg-surface-muted hover:-translate-y-1 hover:shadow-md transition-all duration-300" title="Instagram">
                                <x-si-instagram class="w-5 h-5" />
                            </a>
                            <a href="#" target="_blank" class="w-12 h-12 rounded-full border border-border-subtle flex items-center justify-center text-primary hover:text-accent-coral hover:border-accent-coral hover:bg-surface-muted hover:-translate-y-1 hover:shadow-md transition-all duration-300" title="TikTok">
                                <x-si-tiktok class="w-5 h-5" />
                            </a>
                            <a href="#" target="_blank" class="w-12 h-12 rounded-full border border-border-subtle flex items-center justify-center text-primary hover:text-accent-coral hover:border-accent-coral hover:bg-surface-muted hover:-translate-y-1 hover:shadow-md transition-all duration-300" title="Facebook">
                                <x-si-facebook class="w-5 h-5" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Imagen completa abajo -->
            <div class="w-full aspect-[16/9] md:aspect-[32/9] rounded-2xl overflow-hidden natural-shadow group mt-16">
                <img class="object-cover w-full h-full transition-transform duration-1000 group-hover:scale-105" 
                    src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
                    alt="Equipo Kivo" />
            </div>
            </div>
        </section>

    <!-- Footer -->
    <footer class="relative z-50 w-full py-24 px-margin-mobile md:px-margin-desktop bg-surface-container-low rounded-t-[3rem] md:rounded-t-[4rem] shadow-[0_-15px_40px_rgba(0,0,0,0.08)] border-t border-border-subtle">
        <div class="max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-start gap-12">
            <div class="max-w-xs">
                <div class="font-headline-md text-headline-md text-primary mb-6">Uncover</div>
                <p class="text-text-secondary font-body-md">Curating the best in design, technology, and editorial content for the discerning modern professional.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-12">
                <div>
                    <h5 class="font-label-sm text-label-sm uppercase mb-6">Shop</h5>
                    <ul class="space-y-4">
                        <li><a class="text-text-secondary hover:text-secondary transition-colors" href="#">New Arrivals</a></li>
                        <li><a class="text-text-secondary hover:text-secondary transition-colors" href="#">Best Sellers</a></li>
                        <li><a class="text-text-secondary hover:text-secondary transition-colors" href="#">Collections</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-label-sm text-label-sm uppercase mb-6">About</h5>
                    <ul class="space-y-4">
                        <li><a class="text-text-secondary hover:text-secondary transition-colors" href="#">Our Story</a></li>
                        <li><a class="text-text-secondary hover:text-secondary transition-colors" href="#">Journal</a></li>
                        <li><a class="text-text-secondary hover:text-secondary transition-colors" href="#">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-label-sm text-label-sm uppercase mb-6">Social</h5>
                    <ul class="space-y-4">
                        <li><a class="text-text-secondary hover:text-secondary transition-colors" href="#">Instagram</a></li>
                        <li><a class="text-text-secondary hover:text-secondary transition-colors" href="#">Twitter</a></li>
                        <li><a class="text-text-secondary hover:text-secondary transition-colors" href="#">LinkedIn</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="max-w-container-max mx-auto mt-24 pt-8 border-t border-border-subtle flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="font-label-sm text-label-sm text-text-secondary">© 2024 Uncover Editorial. All rights reserved.</p>
            <div class="flex gap-8">
                <a class="font-label-sm text-label-sm text-text-secondary hover:text-primary transition-colors" href="#">Privacy Policy</a>
                <a class="font-label-sm text-label-sm text-text-secondary hover:text-primary transition-colors" href="#">Terms of Service</a>
                <a class="font-label-sm text-label-sm text-text-secondary hover:text-primary transition-colors" href="#">Shipping &amp; Returns</a>
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
    <!-- Script para Sticky Horizontal Scroll -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const wrapper = document.getElementById('destacados-wrapper');
            const slider = document.getElementById('destacados-slider');
            
            if (wrapper && slider) {
                let ticking = false;
                
                window.addEventListener('scroll', () => {
                    if (!ticking) {
                        window.requestAnimationFrame(() => {
                            const rect = wrapper.getBoundingClientRect();
                            const windowHeight = window.innerHeight;

                            // 80px es el tamaño del header (top-20) donde se queda pegado
                            const stickyTop = 80; 
                            
                            // Si el wrapper está tocando o ha sobrepasado el header, y aún no ha terminado
                            if (rect.top <= stickyTop && rect.bottom >= windowHeight) {
                                // maxScrollVertical es toda el área en la que el usuario estará atascado scrolleando
                                const maxScrollVertical = wrapper.offsetHeight - windowHeight;
                                // Cuánto hemos bajado desde que se pegó
                                const scrolledDistance = stickyTop - rect.top;
                                
                                const progress = Math.min(Math.max(scrolledDistance / maxScrollVertical, 0), 1);
                                const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
                                
                                slider.scrollLeft = maxScrollLeft * progress;
                            }
                            // Si scrolleó muy rápido hacia arriba
                            else if (rect.top > stickyTop) {
                                slider.scrollLeft = 0;
                            }
                            // Si scrolleó muy rápido hacia abajo pasando la sección
                            else if (rect.bottom < windowHeight) {
                                slider.scrollLeft = slider.scrollWidth - slider.clientWidth;
                            }
                            
                            ticking = false;
                        });
                        ticking = true;
                    }
                });
            }
        });
    </script>
</body></html>