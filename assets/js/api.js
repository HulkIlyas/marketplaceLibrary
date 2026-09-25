const API_BASE = 'http://localhost:8000';

async function apiRequest(endpoint, method = 'GET', body = null, { redirectOnUnauthorized = true } = {}) {
    const normalizedEndpoint = `/${endpoint.replace(/^\/+/, '')}`;
    const isLoginRequest = normalizedEndpoint === '/login' || normalizedEndpoint === '/users/login';
    const isFormData = body instanceof FormData;
    const headers = isFormData ? {} : {
        'Content-Type': 'application/json'
    };

    const token = Auth.getToken();
    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }

    const config = { method, headers };
    if (body) {
        config.body = isFormData ? body : JSON.stringify(body);
    }

    try {
        const response = await fetch(`${API_BASE}${normalizedEndpoint}`, config);

        const data = await response.json().catch(() => ({}));

        // Handle token expiration or unauthorized requests automatically
        if (response.status === 401 && !isLoginRequest && redirectOnUnauthorized) {
            Auth.logout();
        }

        return { ok: response.ok, status: response.status, data };
    } catch (err) {
        console.error('API Error:', err);
        return { ok: false, data: { error: 'Failed to connect to the API server.' } };
    }
}
