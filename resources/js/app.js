import './bootstrap';

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

/* Mobile drawer */
const drawer = document.querySelector('[data-drawer]');
function toggleDrawer(open) {
    if (!drawer) return;
    drawer.classList.toggle('open', open);
    document.body.style.overflow = open ? 'hidden' : '';
}
document.querySelector('[data-drawer-open]')?.addEventListener('click', () => toggleDrawer(true));
document.querySelector('[data-drawer-close]')?.addEventListener('click', () => toggleDrawer(false));
drawer?.addEventListener('click', (e) => e.target === drawer && toggleDrawer(false));

/* Testimonial slider: arrows move one card; the counter follows the design (01/15). */
document.querySelectorAll('[data-slider]').forEach((slider) => {
    const track = slider.querySelector('[data-track]');
    const cards = [...track.children];
    const counter = slider.querySelector('[data-counter]');
    const total = Number(slider.dataset.total) || cards.length;
    let index = 0;

    const visible = () => Math.max(1, Math.round(track.parentElement.clientWidth / (cards[0].offsetWidth + 38)));
    const render = () => {
        const maxStart = Math.max(0, cards.length - visible());
        const shift = Math.min(index % (maxStart + 1), maxStart);
        track.style.transform = `translateX(-${shift * (cards[0].offsetWidth + 38)}px)`;
        counter.textContent = `${String(index + 1).padStart(2, '0')}/${String(total).padStart(2, '0')}`;
    };
    slider.querySelector('[data-prev]').addEventListener('click', () => { index = (index - 1 + total) % total; render(); });
    slider.querySelector('[data-next]').addEventListener('click', () => { index = (index + 1) % total; render(); });
    window.addEventListener('resize', render);
});

/* Static page: forms don't post anywhere, just acknowledge. */
document.querySelectorAll('[data-static-form]').forEach((form) => form.addEventListener('submit', (e) => {
    e.preventDefault();
    const btn = form.querySelector('button[type="submit"]');
    const label = btn.textContent;
    btn.textContent = form.querySelector('[type="email"]') ? 'Subscribed!' : 'Searching…';
    setTimeout(() => { btn.textContent = label; form.reset(); }, 1600);
}));

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
