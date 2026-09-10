document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const errorAlert = document.getElementById('errorAlert');

    errorAlert.style.display = 'none';

    const res = await apiRequest('/users/login', 'POST', { email, password });

    if (res.ok && res.data.token) {
        Auth.setToken(res.data.token);
        window.location.href = 'profile.php';
    } else {
        errorAlert.innerText = res.data.error || 'Login failed';
        errorAlert.style.display = 'block';
    }
});