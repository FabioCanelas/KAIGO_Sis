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

document.querySelectorAll('.reveal-on-scroll').forEach(el => {
    observer.observe(el);
});

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
