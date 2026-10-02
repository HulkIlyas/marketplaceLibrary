const Wishlist = (() => {
    const guestKey = 'marketplace_wishlist_guest';
    const key = () => {
        const user = typeof Auth !== 'undefined' && Auth.isAuthenticated() ? Auth.getUserPayload() : null;
        return user?.user_id ? `marketplace_wishlist_${user.user_id}` : guestKey;
    };
    const normalize = items => Array.isArray(items)
        ? [...new Set(items.map(Number).filter(id => Number.isSafeInteger(id) && id > 0))]
        : [];
    const read = storageKey => {
        try { return normalize(JSON.parse(localStorage.getItem(storageKey) || '[]')); }
        catch { return []; }
    };
    const refreshButtons = () => {
        document.querySelectorAll('.wish[data-book-id]').forEach(button => {
            const saved = read(key()).includes(Number(button.dataset.bookId));
            button.classList.toggle('is-saved', saved);
            button.setAttribute('aria-pressed', String(saved));
            button.textContent = saved ? '♥' : '♡';
        });
    };
    const save = items => {
        localStorage.setItem(key(), JSON.stringify(normalize(items)));
        refreshButtons();
        window.dispatchEvent(new Event('wishlistchange'));
    };
    const api = {
        getItems: () => read(key()),
        add(id) { id = Number(id); if (Number.isSafeInteger(id) && id > 0) save([...read(key()), id]); },
        remove(id) { save(read(key()).filter(value => value !== Number(id))); },
        toggle(id) { this.has(id) ? this.remove(id) : this.add(id); return this.has(id); },
        has: id => read(key()).includes(Number(id)),
        count: () => read(key()).length,
        clear() { save([]); },
        mergeGuest() {
            if (typeof Auth === 'undefined' || !Auth.isAuthenticated()) return;
            const guest = read(guestKey);
            if (guest.length) {
                save([...read(key()), ...guest]);
                localStorage.removeItem(guestKey);
            }
        },
        refreshButtons,
    };
    return api;
})();

document.addEventListener('click', event => {
    const button = event.target.closest('.wish[data-book-id]');
    if (!button || button.disabled) return;
    event.preventDefault();
    Wishlist.toggle(button.dataset.bookId);
});
document.addEventListener('DOMContentLoaded', Wishlist.refreshButtons);
window.addEventListener('pageshow', Wishlist.refreshButtons);
window.addEventListener('storage', event => {
    if (event.key?.startsWith('marketplace_wishlist_')) {
        Wishlist.refreshButtons();
        window.dispatchEvent(new Event('wishlistchange'));
    }
});
