document.addEventListener('DOMContentLoaded', () => {
    const page = document.getElementById('search-page');
    if (!page) return;
    const results = document.getElementById('search-results');
    const count = document.getElementById('search-count');
    const pagination = document.getElementById('search-pagination');
    const translations = JSON.parse(page.dataset.translations || '{}');
    const t = key => translations[key] || key;
    const query = page.dataset.query.trim();
    const requestedPage = Math.max(1, parseInt(new URLSearchParams(location.search).get('page'), 10) || 1);
    const escape = value => { const node = document.createElement('div'); node.textContent = value ?? ''; return node.innerHTML; };
    const condition = value => {
        const normalized = String(value || '').trim().toLowerCase().replaceAll(' ', '_');
        const key = `condition_${normalized.charAt(0).toUpperCase()}${normalized.slice(1)}`;
        return translations[key] || value;
    };
    const price = book => book.listing_type === 'EXCHANGE' ? t('availableForExchange')
        : new Intl.NumberFormat(document.documentElement.lang, { style: 'currency', currency: 'MAD' }).format(Number(book.price || 0));
    const cover = book => {
        const images = Array.isArray(book.images) ? book.images : [];
        const image = images.find(item => item.is_cover) || images[0];
        if (image?.url) try {
            const url = new URL(image.url);
            if (['http:', 'https:'].includes(url.protocol)) return `<div class="cover cover-one has-image"><img src="${escape(url.href)}" alt="${escape(book.title)}" loading="lazy"></div>`;
        } catch { /* Render the safe title fallback. */ }
        return `<div class="cover cover-one">${escape(book.title).replace(/\s+/g, '<br>')}</div>`;
    };
    const card = book => {
        const type = String(book.listing_type || 'SELL').toUpperCase();
        const saved = Wishlist.has(book.id);
        return `<article class="book-card">${cover(book)}<span class="listing-badge ${type.toLowerCase()}">${escape(t(type))}</span>
            <button type="button" class="wish${saved ? ' is-saved' : ''}" data-book-id="${Number(book.id)}" aria-pressed="${saved}" aria-label="${escape(t('saveBook').replace('%s', book.title))}">${saved ? '♥' : '♡'}</button>
            <div class="book-info"><h3>${escape(book.title)}</h3><p class="author">${escape(book.author)} · ${escape(condition(book.book_condition))}</p>
            <div class="price">${escape(price(book))}</div><a class="btn-cart" href="book-details.php?id=${encodeURIComponent(book.id)}">${escape(t('viewDetails'))} <i class="fa-solid fa-arrow-right"></i></a></div></article>`;
    };
    const renderPagination = meta => {
        pagination.replaceChildren();
        const totalPages = Number(meta.total_pages);
        const currentPage = Number(meta.current_page);
        if (totalPages <= 1) return;
        const addLink = (label, number, disabled = false) => {
            const link = document.createElement('a');
            link.textContent = label;
            link.href = disabled ? '#' : `search.php?${new URLSearchParams({ q: query, page: number })}`;
            if (disabled) { link.className = 'disabled'; link.setAttribute('aria-disabled', 'true'); }
            pagination.append(link);
        };
        addLink('←', Math.max(1, currentPage - 1), currentPage === 1);
        for (let number = 1; number <= totalPages; number += 1) {
            const link = document.createElement('a');
            link.href = `search.php?${new URLSearchParams({ q: query, page: number })}`;
            link.textContent = number;
            if (number === Number(meta.current_page)) { link.className = 'current'; link.setAttribute('aria-current', 'page'); }
            pagination.append(link);
        }
        addLink('→', Math.min(totalPages, currentPage + 1), currentPage === totalPages);
    };
    if (!query) { count.textContent = t('enterTerm'); return; }
    count.textContent = t('loading');
    const params = new URLSearchParams({ q: query, page: requestedPage, limit: 6 });
    apiRequest(`/books?${params}`, 'GET', null, { redirectOnUnauthorized: false }).then(response => {
        if (!response.ok || !Array.isArray(response.data?.data)) throw new Error('invalid response');
        const books = response.data.data;
        const total = Number(response.data.pagination?.total_items) || 0;
        count.textContent = `${total} ${t(total === 1 ? 'result' : 'results')}`;
        results.innerHTML = books.length ? books.map(card).join('') : `<p>${escape(t('noResults'))}</p>`;
        Wishlist.refreshButtons();
        renderPagination(response.data.pagination || {});
    }).catch(() => { count.textContent = t('searchFailed'); results.replaceChildren(); });
});
