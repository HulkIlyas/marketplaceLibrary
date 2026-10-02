document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('register-form');
    const alertMessage = document.getElementById('alert-message');

    if (!registerForm) return;

    const submitButton = registerForm.querySelector('[type="submit"]');
    const defaultSubmitLabel = submitButton.textContent;
    let isSubmitting = false;

    const showStatus = (message, type = 'error') => {
        alertMessage.className = `form-status is-${type}`;
        alertMessage.textContent = message;
    };

    const showValidationError = (input, message) => {
        input.setAttribute('aria-invalid', 'true');
        input.focus();
        showStatus(message);
    };

    const getApiError = (data) => {
        if (typeof data?.error === 'string') return data.error;
        if (typeof data?.message === 'string') return data.message;

        if (data?.errors && typeof data.errors === 'object') {
            const messages = Object.values(data.errors).flat().filter(Boolean);
            if (messages.length) return messages.join(' ');
        }

        return registerForm.dataset.failure;
    };

    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (isSubmitting) return;

        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const name = nameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        [nameInput, emailInput, passwordInput, confirmPasswordInput].forEach((input) => {
            input.removeAttribute('aria-invalid');
        });
        showStatus('', 'error');

        if (!name) {
            showValidationError(nameInput, registerForm.dataset.nameRequired);
            return;
        }

        if (!email || !emailInput.validity.valid) {
            showValidationError(emailInput, registerForm.dataset.emailInvalid);
            return;
        }

        if (!password) {
            showValidationError(passwordInput, registerForm.dataset.passwordRequired);
            return;
        }

        if (password.length < 6) {
            showValidationError(passwordInput, registerForm.dataset.passwordMinLength);
            return;
        }

        if (password !== confirmPassword) {
            showValidationError(confirmPasswordInput, registerForm.dataset.passwordsMismatch);
            return;
        }

        isSubmitting = true;
        submitButton.disabled = true;
        submitButton.textContent = registerForm.dataset.creating;

        try {
            const result = await apiRequest('/users', 'POST', { name, email, password });

            if (!result.ok) {
                throw new Error(getApiError(result.data));
            }

            registerForm.reset();

            if (result.data?.token) {
                Auth.setToken(result.data.token);
                Cart.mergeGuest();
                Wishlist.mergeGuest();
                window.location.href = '../profile.php';
                return;
            }

            showStatus(registerForm.dataset.success, 'success');

            setTimeout(() => {
                window.location.href = 'login.php';
            }, 1500);
        } catch (error) {
            showStatus(error.message || registerForm.dataset.failure);
            isSubmitting = false;
            submitButton.disabled = false;
            submitButton.textContent = defaultSubmitLabel;
        }
    });
});
