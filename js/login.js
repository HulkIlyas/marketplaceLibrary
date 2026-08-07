document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('login-form');
    if (!form) return;

    const toggle = form.querySelector('.password-toggle');
    toggle.addEventListener('click', () => {
        const input = toggle.parentElement.querySelector('input');
        const show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        toggle.setAttribute('aria-label', show ? toggle.dataset.hideLabel : toggle.dataset.showLabel);
        toggle.querySelector('i').className = show ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
    });

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        form.querySelectorAll('input[required]').forEach((input) => {
            input.closest('.form-group').classList.toggle('has-error', !input.validity.valid);
        });
    });

    form.querySelectorAll('input').forEach((input) => input.addEventListener('input', () => {
        input.closest('.form-group')?.classList.remove('has-error');
    }));

    document.querySelector('[data-ui-link]')?.addEventListener('click', (event) => event.preventDefault());
});
