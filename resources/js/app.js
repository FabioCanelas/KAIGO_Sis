// Drawer Logic
const menuTrigger = document.getElementById('menu-trigger');
const drawer = document.getElementById('drawer');
const overlay = document.getElementById('drawer-overlay');
const closeDrawer = document.getElementById('close-drawer');

function openMenu() {
    drawer.classList.remove('-translate-x-full');
    overlay.classList.remove('opacity-0', 'pointer-events-none');
    overlay.classList.add('opacity-100');
}

function closeMenu() {
    drawer.classList.add('-translate-x-full');
    overlay.classList.add('opacity-0', 'pointer-events-none');
    overlay.classList.remove('opacity-100');
}

if (menuTrigger) menuTrigger.addEventListener('click', openMenu);
if (closeDrawer) closeDrawer.addEventListener('click', closeMenu);
if (overlay) overlay.addEventListener('click', closeMenu);

// Intersection Observer for Reveal Animations
const observerOptions = {
    threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.reveal-on-scroll').forEach((el, index) => {
    if (!el.style.transitionDelay) {
        el.style.transitionDelay = `${Math.min((index % 6) * 70, 420)}ms`;
    }
    observer.observe(el);
});

// Hero Scroll Fade & Parallax Logic
const hero = document.querySelector(".hero");
const heroTitle = document.querySelector(".hero-title");
const heroCopies = document.querySelectorAll(".hero-copy, .hero-cta");

function updateHeroScroll() {
  if (!hero) return;
  const clamp = (value, min, max) => Math.min(Math.max(value, min), max);
  const progress = clamp(window.scrollY / Math.max(hero.offsetHeight * 0.72, 1), 0, 1);
  const fade = 1 - progress * 0.92;
  const lift = progress * -70;

  if (heroTitle) {
    heroTitle.style.opacity = fade;
    heroTitle.style.transform = `translateY(${lift}px) scale(${1 - progress * 0.035})`;
  }

  heroCopies.forEach((item) => {
    item.style.opacity = 1 - progress * 1.2;
    item.style.transform = `translateY(${progress * -28}px)`;
  });
}

window.addEventListener("scroll", updateHeroScroll, { passive: true });
updateHeroScroll();

// Add active state to nav items based on context
document.querySelectorAll('nav a').forEach(link => {
    if (link.innerText.toLowerCase() === 'home') {
        link.classList.add('text-secondary', 'font-bold');
    }
});

// Owl 3D Animation Logic
document.addEventListener("DOMContentLoaded", () => {
    const stage = document.querySelector("[data-owl-stage]");
    const rig = document.querySelector("[data-owl-rig]");
    const layers = Array.from(document.querySelectorAll(".owl-layer"));

    const state = { tx: 0, ty: 0, x: 0, y: 0, rx: 0, ry: 0, idleTimer: null };
    const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

    function setTargetFromPoint(clientX, clientY) {
        if (!stage) return;
        const rect = stage.getBoundingClientRect();
        const nx = clamp((clientX - (rect.left + rect.width / 2)) / (rect.width / 2), -1, 1);
        const ny = clamp((clientY - (rect.top + rect.height / 2)) / (rect.height / 2), -1, 1);
        state.tx = nx * 12;
        state.ty = ny * 10;
        window.clearTimeout(state.idleTimer);
        state.idleTimer = window.setTimeout(() => { state.tx = 0; state.ty = 0; }, 120);
    }

    window.addEventListener("pointermove", (event) => {
        setTargetFromPoint(event.clientX, event.clientY);
    });

    window.addEventListener("pointerleave", () => {
        state.tx = 0;
        state.ty = 0;
    });

    function animateOwl() {
        state.x += (state.tx - state.x) * 0.065;
        state.y += (state.ty - state.y) * 0.065;
        state.rx += (clamp(-state.y * 0.22, -3, 3) - state.rx) * 0.08;
        state.ry += (clamp(state.x * 0.26, -4, 4) - state.ry) * 0.08;

        if (rig) {
            rig.style.transform = `translate3d(${state.x}px, ${state.y}px, 0) rotateX(${state.rx}deg) rotateY(${state.ry}deg) rotateZ(${state.x * 0.05}deg)`;
        }

        layers.forEach((layer) => {
            const depth = Number(layer.dataset.depth || 1);
            const px = state.x * (depth - 1) * 0.55;
            const py = state.y * (depth - 1) * 0.55;
            layer.style.transform = `translate3d(${px}px, ${py}px, ${depth * 10}px)`;
        });

        requestAnimationFrame(animateOwl);
    }
    if (stage) {
        animateOwl();
    }
});

