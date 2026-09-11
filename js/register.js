document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('register-form');
    const alertMessage = document.getElementById('alert-message');

    if (!registerForm) return;

    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        // Frontend validation: Check matching passwords
        if (password !== confirmPassword) {
            alertMessage.style.color = 'red';
            alertMessage.textContent = 'Passwords do not match.';
            return;
        }
        // strong password check
        if (password.length < 6) {
            alertMessage.style.color = 'red';
            alertMessage.textContent = 'Password must be at least 6 characters long.';
            return;
        }

        if (!/[A-Za-z]/.test(password) || !/[0-9]/.test(password)) {
            alertMessage.style.color = 'red';
            alertMessage.textContent = 'Password must contain at least one letter and one number.';
            return;
        }
        try {
            const result = await apiRequest('/users', 'POST', { name, email, password });

            if (!result.ok) {
                throw new Error(result.data?.error || result.data?.message || 'Registration failed.');
            }

            alertMessage.className = 'alert alert-success';
            alertMessage.textContent = result.data?.message || 'Registration successful! Redirecting to login...';
            registerForm.reset();

            setTimeout(() => {
                window.location.href = 'login.php';
            }, 2000);
        } catch (error) {
            alertMessage.className = 'alert alert-error';
            alertMessage.textContent = error.message || 'An error occurred while connecting to the server.';
        }
    });
});
