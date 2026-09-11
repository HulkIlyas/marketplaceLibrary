document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.menu-toggle');
    const navigation = document.getElementById('main-navigation');

    toggle?.addEventListener('click', () => {
        const open = navigation?.classList.toggle('is-open') ?? false;
        toggle.setAttribute('aria-expanded', String(open));
        toggle.querySelector('i').className = open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
    });

    document.addEventListener('click', (event) => {
        const clickedOutsideNavigation =
            navigation?.classList.contains('is-open') &&
            !navigation.contains(event.target) &&
            !toggle?.contains(event.target);

        if (clickedOutsideNavigation) {
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
    const registerLink = document.querySelector('[data-auth-register]');
    const logoutButton = document.querySelector('[data-auth-logout]');

    if (accountLink && typeof Auth !== 'undefined' && Auth.isAuthenticated()) {
        const user = Auth.getUserPayload();
        const label = accountLink.querySelector('span');

        accountLink.href = accountLink.dataset.profileHref;
        if (label) {
            label.textContent = user?.name || 'My Account';
        }

        if (registerLink) {
            registerLink.hidden = true;
        }

        if (logoutButton) {
            logoutButton.hidden = false;
        }
    }

    logoutButton?.addEventListener('click', () => {
        Auth.logout();
        window.location.href = logoutButton.dataset.homeHref;
    });
});
