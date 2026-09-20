(async function init() {
    try {
        const data = await apiRequest('check-auth.php');
        document.getElementById('greeting').textContent = `Hello, ${data.user.username} 👋`;
    } catch (err) {
        // Not logged in — bounce to login page
        window.location.href = 'index.html';
    }
})();

document.getElementById('logout-btn').addEventListener('click', async () => {
    try {
        await apiRequest('logout.php', 'POST');
    } finally {
        window.location.href = 'index.html';
    }
});
