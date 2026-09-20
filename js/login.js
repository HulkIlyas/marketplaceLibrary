document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form');
    const alertMessage = document.getElementById('alert-message');

    if (!loginForm) return;

    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;

        try {
            const result = await apiRequest('/login', 'POST', { email, password });

            if (!result.ok) {
                throw new Error(result.data?.error || result.data?.message || 'Login failed.');
            }

            const token = result.data?.token;
            if (!token) {
                throw new Error('Login response did not include an authentication token.');
            }

            Auth.setToken(token);
            alertMessage.className = 'alert alert-success';
            alertMessage.textContent = result.data?.message || 'Login successful!';
            window.location.href = '../profile.php';
        } catch (error) {
            alertMessage.style.color = 'red';
            alertMessage.textContent = error.message || 'An error occurred while connecting to the server.';
        }
    });
});
