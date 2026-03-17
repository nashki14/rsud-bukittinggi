// ── Navbar Scroll ───────────────────────────────────────────────────────────
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 40);
});
if (window.scrollY > 40) navbar.classList.add('scrolled');

// ── Mobile Hamburger ────────────────────────────────────────────────────────
const hamburger = document.getElementById('hamburger');
const navMenu = document.querySelector('.nav-menu');

hamburger?.addEventListener('click', () => {
    const isOpen = navMenu.style.display === 'flex';
    navMenu.style.display = isOpen ? '' : 'flex';
    navMenu.style.flexDirection = isOpen ? '' : 'column';
    navMenu.style.position = isOpen ? '' : 'absolute';
    navMenu.style.top = isOpen ? '' : '100%';
    navMenu.style.left = isOpen ? '' : '0';
    navMenu.style.right = isOpen ? '' : '0';
    navMenu.style.background = isOpen ? '' : 'var(--white)';
    navMenu.style.padding = isOpen ? '' : '1rem 2rem';
    navMenu.style.boxShadow = isOpen ? '' : '0 8px 32px rgba(10,22,40,0.12)';
    navMenu.style.zIndex = isOpen ? '' : '200';

    if (!isOpen) {
        navMenu.querySelectorAll('a').forEach(a => {
            a.style.color = 'var(--gray-800)';
        });
    }
});

// ── Image Upload Preview ────────────────────────────────────────────────────
document.querySelectorAll('input[type="file"][data-preview]').forEach(input => {
    const previewId = input.dataset.preview;
    input.addEventListener('change', function() {
        const file = this.files[0];
        if (file && previewId) {
            const img = document.getElementById(previewId);
            if (img) {
                const reader = new FileReader();
                reader.onload = e => img.src = e.target.result;
                reader.readAsDataURL(file);
            }
        }
    });
});

// ── Smooth Scroll for Anchors ───────────────────────────────────────────────
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// ── Flash message auto-hide ─────────────────────────────────────────────────
document.querySelectorAll('.alert').forEach(el => {
    setTimeout(() => {
        el.style.transition = 'opacity 0.5s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 500);
    }, 4000);
});
