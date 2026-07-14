document.getElementById('register-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirm_password').value;

    if (password !== confirm) {
        showAlert('Passwords do not match');
        return;
    }

    try {
        await apiRequest('register.php', 'POST', { username, password });
        showAlert('Account created! Redirecting to login…', 'success');
        setTimeout(() => (window.location.href = 'index.html'), 1200);
    } catch (err) {
        showAlert(err.message);
    }
});
