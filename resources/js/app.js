const header = document.querySelector('[data-site-header]');
const menuToggle = document.querySelector('[data-menu-toggle]');
const navigation = document.querySelector('[data-site-nav]');

document.documentElement.classList.add('js-ready');

const updateHeader = () => header?.classList.toggle('is-scrolled', window.scrollY > 24);
updateHeader();
window.addEventListener('scroll', updateHeader, { passive: true });

if (menuToggle && navigation) {
    const closeMenu = () => {
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Open navigation');
        navigation.classList.remove('is-open');
    };

    menuToggle.addEventListener('click', () => {
        const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', String(!isOpen));
        menuToggle.setAttribute('aria-label', isOpen ? 'Open navigation' : 'Close navigation');
        navigation.classList.toggle('is-open', !isOpen);
    });

    navigation.addEventListener('click', (event) => {
        if (event.target.closest('a')) closeMenu();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeMenu();
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 680) closeMenu();
    });
}

const preview = document.querySelector('[data-image-preview]');
const previewImage = document.querySelector('[data-preview-img]');
const closePreview = document.querySelector('[data-image-close]');

if (preview && previewImage && closePreview) {
    document.querySelectorAll('[data-gallery-image]').forEach((item) => {
        item.addEventListener('click', () => {
            previewImage.src = item.dataset.galleryImage;
            previewImage.alt = item.dataset.galleryAlt || '';
            preview.showModal();
            closePreview.focus();
        });
    });

    closePreview.addEventListener('click', () => preview.close());
    preview.addEventListener('close', () => previewImage.removeAttribute('src'));
    preview.addEventListener('click', (event) => {
        if (event.target === preview) preview.close();
    });
}

const revealItems = document.querySelectorAll('.reveal');

if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    revealItems.forEach((item) => revealObserver.observe(item));
} else {
    revealItems.forEach((item) => item.classList.add('is-visible'));
}
