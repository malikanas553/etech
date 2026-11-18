// Note: Laravel's './bootstrap' (axios) is not imported: this static page makes no HTTP calls.

/* Navbar dropdowns: hover on desktop, click/tap toggles, Escape or outside click closes. */
const dropdowns = document.querySelectorAll('[data-dropdown]');
const closeAll = (except) => dropdowns.forEach((btn) => {
    if (btn === except) return;
    btn.parentElement.classList.remove('open');
    btn.setAttribute('aria-expanded', 'false');
});
dropdowns.forEach((btn) => btn.addEventListener('click', (e) => {
    e.stopPropagation();
    const open = !btn.parentElement.classList.contains('open');
    closeAll(btn);
    btn.parentElement.classList.toggle('open', open);
    btn.setAttribute('aria-expanded', String(open));
}));
document.addEventListener('click', () => closeAll());
document.addEventListener('keydown', (e) => e.key === 'Escape' && (closeAll(), toggleDrawer(false)));

/* Mobile drawer: fades in, traps nothing fancy but moves focus in and back out. */
const drawer = document.querySelector('[data-drawer]');
const burger = document.querySelector('[data-drawer-open]');
function toggleDrawer(open) {
    if (!drawer || drawer.classList.contains('open') === open) return;
    burger?.setAttribute('aria-expanded', String(open));
    document.body.style.overflow = open ? 'hidden' : '';
    if (open) {
        drawer.hidden = false;
        void drawer.offsetWidth; // apply the un-hidden state first so the fade-in transition runs
        drawer.classList.add('open');
        setTimeout(() => drawer.querySelector('[data-drawer-close]')?.focus(), 60);
    } else {
        drawer.classList.remove('open');
        setTimeout(() => { if (!drawer.classList.contains('open')) drawer.hidden = true; }, 260);
        burger?.focus();
    }
}
burger?.addEventListener('click', () => toggleDrawer(true));
drawer?.querySelector('[data-drawer-close]')?.addEventListener('click', () => toggleDrawer(false));
drawer?.addEventListener('click', (e) => e.target === drawer && toggleDrawer(false));
drawer?.querySelectorAll('[data-drawer-link]').forEach((a) => a.addEventListener('click', () => toggleDrawer(false)));
window.matchMedia('(min-width: 1240px)').addEventListener('change', (e) => e.matches && toggleDrawer(false));

/* Testimonial deck: the active card sits in front and the others fan out behind it.
   Arrows, clicking a side card, swiping and arrow keys all move it; autoplay runs while visible. */
document.querySelectorAll('[data-deck]').forEach((deck) => {
    const cards = [...deck.querySelectorAll('[data-deck-card]')];
    const counter = deck.querySelector('[data-counter]');
    const bar = deck.querySelector('[data-deck-bar]');
    const stage = deck.querySelector('[data-deck-stage]');
    const calm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const n = cards.length;
    let index = 0, timer = 0, inView = false, paused = false;

    const render = () => {
        cards.forEach((card, i) => {
            let pos = i - index;
            if (pos > n / 2) pos -= n;
            if (pos < -n / 2) pos += n;
            card.style.setProperty('--pos', pos);
            card.style.setProperty('--abs', Math.min(Math.abs(pos), 3));
            card.toggleAttribute('data-hidden', Math.abs(pos) > 2);
            card.classList.toggle('is-active', pos === 0);
            card.setAttribute('aria-hidden', String(pos !== 0));
        });
        counter.textContent = String(index + 1).padStart(2, '0');
        counter.classList.remove('flip');
        void counter.offsetWidth; // restart the flip animation
        counter.classList.add('flip');
        restartBar();
    };
    const go = (i) => { index = (i + n) % n; render(); };
    const restartBar = () => {
        clearTimeout(timer);
        bar.classList.remove('run');
        if (calm || !inView || paused) return;
        void bar.offsetWidth;
        bar.classList.add('run');
        timer = setTimeout(() => go(index + 1), 6000);
    };

    deck.querySelector('[data-deck-prev]').addEventListener('click', () => go(index - 1));
    deck.querySelector('[data-deck-next]').addEventListener('click', () => go(index + 1));
    cards.forEach((card, i) => card.addEventListener('click', () => { if (i !== index) go(i); }));
    deck.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') go(index + 1);
        if (e.key === 'ArrowLeft') go(index - 1);
    });

    // Swipe / drag.
    let startX = null;
    stage.addEventListener('pointerdown', (e) => { startX = e.clientX; });
    stage.addEventListener('pointerup', (e) => {
        if (startX === null) return;
        const dx = e.clientX - startX;
        startX = null;
        if (Math.abs(dx) > 40) go(index + (dx < 0 ? 1 : -1));
    });

    // Autoplay only while on screen; hover or focus pauses it.
    const setPaused = (v) => { paused = v; restartBar(); };
    deck.addEventListener('pointerenter', (e) => e.pointerType === 'mouse' && setPaused(true));
    deck.addEventListener('pointerleave', () => setPaused(false));
    deck.addEventListener('focusin', () => setPaused(true));
    deck.addEventListener('focusout', () => setPaused(false));
    if ('IntersectionObserver' in window) {
        new IntersectionObserver(([e]) => { inView = e.isIntersecting; restartBar(); }, { threshold: 0.35 }).observe(stage);
    }
    render();
});

