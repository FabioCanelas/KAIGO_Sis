<!DOCTYPE html>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta name="description" content="KIVO - Catálogo interactivo de productos tecnológicos premium y accesorios.">
<title>KIVO | Catálogo</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link rel="icon" type="image/x-icon" href="{{ asset('images/white-l.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/white-l.png') }}">
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-on-surface font-body-md">
    <!-- TopAppBar -->
    <header class="bg-surface sticky top-0 z-50 border-b border-border-subtle">
        <div class="flex justify-between items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="font-display-lg text-display-lg-mobile tracking-tighter text-primary hover:opacity-80 transition-opacity">KIVO</a>
            </div>
            <nav class="hidden md:flex gap-8">
                <a class="font-label-sm text-label-sm uppercase text-on-surface hover:text-secondary transition-colors duration-200" href="{{ route('home') }}#inicio">Inicio</a>
                <a class="font-label-sm text-label-sm uppercase text-on-surface hover:text-secondary transition-colors duration-200" href="{{ route('home') }}#destacados">Destacados</a>
                <a class="font-label-sm text-label-sm uppercase text-primary font-bold hover:text-secondary transition-colors duration-200" href="{{ route('catalogo') }}">Catálogo</a>
                <a class="font-label-sm text-label-sm uppercase text-on-surface hover:text-secondary transition-colors duration-200" href="{{ route('home') }}#sobre-nosotros">Nosotros</a>
            </nav>
            <div class="flex items-center gap-4">
                <a aria-label="Volver al inicio" href="{{ route('home') }}" class="material-symbols-outlined text-primary p-2 active:scale-95 transition-transform hover:text-accent-coral" data-icon="search">exit_to_app</a>
            </div>
        </div>
    </header>

    <main class="relative w-full pt-16 pb-24">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-col lg:flex-row gap-12">
            
            <!-- Sidebar (Categorías) -->
            <aside class="w-full lg:w-1/4 flex flex-col gap-8">
                <div class="sticky top-28">
                    <h3 class="font-headline-sm text-headline-sm text-primary mb-6 border-b border-border-subtle pb-4">Categorías</h3>
                    <ul class="flex flex-col gap-4">
                        <li>
                            <a href="#" class="group flex justify-between items-center text-primary font-bold hover:text-accent-coral transition-colors">
                                Todos los productos
                                <span class="bg-surface-muted group-hover:bg-accent-coral/10 group-hover:text-accent-coral px-3 py-1 rounded-full text-[12px] font-bold transition-colors">{{ $allProducts->count() }}</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="#" class="group flex justify-between items-center text-text-secondary hover:text-primary transition-colors">
                                    {{ $category->name }}
                                    <span class="bg-surface-muted group-hover:bg-surface px-3 py-1 rounded-full text-[12px] transition-colors">{{ $category->products_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Product Grid -->
            <section class="w-full lg:w-3/4">
                <div class="flex justify-between items-end mb-8 border-b border-border-subtle pb-4">
                    <h1 class="font-display-md text-display-md text-primary">Catálogo Completo</h1>
                    <span class="text-text-secondary font-label-sm text-label-sm uppercase">Mostrando {{ $allProducts->count() }} productos</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 md:gap-8">
                    @foreach($allProducts as $index => $product)
                        <div class="open-quick-view flex flex-col group cursor-pointer reveal-on-scroll" style="transition-delay: {{ ($index % 3) * 100 }}ms;" data-product="{{ json_encode($product) }}">
                            <div class="relative aspect-[4/5] w-full overflow-hidden rounded-2xl bg-surface-muted transition-all duration-500 natural-shadow group-hover:shadow-xl">
                                @if($product->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center transition-transform duration-700 group-hover:scale-105">
                                @else
                                    <img src="https://placehold.co/400x500/F5F5F7/1D1D1F?text=KIVO" alt="{{ $product->name }}" class="h-full w-full object-cover object-center transition-transform duration-700 group-hover:scale-105">
                                @endif
                                @if($product->created_at->diffInDays(now()) < 30)
                                    <div class="absolute top-4 left-4 bg-primary text-on-primary font-label-sm text-[10px] px-3 py-1.5 rounded-full uppercase tracking-wider shadow-md">
                                        Nuevo
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="mt-4 flex flex-col px-1">
                                <h3 class="text-xl font-bold text-primary group-hover:text-accent-coral transition-colors duration-300">{{ $product->name }}</h3>
                                <div class="flex justify-between items-center mt-2">
                                    <p class="font-label-sm text-label-sm text-text-secondary uppercase">{{ $product->category ? $product->category->name : 'General' }}</p>
                                    <p class="font-label-md text-label-md text-primary font-bold">Bs {{ number_format($product->price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
    </main>
    <section id="por-que-elegirnos" class="relative z-20 w-full bg-surface py-24 md:py-28">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">

        <div class="max-w-2xl mb-16">
            <span class="reveal-on-scroll font-label-sm text-label-sm uppercase text-accent-coral inline-flex items-center gap-2 mb-6 font-bold tracking-widest">
                <span class="w-1 h-1 bg-accent-coral animate-ping-slow"></span>
                Por qué elegirnos
            </span>
            <h1 class="reveal-on-scroll font-semibold text-display-lg-mobile md:text-display-lg text-primary mb-6">
                Comprar con nosotros es <span class="text-accent-coral">tranquilidad</span>
            </h1>
            <p class="reveal-on-scroll font-body-lg text-body-lg text-text-secondary">
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
                        'text' => 'Hasta 12 meses de garantía respaldada directamente por la marca.',
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

    <!-- Footer Simple -->
    <footer class="bg-neutral-100 relative z-30 w-full pt-16 pb-8 md:pt-24 border-t border-border-subtle rounded-t-[3rem] md:rounded-t-[4rem]"> 
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
                    <a href="#catalogo" class="px-8 py-4 bg-surface/80 backdrop-blur-md text-primary rounded-full font-label-sm text-label-sm uppercase font-bold hover:bg-white transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 inline-flex items-center gap-3 border border-border-subtle group natural-shadow">
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
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
    
    @include('components.quick-view-drawer')
</body></html>
