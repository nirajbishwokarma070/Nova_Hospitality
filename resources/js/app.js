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

const adminShell = document.querySelector('[data-admin-shell]');
const adminMenuToggle = document.querySelector('[data-admin-menu-toggle]');
const adminBackdrop = document.querySelector('[data-admin-backdrop]');
const adminNavigation = document.querySelector('[data-admin-nav]');

if (adminShell && adminMenuToggle && adminBackdrop) {
    const closeAdminMenu = () => {
        adminShell.classList.remove('is-menu-open');
        adminMenuToggle.setAttribute('aria-expanded', 'false');
        adminMenuToggle.setAttribute('aria-label', 'Open admin navigation');
    };

    adminMenuToggle.addEventListener('click', () => {
        const isOpen = adminMenuToggle.getAttribute('aria-expanded') === 'true';
        adminShell.classList.toggle('is-menu-open', !isOpen);
        adminMenuToggle.setAttribute('aria-expanded', String(!isOpen));
        adminMenuToggle.setAttribute('aria-label', isOpen ? 'Open admin navigation' : 'Close admin navigation');
    });

    adminBackdrop.addEventListener('click', closeAdminMenu);
    adminNavigation?.addEventListener('click', (event) => {
        if (event.target.closest('a')) closeAdminMenu();
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeAdminMenu();
    });
}

const adminClock = document.querySelector('[data-admin-clock]');

if (adminClock) {
    const clockFormatter = new Intl.DateTimeFormat(undefined, {
        weekday: 'short',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    });
    const updateAdminClock = () => {
        const now = new Date();
        adminClock.textContent = clockFormatter.format(now);
        adminClock.dateTime = now.toISOString();
    };

    updateAdminClock();
    window.setInterval(updateAdminClock, 1000);
}

const fullscreenToggle = document.querySelector('[data-fullscreen-toggle]');
const fullscreenStatus = document.querySelector('[data-fullscreen-status]');

if (fullscreenToggle) {
    const updateFullscreenButton = () => {
        const isFullscreen = Boolean(document.fullscreenElement);
        const label = isFullscreen ? 'Exit full screen' : 'Enter full screen';
        fullscreenToggle.setAttribute('aria-label', label);
        fullscreenToggle.setAttribute('title', label);
    };

    fullscreenToggle.addEventListener('click', async () => {
        if (!document.fullscreenEnabled) {
            fullscreenStatus.textContent = 'Full screen is unavailable in this browser.';
            return;
        }

        try {
            if (document.fullscreenElement) {
                await document.exitFullscreen();
            } else {
                await document.documentElement.requestFullscreen();
            }
            fullscreenStatus.textContent = '';
        } catch {
            fullscreenStatus.textContent = 'Unable to change full-screen mode.';
        }
    });

    document.addEventListener('fullscreenchange', updateFullscreenButton);
    updateFullscreenButton();
}

const logoutForm = document.querySelector('[data-admin-logout]');

logoutForm?.addEventListener('submit', (event) => {
    if (!window.confirm('Are you sure you want to log out?')) {
        event.preventDefault();
    }
});
