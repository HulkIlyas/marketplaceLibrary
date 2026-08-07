document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('register-form');
    if (!form) return;

    form.querySelectorAll('.password-toggle').forEach((toggle) => {
        toggle.addEventListener('click', () => {
            const input = toggle.parentElement.querySelector('input');
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            toggle.setAttribute('aria-label', show ? toggle.dataset.hideLabel : toggle.dataset.showLabel);
            toggle.querySelector('i').className = show ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });
    });

    const password = form.querySelector('#password');
    const confirmation = form.querySelector('#confirm-password');
    const confirmGroup = confirmation.closest('.form-group');
    const confirmError = confirmGroup.querySelector('.form-error');

    const validateConfirmation = () => {
        const mismatched = confirmation.value !== '' && confirmation.value !== password.value;
        confirmation.setCustomValidity(mismatched ? confirmError.dataset.confirmError : '');
        confirmGroup.classList.toggle('has-error', mismatched);
        confirmError.textContent = mismatched ? confirmError.dataset.confirmError : '';
        return !mismatched;
    };

    password.addEventListener('input', validateConfirmation);
    confirmation.addEventListener('input', validateConfirmation);

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        validateConfirmation();
        form.querySelectorAll('input[required]').forEach((input) => {
            if (!input.validity.valid) input.closest('.form-group').classList.add('has-error');
        });
    });

    form.querySelectorAll('input').forEach((input) => input.addEventListener('input', () => {
        if (input.validity.valid && input !== confirmation) input.closest('.form-group')?.classList.remove('has-error');
    }));
});
