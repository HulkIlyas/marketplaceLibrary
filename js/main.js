document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.menu-toggle');
    const navigation = document.getElementById('main-navigation');

    toggle?.addEventListener('click', () => {
        const open = navigation?.classList.toggle('is-open') ?? false;
        toggle.setAttribute('aria-expanded', String(open));
        toggle.querySelector('i').className = open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
    });

    document.addEventListener('click', (event) => {
        if (navigation?.classList.contains('is-open') && !navigation.contains(event.target) && !toggle?.contains(event.target)) {
            navigation.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
            toggle.querySelector('i').className = 'fa-solid fa-bars';
        }
    });

    document.querySelectorAll('.wish').forEach((button) => {
        button.addEventListener('click', () => {
            const saved = button.classList.toggle('is-saved');
            button.textContent = saved ? '♥' : '♡';
            button.setAttribute('aria-pressed', String(saved));
        });
    });

    document.querySelector('.mobile-filter')?.addEventListener('click', () => {
        document.querySelector('.catalog-filters')?.classList.toggle('is-open');
    });

    document.querySelectorAll('.password-toggle').forEach((button) => {
        button.addEventListener('click', () => {
            const input = button.parentElement.querySelector('input');
            const showing = input.type === 'text';
            input.type = showing ? 'password' : 'text';
            button.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
            button.querySelector('i').className = showing ? 'fa-regular fa-eye' : 'fa-regular fa-eye-slash';
        });
    });

    document.querySelector('[data-ui-newsletter]')?.addEventListener('submit', (event) => {
        event.preventDefault();
        const button = event.currentTarget.querySelector('button');
        button.textContent = 'Subscribed';
        button.disabled = true;
    });

    const accountLink = document.querySelector('[data-account-link]');
    if (accountLink && typeof Auth !== 'undefined' && Auth.isAuthenticated()) {
        accountLink.href = accountLink.dataset.profileHref;
        const label = accountLink.querySelector('span');
        const user = window.Auth.getUserPayload?.();
        if (label) label.textContent = user?.name || 'My account';
    }
});
