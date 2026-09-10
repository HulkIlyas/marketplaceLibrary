const TOKEN_KEY = 'jwt_token';

const Auth = {
    setToken(token) {
        localStorage.setItem(TOKEN_KEY, token);
    },

    getToken() {
        return localStorage.getItem(TOKEN_KEY);
    },

    removeToken() {
        localStorage.removeItem(TOKEN_KEY);
    },

    getUserPayload() {
        const token = this.getToken();
        if (!token) return null;
        try {
            const payloadBase64 = token.split('.')[1];
            return JSON.parse(atob(payloadBase64));
        } catch (e) {
            return null;
        }
    },

    isAuthenticated() {
        const payload = this.getUserPayload();
        if (!payload || !payload.exp) return false;
        // Check expiration timestamp
        return payload.exp > Math.floor(Date.now() / 1000);
    },

    requireAuth() {
        if (!this.isAuthenticated()) {
            this.removeToken();
            window.location.href = 'login.php';
        }
    },

    redirectIfAuthenticated() {
        if (this.isAuthenticated()) {
            window.location.href = 'profile.php';
        }
    },

    logout() {
        this.removeToken();
        window.location.href = 'login.php';
    }
};