// Tilt Card Logic
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.tilt-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const rotateX = ((y / rect.height) - 0.5) * -8;
            const rotateY = ((x / rect.width) - 0.5) * 8;
            card.style.transform = `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(800px) rotateX(0) rotateY(0) scale(1)';
        });
    });
});


// Text Reveal Engine (Staggered Framer Style)
document.addEventListener('DOMContentLoaded', () => {
    const textElements = document.querySelectorAll('.texto-emergente');
    
    function wrapWordsInNode(node) {
        if (node.nodeType === Node.TEXT_NODE) {
            const text = node.textContent;
            if (!text.trim()) return; 
            
            const words = text.split(/(\s+)/); 
            const fragment = document.createDocumentFragment();
            
            words.forEach(word => {
                if (word.trim() === '') {
                    fragment.appendChild(document.createTextNode(word));
                } else {
                    const mask = document.createElement('span');
                    mask.className = 'inline-block overflow-hidden align-bottom pb-1 px-[0.02em]';
                    const inner = document.createElement('span');
                    inner.className = 'inline-block translate-y-[110%] opacity-0 transition-all duration-[800ms] ease-[cubic-bezier(0.16,1,0.3,1)] inline-reveal-inner';
                    inner.textContent = word;
                    mask.appendChild(inner);
                    fragment.appendChild(mask);
                }
            });
            node.replaceWith(fragment);
        } else if (node.nodeType === Node.ELEMENT_NODE) {
            if (!node.classList.contains('inline-reveal-inner')) {
                Array.from(node.childNodes).forEach(wrapWordsInNode);
            }
        }
    }

    textElements.forEach(el => {
        Array.from(el.childNodes).forEach(wrapWordsInNode);
        const inners = el.querySelectorAll('.inline-reveal-inner');
        inners.forEach((inner, idx) => {
            inner.style.transitionDelay = `${idx * 40}ms`;
        });
    });

    const textObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const inners = entry.target.querySelectorAll('.inline-reveal-inner');
            if (entry.isIntersecting) {
                inners.forEach(inner => {
                    inner.classList.remove('translate-y-[110%]', 'opacity-0');
                    inner.classList.add('translate-y-0', 'opacity-100');
                });
            } else {
                inners.forEach(inner => {
                    inner.classList.add('translate-y-[110%]', 'opacity-0');
                    inner.classList.remove('translate-y-0', 'opacity-100');
                });
            }
        });
    }, { threshold: 0.1 });

    textElements.forEach(el => textObserver.observe(el));
});

// Quick View Drawer Logic
document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('quick-view-overlay');
    const drawer = document.getElementById('quick-view-drawer');
    const closeBtn = document.getElementById('quick-view-close');
    const triggers = document.querySelectorAll('.open-quick-view');
    
    // DOM Elements to populate
    const titleEl = document.getElementById('qv-title');
    const priceEl = document.getElementById('qv-price');
    const categoryEl = document.getElementById('qv-category');
    const descEl = document.getElementById('qv-description');
    
    // Carousel Elements
    const track = document.getElementById('qv-image-track');
    const dotsContainer = document.getElementById('qv-dots');
    const prevBtn = document.getElementById('qv-prev-btn');
    const nextBtn = document.getElementById('qv-next-btn');

    function openDrawer(productData) {
        // Populate text
        titleEl.textContent = productData.name || 'Producto';
        priceEl.textContent = `$${parseFloat(productData.price).toFixed(2)}`;
        categoryEl.textContent = productData.category ? productData.category.name : 'General';
        descEl.textContent = productData.description || 'Sin descripción disponible.';

        // Populate images
        track.innerHTML = '';
        dotsContainer.innerHTML = '';
        
        let images = productData.images || [];
        if (images.length === 0) {
            images = [{ image_path: null }]; // Fallback
        }

        images.forEach((img, index) => {
            // Image
            const imgEl = document.createElement('img');
            imgEl.className = 'w-full h-full object-contain shrink-0 snap-center p-8';
            imgEl.src = img.image_path ? `/storage/${img.image_path}` : 'https://placehold.co/600x600/eeeeed/666666?text=Sin+Imagen';
            track.appendChild(imgEl);

            // Dot
            if (images.length > 1) {
                const dot = document.createElement('button');
                dot.className = `w-2 h-2 rounded-full transition-all duration-300 ${index === 0 ? 'bg-primary w-4' : 'bg-primary/30'}`;
                dot.addEventListener('click', () => {
                    track.scrollTo({ left: track.clientWidth * index, behavior: 'smooth' });
                });
                dotsContainer.appendChild(dot);
            }
        });

        // Show/hide navigation arrows
        if (images.length > 1) {
            prevBtn.classList.remove('hidden');
            nextBtn.classList.remove('hidden');
        } else {
            prevBtn.classList.add('hidden');
            nextBtn.classList.add('hidden');
        }

        // Setup scroll observer for dots
        if (images.length > 1) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const index = Array.from(track.children).indexOf(entry.target);
                        Array.from(dotsContainer.children).forEach((dot, i) => {
                            if (i === index) {
                                dot.classList.replace('bg-primary/30', 'bg-primary');
                                dot.classList.add('w-4');
                            } else {
                                dot.classList.replace('bg-primary', 'bg-primary/30');
                                dot.classList.remove('w-4');
                            }
                        });
                    }
                });
            }, { root: track, threshold: 0.5 });
            
            Array.from(track.children).forEach(child => observer.observe(child));
        }

        // Open UI
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        drawer.classList.remove('translate-x-full');
        document.body.style.overflow = 'hidden'; // Prevent body scroll
    }

    function closeDrawer() {
        overlay.classList.add('opacity-0', 'pointer-events-none');
        drawer.classList.add('translate-x-full');
        document.body.style.overflow = '';
    }

    triggers.forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            // In catalogo, the click might be on the card, we must ensure we get the data-product from the correct element
            const data = trigger.getAttribute('data-product');
            if (data) openDrawer(JSON.parse(data));
        });
    });

    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (overlay) overlay.addEventListener('click', closeDrawer);

    // Carousel Navigation
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            track.scrollBy({ left: -track.clientWidth, behavior: 'smooth' });
        });
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            track.scrollBy({ left: track.clientWidth, behavior: 'smooth' });
        });
    }
});
