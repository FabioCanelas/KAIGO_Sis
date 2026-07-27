<!-- OVERLAY OSCURO -->
<div id="quick-view-overlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[60] opacity-0 pointer-events-none transition-opacity duration-300"></div>

<!-- PANEL LATERAL (DRAWER) -->
<div id="quick-view-drawer" class="fixed top-0 right-0 h-[100dvh] w-full max-w-md bg-surface shadow-2xl z-[70] transform translate-x-full transition-transform duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] flex flex-col overflow-hidden">
    
    <!-- HEADER -->
    <div class="flex items-center justify-between p-6 border-b border-border-subtle shrink-0">
        <h2 class="font-label-sm text-label-sm uppercase text-text-secondary tracking-wider font-bold">Vista Rápida</h2>
        <button id="quick-view-close" class="p-2 -mr-2 text-primary hover:text-accent-coral transition-colors rounded-full hover:bg-surface-muted">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <!-- CONTENIDO CON SCROLL -->
    <div class="flex-1 overflow-y-auto" style="scrollbar-width: thin;">
        
        <!-- CARRUSEL DE IMÁGENES -->
        <div class="relative w-full aspect-square bg-surface-muted group/qv-carousel">
            <div id="qv-image-track" class="flex overflow-x-auto overflow-y-hidden snap-x snap-mandatory h-full w-full" style="scrollbar-width: none; -ms-overflow-style: none;">
                <!-- Las imágenes se inyectarán aquí con JS -->
            </div>
            
            <!-- Botones prev/next (se muestran si hay más de 1 imagen) -->
            <button id="qv-prev-btn" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 backdrop-blur-sm rounded-full shadow-md flex items-center justify-center text-primary opacity-0 group-hover/qv-carousel:opacity-100 transition-opacity disabled:opacity-0 hidden">
                <span class="material-symbols-outlined text-[20px]">chevron_left</span>
            </button>
            <button id="qv-next-btn" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 backdrop-blur-sm rounded-full shadow-md flex items-center justify-center text-primary opacity-0 group-hover/qv-carousel:opacity-100 transition-opacity disabled:opacity-0 hidden">
                <span class="material-symbols-outlined text-[20px]">chevron_right</span>
            </button>
            
            <!-- Paginación (Dots) -->
            <div id="qv-dots" class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                <!-- Dots inyectados con JS -->
            </div>
        </div>

        <!-- DETALLES DEL PRODUCTO -->
        <div class="p-6 md:p-8 flex flex-col gap-6">
            <div>
                <span id="qv-category" class="inline-block font-label-sm text-[11px] text-text-secondary uppercase mb-3 bg-surface-muted px-3 py-1 rounded-full">Categoría</span>
                <h1 id="qv-title" class="text-2xl md:text-3xl font-bold text-primary leading-tight mb-4">Nombre del Producto</h1>
                <div class="flex items-end gap-3">
                    <span id="qv-price" class="text-2xl font-bold text-accent-coral">$0.00</span>
                </div>
            </div>

            <!-- Divisor -->
            <hr class="border-border-subtle">

            <!-- Descripción -->
            <div>
                <h3 class="font-label-sm text-label-sm uppercase text-primary font-bold mb-3">Descripción</h3>
                <p id="qv-description" class="font-body-md text-text-secondary whitespace-pre-line leading-relaxed">
                    Descripción del producto.
                </p>
            </div>
        </div>
    </div>

    <!-- FOOTER (Acción) -->
    <div class="p-6 border-t border-border-subtle bg-surface/80 backdrop-blur-md shrink-0">
        <button class="w-full bg-primary hover:bg-primary/90 text-white font-label-sm text-label-sm uppercase font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[20px]">shopping_cart</span>
            Añadir al Carrito
        </button>
    </div>
</div>
