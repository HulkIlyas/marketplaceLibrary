const API_BASE = 'http://localhost:8000';

async function apiRequest(endpoint, method = 'GET', body = null) {
    const headers = {
        'Content-Type': 'application/json'
    };

    const token = Auth.getToken();
    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }

    const config = { method, headers };
    if (body) {
        config.body = JSON.stringify(body);
    }

    try {
        const response = await fetch(`${API_BASE}${endpoint}`, config);

        // Handle token expiration or unauthorized requests automatically
        if (response.status === 401) {
            Auth.logout();
            return;
        }

        const data = await response.json();
        return { ok: response.ok, status: response.status, data };
    } catch (err) {
        console.error('API Error:', err);
        return { ok: false, data: { error: 'Failed to connect to the API server.' } };
    }
}