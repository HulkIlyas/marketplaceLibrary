// Shared presentation and API validation for cart, checkout, and account orders.
const Commerce = {
    t(key) { return JSON.parse(document.getElementById('commerce-translations').textContent)[key] || key; },
    node(tag, value, className) { const el = document.createElement(tag); if (value != null) el.textContent = value; if (className) el.className = className; return el; },
    money(value) { return new Intl.NumberFormat(document.documentElement.lang, { style:'currency', currency:'MAD' }).format(Number(value)); },
    error(result, fallback = 'loadFailed') { return this.t(result.data?.code || fallback); },
    canBuy(book) { return ['SELL','SELL_OR_EXCHANGE'].includes(book.listing_type) && book.listing_status === 'ACTIVE' && !(Auth.isAuthenticated() && Number(Auth.getUserPayload().user_id) === Number(book.owner_id)); },
    image(url, title) {
        const fallback = this.node('div', title, 'cart-cover');
        try {
            const parsed = new URL(url);
            if (!['http:','https:'].includes(parsed.protocol)) return fallback;
            const img = this.node('img'); img.src = parsed.href; img.alt = title; img.className = 'commerce-cover';
            img.onerror = () => img.replaceWith(fallback);
            return img;
        } catch { return fallback; }
    },
    async loadCart() {
        const books = [];
        let failed = false;
        let removed = false;
        await Promise.all(Cart.getItems().map(async id => {
            const result = await apiRequest(`/books?id=${id}`, 'GET', null, { redirectOnUnauthorized:false });
            if (result.status === 404 || (result.ok && result.data?.data && !this.canBuy(result.data.data))) {
                Cart.remove(id); removed = true; return;
            }
            if (!result.ok || !result.data?.data) { failed = true; return; }
            books.push(result.data.data);
        }));
        return {books, failed, removed};
    },
};
