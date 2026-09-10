document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form');
    const alertMessage = document.getElementById('alert-message');

    if (!loginForm) return;

    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;

        try {
            const response = await fetch('http://localhost/marketplaceLibrary-API/api/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            if (response.ok) {
                alertMessage.style.color = 'green';
                alertMessage.textContent = data.message || 'Login successful!';
                // Optional: store user info for later use
                localStorage.setItem('user', JSON.stringify(data.user));
            } else {
                alertMessage.style.color = 'red';
                alertMessage.textContent = data.message || 'Login failed.';
            }
        } catch (error) {
            alertMessage.style.color = 'red';
            alertMessage.textContent = 'An error occurred while connecting to the server.';
        }
    });
});