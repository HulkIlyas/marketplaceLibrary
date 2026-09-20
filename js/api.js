/**
 * api.js
 * Small wrapper around fetch() for talking to the PHP backend.
 * `credentials: 'include'` is required so the PHP session cookie
 * is sent/received even though frontend and backend run on
 * different ports/origins.
 */

const API_BASE = 'http://localhost:8000/api'; // point this at your PHP backend

async function apiRequest(endpoint, method = 'GET', body = null) {
    const options = {
        method,
        credentials: 'include',
        headers: { 'Content-Type': 'application/json' },
    };

    if (body) {
        options.body = JSON.stringify(body);
    }

    const res = await fetch(`${API_BASE}/${endpoint}`, options);
    const data = await res.json().catch(() => ({}));

    if (!res.ok) {
        throw new Error(data.error || 'Something went wrong');
    }

    return data;
}

function showAlert(message, type = 'error') {
    const el = document.getElementById('alert');
    if (!el) return;
    el.textContent = message;
    el.className = `alert alert-${type}`;
    el.hidden = false;
}
