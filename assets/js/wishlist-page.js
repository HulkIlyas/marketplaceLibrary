document.addEventListener('DOMContentLoaded', () => {
    const roots = document.querySelectorAll('[data-wishlist-page]');
    if (!roots.length) return;
    let loading = false;
    const safeImage = book => {
        const images = Array.isArray(book.images) ? book.images : [];
        const image = images.find(item => item.is_cover) || images[0];
        if (!image?.url) return null;
        try { const url = new URL(image.url); return ['http:', 'https:'].includes(url.protocol) ? url.href : null; } catch { return null; }
    };
    const renderRoot = (root, books) => {
        const list = root.querySelector('[data-wishlist-list]');
        const empty = root.querySelector('[data-wishlist-empty]');
        const translations = JSON.parse(root.dataset.wishlistTranslations || '{}');
        const t = key => translations[key] || key;
        list.replaceChildren();
        empty.hidden = books.length !== 0;
        books.forEach(book => {
            const card = document.createElement('article'); card.className = 'book-card';
            const type = String(book.listing_type || 'SELL').toUpperCase();
            const cover = document.createElement('div'); cover.className = 'cover cover-one';
            const url = safeImage(book);
            if (url) { const img = document.createElement('img'); img.src = url; img.alt = book.title; img.loading = 'lazy'; cover.classList.add('has-image'); cover.append(img); }
            else cover.textContent = book.title;
            const info = document.createElement('div'); info.className = 'book-info';
            const title = document.createElement('h3'); title.textContent = book.title;
            const normalized = String(book.book_condition || '').trim().toLowerCase().replaceAll(' ', '_');
            const conditionKey = `condition_${normalized.charAt(0).toUpperCase()}${normalized.slice(1)}`;
            const author = document.createElement('p'); author.className = 'author'; author.textContent = `${book.author} · ${translations[conditionKey] || book.book_condition || ''}`;
            const badge = document.createElement('span'); badge.className = `listing-badge ${type.toLowerCase()}`; badge.textContent = t(type);
            const price = document.createElement('div'); price.className = 'price';
            price.textContent = book.listing_type === 'EXCHANGE' ? t('availableForExchange') : new Intl.NumberFormat(document.documentElement.lang, { style: 'currency', currency: 'MAD' }).format(Number(book.price || 0));
            const view = document.createElement('a'); view.className = 'btn-cart'; view.href = `${root.hasAttribute('data-profile-wishlist') ? 'pages/' : ''}book-details.php?id=${encodeURIComponent(book.id)}`; view.textContent = t('viewDetails');
            const remove = document.createElement('button'); remove.type = 'button'; remove.className = 'btn btn-secondary wishlist-remove'; remove.dataset.removeWishlistId = book.id; remove.textContent = t('remove');
            info.append(title, author, price, view, remove); card.append(cover, badge, info); list.append(card);
        });
    };
    async function load() {
        if (loading) return; loading = true;
        roots.forEach(root => { root.querySelector('[data-wishlist-status]').textContent = root.dataset.loadingLabel; });
        const ids = Wishlist.getItems();
        const responses = await Promise.all(ids.map(id => apiRequest(`/books?id=${encodeURIComponent(id)}`, 'GET', null, { redirectOnUnauthorized: false })));
        const books = [];
        let failed = false;
        responses.forEach((response, index) => {
            if (response.status === 404) Wishlist.remove(ids[index]);
            else if (response.ok && response.data?.data) books.push(response.data.data);
            else failed = true;
        });
        roots.forEach(root => { renderRoot(root, books); root.querySelector('[data-wishlist-status]').textContent = ''; });
        loading = false;
        if (failed) throw new Error('wishlist load failed');
    }
    document.addEventListener('click', event => { const button = event.target.closest('[data-remove-wishlist-id]'); if (button) Wishlist.remove(button.dataset.removeWishlistId); });
    const loadSafely = () => load().catch(() => {
        loading = false;
        roots.forEach(root => { root.querySelector('[data-wishlist-status]').textContent = root.dataset.errorLabel; });
    });
    window.addEventListener('wishlistchange', loadSafely);
    loadSafely();
});
