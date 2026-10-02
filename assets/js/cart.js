const Cart = (() => {
    const key = () => Auth.isAuthenticated() ? `marketplace_cart_${Auth.getUserPayload().user_id}` : 'marketplace_cart_guest';
    const normalize = items => Array.isArray(items) ? [...new Set(items.filter(id => Number.isSafeInteger(id) && id > 0))] : [];
    function read(storageKey) {
        try { return normalize(JSON.parse(localStorage.getItem(storageKey) || '[]')); }
        catch { return []; }
    }
    function save(items) {
        localStorage.setItem(key(), JSON.stringify(normalize(items)));
        updateBadge();
        window.dispatchEvent(new Event('cartchange'));
    }
    function updateBadge() { document.querySelectorAll('.cart-count').forEach(el => { el.textContent = read(key()).length; }); }
    return {
        getItems: () => read(key()),
        add(id) { id = Number(id); if (!Number.isSafeInteger(id) || id <= 0) return; save([...read(key()),id]); },
        remove(id) { save(read(key()).filter(value => value !== Number(id))); },
        clear() { save([]); },
        count: () => read(key()).length,
        has: id => read(key()).includes(Number(id)),
        updateBadge,
        mergeGuest() {
            if (!Auth.isAuthenticated()) return;
            const guest = read('marketplace_cart_guest');
            if (guest.length) { save([...read(key()),...guest]); localStorage.removeItem('marketplace_cart_guest'); }
        },
    };
})();
document.addEventListener('DOMContentLoaded', Cart.updateBadge);
window.addEventListener('pageshow', Cart.updateBadge);
window.addEventListener('storage', () => { Cart.updateBadge(); window.dispatchEvent(new Event('cartchange')); });