/* Static page: forms don't post anywhere; validate and acknowledge. */
document.querySelectorAll('[data-static-form]').forEach((form) => form.addEventListener('submit', (e) => {
    e.preventDefault();
    if (!form.reportValidity()) return;
    const btn = form.querySelector('button[type="submit"]');
    const status = form.parentElement.querySelector('[data-status]');
    const isEmail = !!form.querySelector('[type="email"]');
    const label = btn.textContent;
    btn.textContent = isEmail ? 'Subscribed!' : 'Searching…';
    btn.disabled = true;
    if (status) status.textContent = isEmail ? 'Thanks! You are subscribed.' : 'Showing courses…';
    if (isEmail) confetti(form.closest('.subscribe-card'), btn);
    if (!isEmail) document.getElementById('courses')?.scrollIntoView({ behavior: 'smooth' });
    setTimeout(() => { btn.textContent = label; btn.disabled = false; form.reset(); if (status) status.textContent = ''; }, 2000);
}));

/* Scroll reveal: elements fade/slide in as they enter the viewport, staggered per group. */
const revealGroups = [
    ['.hero-copy > *', 'up'], ['.hero-ring, .hero-girl', 'zoom'], ['.float-card', 'up'],
    ['.band-logos', 'up'],
    ['.search > *', 'up'],
    ['.collage', 'left'], ['.benefits h2, .benefit', 'right'],
    ['.courses .section-title, .courses .section-sub', 'up'], ['.course-card', 'up'],
    ['.instructor-grid > div:first-child > *', 'left'], ['.perks li', 'up'], ['.arch', 'right'],
    ['.testimonials .section-title, .testimonials .section-sub', 'up'], ['.t-stage', 'zoom'], ['.t-controls', 'up'],
    ['.subscribe-card', 'zoom'],
    ['.footer-grid > *', 'up'],
];
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
if (!reduceMotion && 'IntersectionObserver' in window && !document.getElementById('ref-overlay')) {
    const io = new IntersectionObserver((entries) => entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        io.unobserve(entry.target);
    }), { rootMargin: '0px 0px -8% 0px', threshold: 0.12 });

    revealGroups.forEach(([selector, dir]) => {
        document.querySelectorAll(selector).forEach((el, i) => {
            el.classList.add('reveal', `reveal-${dir}`);
            el.style.setProperty('--reveal-delay', `${Math.min(i, 6) * 90}ms`);
            io.observe(el);
        });
    });

    // Safety net: never leave content hidden if the observer is delayed or throttled
    // (jumping to an anchor, printing, or a backgrounded tab).
    const revealPassed = () => document.querySelectorAll('.reveal:not(.is-visible)').forEach((el) => {
        if (el.getBoundingClientRect().top < window.innerHeight) el.classList.add('is-visible');
    });
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (ticking) return;
        ticking = true;
        setTimeout(() => { ticking = false; revealPassed(); }, 150);
    }, { passive: true });
    window.addEventListener('beforeprint', () => document.querySelectorAll('.reveal').forEach((el) => el.classList.add('is-visible')));
    revealPassed();
}

/* Hero floating cards bob gently once revealed. */
document.querySelectorAll('.float-card').forEach((card, i) => card.style.setProperty('--float-delay', `${i * -1.4}s`));

/* Shorter placeholders on narrow screens, where the full text would be cut off. */
const narrow = window.matchMedia('(max-width: 479.98px)');
const syncPlaceholders = () => document.querySelectorAll('[data-placeholder-short]').forEach((input) => {
    input.dataset.placeholderLong ??= input.placeholder;
    input.placeholder = narrow.matches ? input.dataset.placeholderShort : input.dataset.placeholderLong;
});
narrow.addEventListener('change', syncPlaceholders);
syncPlaceholders();

