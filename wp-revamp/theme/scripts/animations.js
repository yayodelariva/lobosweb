document.addEventListener('DOMContentLoaded', function () {

    // ── Nav: reveal on scroll (all pages) ────────────────────────────────────
    window.addEventListener('scroll', function () {
        document.getElementById('home-nav')
            ?.classList.toggle('scrolled', window.scrollY > 60);
    }, { passive: true });

    // ── Disable navigation on parent menu items (Equipos / Foam / Cloth) ─────
    document.querySelectorAll(
        '.home-nav-menu li.menu-item-has-children > a, ' +
        '.mobile-menu-list li.menu-item-has-children > a'
    ).forEach(function (a) {
        a.addEventListener('click', function (e) { e.preventDefault(); });
    });

    // ── Mobile menu ──────────────────────────────────────────────────────────
    var mobileBtn     = document.getElementById('mobile-menu-btn');
    var mobileOverlay = document.getElementById('mobile-menu-overlay');

    function closeMobileMenu() {
        mobileBtn.classList.remove('open');
        mobileBtn.setAttribute('aria-expanded', 'false');
        mobileOverlay.classList.remove('open');
        mobileOverlay.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    if (mobileBtn && mobileOverlay) {
        mobileBtn.addEventListener('click', function () {
            var isOpen = mobileBtn.classList.toggle('open');
            mobileBtn.setAttribute('aria-expanded', isOpen);
            mobileOverlay.classList.toggle('open', isOpen);
            mobileOverlay.setAttribute('aria-hidden', !isOpen);
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });

        mobileOverlay.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeMobileMenu);
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMobileMenu();
        });
    }

    // ── Home page: GSAP + ScrollTrigger ──────────────────────────────────────
    if (document.body.classList.contains('home-canvas')) {

        gsap.registerPlugin(ScrollTrigger);

        // Hero sequence — staggered reveal on load
        var heroTl = gsap.timeline({ delay: 0.15 });

        heroTl
            .from('.home-hero-eyebrow', {
                opacity: 0, y: 16, duration: 0.6, ease: 'power2.out',
            })
            .from('.hero-line', {
                yPercent: 115,
                duration: 0.9,
                stagger: 0.11,
                ease: 'power3.out',
            }, '-=0.35')
            .from('.home-hero-blurb', {
                opacity: 0, y: 24, duration: 0.7, ease: 'power2.out',
            }, '-=0.45')
            .from('.home-hero-btn', {
                opacity: 0, y: 16, duration: 0.6, ease: 'power2.out',
            }, '-=0.45')
            .from('.home-hero-scroll-hint', {
                opacity: 0, duration: 0.8,
            }, '-=0.2');

        // Stats — fade + slide up on scroll
        gsap.from('.home-stat-item', {
            opacity: 0,
            y: 40,
            duration: 0.7,
            stagger: 0.15,
            ease: 'power2.out',
            scrollTrigger: { trigger: '.home-stats', start: 'top 78%' },
        });

        // Historia — slide in from each side
        gsap.from('.home-historia-left', {
            opacity: 0,
            x: -50,
            duration: 0.9,
            ease: 'power3.out',
            scrollTrigger: { trigger: '.home-historia', start: 'top 72%' },
        });

        gsap.from('.home-historia-right', {
            opacity: 0,
            x: 50,
            duration: 0.9,
            ease: 'power3.out',
            scrollTrigger: { trigger: '.home-historia', start: 'top 72%' },
        });

        // Contacto — scale in
        gsap.from('.home-contacto-title', {
            opacity: 0,
            y: 40,
            duration: 0.8,
            ease: 'power2.out',
            scrollTrigger: { trigger: '.home-contacto', start: 'top 72%' },
        });

        gsap.from('.home-social-links', {
            opacity: 0,
            y: 24,
            duration: 0.7,
            delay: 0.25,
            ease: 'power2.out',
            scrollTrigger: { trigger: '.home-contacto', start: 'top 72%' },
        });

    }

    // ── AOS: all other pages ──────────────────────────────────────────────────
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 700,
            easing: 'ease-out-cubic',
            once: true,
            offset: 80,
        });

        // Stagger children that have data-aos-stagger on their parent
        document.querySelectorAll('[data-aos-stagger]').forEach(function (parent) {
            var delay = parseInt(parent.dataset.aosStagger, 10) || 100;
            Array.from(parent.children).forEach(function (child, i) {
                child.setAttribute('data-aos', child.dataset.aos || 'fade-up');
                child.setAttribute('data-aos-delay', i * delay);
            });
        });

        AOS.refresh();
    }

    // ── Count-up on stat numbers (all pages) ─────────────────────────────────
    function countUp(el) {
        var target   = parseInt(el.dataset.countTarget, 10);
        var suffix   = el.dataset.countSuffix || '';
        var duration = 1600;
        var start    = performance.now();

        function tick(now) {
            var elapsed  = now - start;
            var progress = Math.min(elapsed / duration, 1);
            var eased    = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.round(eased * target) + suffix;
            if (progress < 1) requestAnimationFrame(tick);
        }

        requestAnimationFrame(tick);
    }

    var countObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                countUp(entry.target);
                countObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.6 });

    document.querySelectorAll('[data-count-target]').forEach(function (el) {
        countObserver.observe(el);
    });

});
