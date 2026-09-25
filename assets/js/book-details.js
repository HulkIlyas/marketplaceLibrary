document.addEventListener('DOMContentLoaded', async () => {
    const page = document.getElementById('book-details-page');
    if (!page) return;
    const translations = JSON.parse(page.dataset.translations);
    const text = (key) => translations[key] || key;
    const element = (id) => document.getElementById(id);
    const content = element('book-content');
    const status = element('book-status');
    const id = new URLSearchParams(window.location.search).get('id');

    function showError(message) {
        content.hidden = true;
        status.hidden = false;
        status.textContent = message;
    }

    if (!id || !/^[0-9]+$/.test(id) || !Number.isSafeInteger(Number(id)) || Number(id) <= 0) {
        showError(text('notFound'));
        return;
    }

    function renderImages(book) {
        // Only use URLs supplied by the API; never construct upload paths.
        const images = (Array.isArray(book.images) ? book.images : []).map((image) => {
            try {
                const url = new URL(image.url);
                return ['http:', 'https:'].includes(url.protocol) ? { ...image, url: url.href } : null;
            } catch {
                return null;
            }
        }).filter(Boolean);
        images.sort((a, b) => Number(Boolean(b.is_cover)) - Number(Boolean(a.is_cover)));
        const cover = element('book-cover');
        const primary = element('book-image');
        const fallback = ['cover-edition', 'cover-title', 'cover-author'].map(element);
        const gallery = element('book-thumbnails');
        const buttons = [];
        const showFallback = () => {
            primary.hidden = true;
            cover.classList.remove('has-image');
            fallback.forEach(node => { node.hidden = !node.textContent; });
        };
        primary.onerror = showFallback;
        function select(image, index) {
            primary.alt = `${book.title} — ${text('photo')} ${index + 1}`;
            primary.src = image.url;
            primary.hidden = false;
            cover.classList.add('has-image');
            fallback.forEach(node => { node.hidden = true; });
            buttons.forEach((button, i) => button.setAttribute('aria-pressed', String(i === index)));
        }
        if (!images.length) {
            showFallback();
            return;
        }
        if (images.length > 1) {
            images.forEach((image, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.setAttribute('aria-label', `${text('photo')} ${index + 1}`);
                const thumbnail = document.createElement('img');
                thumbnail.src = image.url;
                thumbnail.alt = '';
                button.append(thumbnail);
                button.addEventListener('click', () => select(image, index));
                buttons.push(button);
                gallery.append(button);
            });
            gallery.hidden = false;
        }
        select(images[0], 0);
    }

    try {
        const result = await apiRequest(`/books?id=${encodeURIComponent(id)}`, 'GET', null, { redirectOnUnauthorized: false });
        if (result.status === 404) {
            showError(text('notFound'));
            return;
        }
        if (!result.ok || !result.data?.data || Number(result.data.data.id) !== Number(id)) {
            showError(text('loadFailed'));
            return;
        }
        const book = result.data.data;
        for (const [node, value] of Object.entries({
            'book-title': book.title, 'book-breadcrumb': book.title, 'book-author': book.author,
            'book-description': book.description, 'cover-title': book.title,
            'cover-author': book.author, 'cover-edition': book.edition, 'book-owner': book.owner_name
        })) {
            element(node).textContent = value ?? '';
        }
        document.title = `${book.title} | Marketplace Library`;
        const meta = element('book-meta');
        for (const [field, label] of [
            ['book_condition', 'condition'], ['city', 'city'], ['owner_name', 'owner'],
            ['genre', 'genre'], ['isbn', 'isbn'], ['edition', 'edition']
        ]) {
            if (!book[field]) continue;
            const node = document.createElement('span');
            node.dataset.field = field;
            node.textContent = `${text(label)}: ${book[field]}`;
            meta.append(node);
        }
        if (book.owner_name) {
            element('owner-avatar').textContent = book.owner_name.trim().split(/\s+/).slice(0, 2).map(word => Array.from(word)[0]).join('').toUpperCase();
            element('book-seller').hidden = false;
        }
        const type = book.listing_type;
        const types = { BUY: 'buy', SELL: 'sell', EXCHANGE: 'exchange', SELL_OR_EXCHANGE: 'sellOrExchange' };
        const badge = element('book-type');
        badge.textContent = types[type] ? text(types[type]) : '';
        badge.hidden = !types[type];
        if (types[type]) badge.classList.add(type.toLowerCase().replaceAll('_', '-'));
        const exchange = type === 'EXCHANGE' || type === 'SELL_OR_EXCHANGE';
        const sell = ['BUY', 'SELL', 'SELL_OR_EXCHANGE'].includes(type);
        element('book-cart').hidden = !sell;
        element('book-exchange').hidden = !exchange;
        element('exchange-unavailable').hidden = !exchange;
        element('book-exchange-note').hidden = type !== 'SELL_OR_EXCHANGE';
        const price = element('book-price');
        if (type === 'EXCHANGE') {
            price.textContent = text('availableForExchange');
        } else if (sell && book.price !== null && Number.isFinite(Number(book.price))) {
            price.textContent = new Intl.NumberFormat(document.documentElement.lang, {
                style: 'currency', currency: 'MAD'
            }).format(Number(book.price));
        } else {
            price.hidden = true;
        }
        renderImages(book);
        status.hidden = true;
        content.hidden = false;
    } catch (error) {
        showError(text('loadFailed'));
    }
});
