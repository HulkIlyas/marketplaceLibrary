document.getElementById('login-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;

    try {
        await apiRequest('login.php', 'POST', { username, password });
        window.location.href = 'dashboard.html';
    } catch (err) {
        showAlert(err.message);
    }
});
