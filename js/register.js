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
            const response = await fetch('http://localhost/marketplaceLibrary-API/api/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name, email, password })
            });

            const data = await response.json();

            if (response.ok) {
                alertMessage.style.color = 'green';
                alertMessage.textContent = data.message || 'Registration successful!';
                registerForm.reset();
            } else {
                alertMessage.style.color = 'red';
                alertMessage.textContent = data.message || 'Registration failed.';
            }
        } catch (error) {
            alertMessage.style.color = 'red';
            alertMessage.textContent = 'An error occurred while connecting to the server.';
        }
    });
});