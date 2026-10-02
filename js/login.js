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
                throw new Error(result.data?.error || result.data?.message || loginForm.dataset.failure);
            }

            const token = result.data?.token;
            if (!token) {
                throw new Error(loginForm.dataset.tokenMissing);
            }

            Auth.setToken(token);
            Cart.mergeGuest();
            Wishlist.mergeGuest();
            alertMessage.className = 'alert alert-success';
            alertMessage.textContent = result.data?.message || loginForm.dataset.success;
            window.location.href = new URLSearchParams(location.search).get('next') === 'checkout' ? 'checkout.php' : '../profile.php';
        } catch (error) {
            alertMessage.style.color = 'red';
            alertMessage.textContent = error.message || loginForm.dataset.networkError;
        }
    });
});