/* Header gets a shadow once the page is scrolled. */
const nav = document.querySelector('.site-nav-wrap');
if (nav) {
    const onScroll = () => nav.classList.toggle('is-scrolled', window.scrollY > 8);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

/* Dev-only: overlay the reference design (?ref=desktop or ?ref=mobile, press "o" to toggle). */
const overlay = document.getElementById('ref-overlay');
if (overlay) {
    // Frame positions measured in the 1400px-wide reference image.
    const frames = {
        desktop: { left: 39, top: 894, width: 1012, design: 1440 },
        mobile: { left: 1092, top: 894, width: 267, design: 375 },
    };
    const f = frames[overlay.dataset.mode] || frames.desktop;
    const scale = f.design / f.width;
    const offsetX = (document.documentElement.clientWidth - f.design) / 2;
    Object.assign(overlay.style, {
        position: 'absolute', left: '0', top: '0', width: '100%', height: `${document.documentElement.scrollHeight}px`,
        pointerEvents: 'none', zIndex: '9999', opacity: '0.5',
        backgroundImage: 'url(/reference/design.webp)', backgroundRepeat: 'no-repeat',
        backgroundSize: `${1400 * scale}px auto`,
        backgroundPosition: `${offsetX - f.left * scale}px ${-f.top * scale}px`,
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'o') overlay.style.opacity = overlay.style.opacity === '0' ? '0.5' : '0';
    });
}

/* ---------------------------------------------------------------
   Creative extras. Everything below is skipped for reduced motion,
   except the back-to-top button (it scrolls instantly then).
---------------------------------------------------------------- */
const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)');

/* Scroll progress bar + back-to-top button. */
const progress = document.querySelector('.scroll-progress');
const toTop = document.querySelector('[data-to-top]');
const onScrollExtras = () => {
    const max = document.documentElement.scrollHeight - window.innerHeight;
    progress?.style.setProperty('--progress', max > 0 ? (window.scrollY / max).toFixed(4) : 0);
    toTop?.classList.toggle('show', window.scrollY > 600);
};
window.addEventListener('scroll', onScrollExtras, { passive: true });
onScrollExtras();
toTop?.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
    document.querySelector('.logo')?.focus({ preventScroll: true });
});

/* Numbers count up when they scroll into view (e.g. "1.5k+", "135 Students"). */
document.querySelectorAll('.benefit h3').forEach((h) => {
    h.innerHTML = h.innerHTML.replace(/^(\d+(?:\.\d+)?)(k\+)/, '<span data-count="$1">$1</span>$2');
});
function countUp(el) {
    const target = parseFloat(el.dataset.count);
    const decimals = (el.dataset.count.split('.')[1] || '').length;
    const start = performance.now();
    const step = (now) => {
        const t = Math.min(1, (now - start) / 1400);
        el.textContent = (target * (1 - Math.pow(1 - t, 3))).toFixed(decimals);
        if (t < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
}
if (!reduceMotion && 'IntersectionObserver' in window) {
    const counterIo = new IntersectionObserver((entries) => entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        countUp(entry.target);
        counterIo.unobserve(entry.target);
    }), { threshold: 0.6 });
    document.querySelectorAll('[data-count]').forEach((el) => counterIo.observe(el));
}

if (!reduceMotion) {
    /* Course cards tilt toward the cursor, with a glare that follows it. */
    document.querySelectorAll('.course-card').forEach((card) => {
        card.addEventListener('pointermove', (e) => {
            if (!finePointer.matches) return;
            const r = card.getBoundingClientRect();
            const x = (e.clientX - r.left) / r.width;
            const y = (e.clientY - r.top) / r.height;
            card.style.setProperty('--ry', `${((x - 0.5) * 12).toFixed(2)}deg`);
            card.style.setProperty('--rx', `${((0.5 - y) * 12).toFixed(2)}deg`);
            card.style.setProperty('--gx', `${(x * 100).toFixed(1)}%`);
            card.style.setProperty('--gy', `${(y * 100).toFixed(1)}%`);
        });
        card.addEventListener('pointerleave', () => ['--rx', '--ry'].forEach((v) => card.style.removeProperty(v)));
    });

    /* Search placeholder types out example courses while the field is idle. */
    const search = document.querySelector('.search-field input');
    if (search) {
        const topics = ['UI Design', 'Python', 'Web Development', 'Wireframing', 'Data Science'];
        const real = () => (narrow.matches ? search.dataset.placeholderShort : search.dataset.placeholderLong);
        let topic = 0, chars = 0, deleting = false, timer;
        const idle = () => document.activeElement !== search && !search.value;
        const tick = () => {
            if (!idle()) { search.placeholder = real(); timer = setTimeout(tick, 1500); return; }
            const word = topics[topic];
            chars += deleting ? -1 : 1;
            search.placeholder = `Try “${word.slice(0, chars)}”`;
            let wait = deleting ? 45 : 95;
            if (!deleting && chars === word.length) { deleting = true; wait = 1600; }
            else if (deleting && chars === 1) { chars = 0; deleting = false; topic = (topic + 1) % topics.length; wait = 400; }
            timer = setTimeout(tick, wait);
        };
        search.addEventListener('focus', () => { search.placeholder = real(); });
        timer = setTimeout(tick, 3500);
    }
}

