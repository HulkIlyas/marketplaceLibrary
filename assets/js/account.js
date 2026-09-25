document.addEventListener('DOMContentLoaded', () => {
    const user = Auth.getUserPayload();

    if (!user || !Auth.isAuthenticated()) {
        window.location.replace('pages/login.php');
        return;
    }

    const name = user.name || 'Marketplace Library reader';
    const email = user.email || '—';
    const initials =
        name
            .split(/\s+/)
            .filter(Boolean)
            .slice(0, 2)
            .map((part) => part[0].toUpperCase())
            .join('') || 'ML';

    const setText = (id, value) => {
        const element = document.getElementById(id);
        if (element) element.textContent = value;
    };

    setText('account-avatar', initials);
    setText('sidebar-avatar', initials);
    setText('account-name', name);
    setText('sidebar-name', name);
    setText('welcome-name', name.split(/\s+/)[0]);
    setText('account-email', email);
    setText('settings-name', name);
    setText('settings-email', email);
    setText('settings-user-id', user.user_id ?? '—');

    const tabs = [...document.querySelectorAll('[data-tab]')];
    const panels = [...document.querySelectorAll('[data-panel]')];

    const translations = JSON.parse(document.querySelector('.account-page').dataset.listingTranslations);
    const t = key => translations[key] || key;
    const list = document.getElementById('my-listings');
    const empty = document.getElementById('listings-empty');
    const status = document.getElementById('listings-status');
    const dialog = document.getElementById('delete-listing-dialog');
    const confirm = document.getElementById('confirm-listing-delete');
    const cancel = document.getElementById('cancel-listing-delete');
    let listings = [];
    let loading = false;
    let deleting = false;
    let selectedId = null;

    function node(tag, value, className) {
        const item = document.createElement(tag);
        if (value !== undefined) item.textContent = value;
        if (className) item.className = className;
        return item;
    }

    function renderListings() {
        list.replaceChildren();
        setText('active-listings-count', listings.length);
        empty.hidden = listings.length !== 0;
        listings.forEach(book => {
            const card = node('article', undefined, 'account-card listing-card');
            card.dataset.listingId = book.id;
            const cover = node('div', undefined, 'listing-cover');
            const placeholder = node('span', book.title);
            cover.append(placeholder);
            const images = Array.isArray(book.images) ? book.images : [];
            const image = images.find(image => image.is_cover) || images[0];
            if (image?.url) {
                try {
                    const url = new URL(image.url);
                    if (['http:', 'https:'].includes(url.protocol)) {
                        const img = node('img');
                        img.src = url.href;
                        img.alt = book.title;
                        img.loading = 'lazy';
                        placeholder.hidden = true;
                        img.onerror = () => { img.remove(); placeholder.hidden = false; };
                        cover.append(img);
                    }
                } catch { /* Keep the title cover for unavailable image URLs. */ }
            }
            const info = node('div', undefined, 'listing-info');
            info.append(node('h3', book.title), node('p', book.author));
            info.append(node('p', [book.book_condition, book.city].filter(Boolean).join(' · ')));
            const labels = { BUY: 'buy', SELL: 'sell', EXCHANGE: 'exchange', SELL_OR_EXCHANGE: 'sellOrExchange' };
            info.append(node('span', t(labels[book.listing_type] || 'sell'), 'listing-type'));
            info.append(node('strong', book.listing_type === 'EXCHANGE' ? t('availableForExchange')
                : new Intl.NumberFormat(document.documentElement.lang, { style: 'currency', currency: 'MAD' }).format(Number(book.price)), 'listing-price'));
            const actions = node('div', undefined, 'listing-actions');
            const view = node('a', t('view'), 'btn btn-secondary');
            view.href = `pages/book-details.php?id=${encodeURIComponent(book.id)}`;
            const remove = node('button', t('delete'), 'btn btn-secondary');
            remove.type = 'button';
            remove.dataset.deleteId = book.id;
            remove.addEventListener('click', () => {
                if (deleting) return;
                selectedId = book.id;
                setText('delete-listing-error', '');
                dialog.showModal();
            });
            actions.append(view, remove);
            info.append(actions);
            card.append(cover, info);
            list.append(card);
        });
    }

    async function loadListings() {
        if (loading || deleting) return;
        loading = true;
        empty.hidden = true;
        status.textContent = t('loading');
        try {
            const result = await apiRequest('/books/mine', 'GET', null, { redirectOnUnauthorized: false });
            if (!result.ok || !Array.isArray(result.data?.data)) throw new Error(result.data?.error || t('loadFailed'));
            listings = result.data.data;
            renderListings();
            status.textContent = '';
        } catch (error) {
            status.textContent = error.message || t('loadFailed');
        } finally {
            loading = false;
        }
    }

    cancel.addEventListener('click', () => { if (!deleting) dialog.close(); });
    dialog.addEventListener('cancel', event => { if (deleting) event.preventDefault(); });
    confirm.addEventListener('click', async () => {
        if (deleting || loading || selectedId === null) return;
        deleting = true;
        confirm.disabled = cancel.disabled = true;
        confirm.textContent = t('deleting');
        const id = selectedId;
        const cardButton = list.querySelector(`[data-delete-id="${id}"]`);
        if (cardButton) cardButton.disabled = true;
        setText('delete-listing-error', '');
        try {
            const result = await apiRequest(`/books?id=${encodeURIComponent(id)}`, 'DELETE', null, { redirectOnUnauthorized: false });
            if (!result.ok) throw new Error(result.data?.error || t('deleteFailed'));
            listings = listings.filter(book => book.id !== id);
            dialog.close();
            renderListings();
            status.textContent = t('deleted');
            const next = list.querySelector('a') || empty.querySelector('a');
            next?.focus();
        } catch (error) {
            setText('delete-listing-error', error.message || t('deleteFailed'));
            if (cardButton) cardButton.disabled = false;
        } finally {
            deleting = false;
            confirm.disabled = cancel.disabled = false;
            confirm.textContent = t('deleteListing');
        }
    });

    const showPanel = (name) => {
        const panelExists = panels.some((panel) => panel.dataset.panel === name);
        const selected = panelExists ? name : 'overview';

        tabs.forEach((tab) => {
            const active = tab.dataset.tab === selected;
            tab.classList.toggle('is-active', active);
            tab.setAttribute('aria-selected', String(active));
        });

        panels.forEach((panel) => {
            const active = panel.dataset.panel === selected;
            panel.classList.toggle('is-active', active);
            panel.hidden = !active;
        });

        history.replaceState(null, '', `#${selected}`);
        if (selected === 'listings' || selected === 'overview') loadListings();
    };

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => showPanel(tab.dataset.tab));
    });

    document.querySelectorAll('[data-account-tab]').forEach((button) => {
        button.addEventListener('click', () => showPanel(button.dataset.accountTab));
    });

    document.getElementById('logout-button')?.addEventListener('click', () => {
        Auth.logout();
        window.location.href = 'pages/login.php';
    });

    showPanel(window.location.hash.slice(1) || 'overview');
    window.addEventListener('hashchange', () => showPanel(window.location.hash.slice(1)));
});