/* Confetti burst inside the subscribe card. */
function confetti(card, origin) {
    if (!card || reduceMotion) return;
    const c = card.getBoundingClientRect();
    const o = origin.getBoundingClientRect();
    const colors = ['#fff', '#ffd166', '#f889af', '#b672ff', '#7ee8c7'];
    for (let i = 0; i < 18; i++) {
        const bit = document.createElement('span');
        bit.className = 'confetti';
        bit.setAttribute('aria-hidden', 'true');
        const angle = (Math.PI * 2 * i) / 18;
        Object.assign(bit.style, {
            left: `${o.left - c.left + o.width / 2}px`, top: `${o.top - c.top + o.height / 2}px`,
            background: colors[i % colors.length],
        });
        bit.style.setProperty('--dx', `${Math.cos(angle) * (60 + Math.random() * 70)}px`);
        bit.style.setProperty('--dy', `${Math.sin(angle) * (40 + Math.random() * 50) - 30}px`);
        bit.style.setProperty('--r', `${Math.random() * 720 - 360}deg`);
        card.appendChild(bit);
        bit.addEventListener('animationend', () => bit.remove());
    }
}

/* Course slider: scroll-snap track with arrows, page dots and gentle autoplay. */
document.querySelectorAll('[data-course-slider]').forEach((slider) => {
    const track = slider.querySelector('[data-cs-track]');
    const cards = [...track.children];
    const dotsWrap = slider.querySelector('[data-cs-dots]');
    const step = () => cards[1].offsetLeft - cards[0].offsetLeft;
    const pages = () => Math.max(1, Math.round((track.scrollWidth - track.clientWidth) / step()) + 1);
    const current = () => Math.round(track.scrollLeft / step());
    const go = (i) => {
        const n = pages();
        track.scrollTo({ left: ((i % n) + n) % n * step(), behavior: reduceMotion ? 'auto' : 'smooth' });
    };

    let dots = [];
    const buildDots = () => {
        dotsWrap.innerHTML = '';
        dots = Array.from({ length: pages() }, (_, i) => {
            const b = document.createElement('button');
            b.type = 'button';
            b.setAttribute('aria-label', `Show course ${i + 1}`);
            b.addEventListener('click', () => go(i));
            dotsWrap.appendChild(b);
            return b;
        });
        syncDots();
    };
    const syncDots = () => dots.forEach((d, i) => d.setAttribute('aria-current', String(i === current())));

    slider.querySelector('[data-cs-prev]').addEventListener('click', () => go(current() - 1));
    slider.querySelector('[data-cs-next]').addEventListener('click', () => go(current() + 1));
    track.addEventListener('scroll', () => requestAnimationFrame(syncDots), { passive: true });
    track.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') { e.preventDefault(); go(current() + 1); }
        if (e.key === 'ArrowLeft') { e.preventDefault(); go(current() - 1); }
    });
    let lastWidth = window.innerWidth;
    window.addEventListener('resize', () => { if (window.innerWidth !== lastWidth) { lastWidth = window.innerWidth; buildDots(); } });
    buildDots();

    // Autoplay every 5s while visible; pauses on hover, focus or touch.
    if (reduceMotion) return;
    let paused = false, inView = false;
    ['pointerenter', 'focusin', 'touchstart'].forEach((ev) => slider.addEventListener(ev, () => { paused = true; }, { passive: true }));
    ['pointerleave', 'focusout'].forEach((ev) => slider.addEventListener(ev, () => { paused = false; }));
    if ('IntersectionObserver' in window) new IntersectionObserver(([e]) => { inView = e.isIntersecting; }, { threshold: 0.4 }).observe(slider);
    setInterval(() => { if (inView && !paused && !document.hidden) go(current() + 1); }, 5000);
});
