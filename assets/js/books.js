document.addEventListener('DOMContentLoaded', async () => {
    const booksGrid = document.getElementById('booksGrid');
    const booksCount = document.getElementById('booksCount');
    const paginationNav = document.getElementById('paginationNav');

    const categorySelect = document.getElementById('categoryFilter');
    const conditionSelect = document.getElementById('conditionFilter');
    const listingTypeSelect = document.getElementById('listingTypeFilter');
    const translations = JSON.parse(booksCount?.dataset.translations || '{}');
    const text = (key) => translations[key] || key;

    let currentPage = 1;

    if (categorySelect) {
        await loadCategories(categorySelect, translations);
    }

    async function fetchFilteredBooks(page = 1) {
        if (!booksGrid) return;
        currentPage = page;

        const params = new URLSearchParams();
        params.append('page', currentPage);
        params.append('limit', 6); // Set items per page

        if (categorySelect?.value) params.append('category', categorySelect.value);
        if (conditionSelect?.value) params.append('condition', conditionSelect.value);
        if (listingTypeSelect?.value) params.append('type', listingTypeSelect.value);

        try {
            const res = await apiRequest(`/books?${params.toString()}`, 'GET');

            if (res.ok && Array.isArray(res.data?.data)) {
                const books = res.data.data;
                const pagination = res.data.pagination;

                if (booksCount) {
                    const count = Number(pagination.total_items) || 0;
                    const label = count === 1
                        ? booksCount.dataset.listingSingular
                        : booksCount.dataset.listingPlural;
                    booksCount.textContent = `${count} ${label}`;
                }

                booksGrid.innerHTML = '';

                if (books.length === 0) {
                    booksGrid.innerHTML = `<p>${escapeHtml(text('noBooks'))}</p>`;
                    if (paginationNav) paginationNav.innerHTML = '';
                    return;
                }

                const basePath = window.basePath || '';

                booksGrid.innerHTML = books.map(book => {
                    const listingType = (book.listing_type || 'BUY').toUpperCase();
                    const badgeClass = listingType.toLowerCase();
                    const priceFormatted = listingType === 'EXCHANGE'
                        ? text('availableForExchange')
                        : `${Math.round(book.price || 0)} MAD`;
                    const coverStyle = book.cover_color ? `style="background-color: ${book.cover_color};"` : '';
                    const coverTitle = escapeHtml(book.title).replace(/\s+/g, '<br />');

                    return `
                        <div class="book-card">
                            <div class="cover cover-one" ${coverStyle}>
                                ${coverTitle}
                            </div>
                            <span class="listing-badge ${badgeClass}">${escapeHtml(text(listingType))}</span>
                            <button type="button" class="wish${Wishlist.has(book.id) ? ' is-saved' : ''}" data-book-id="${Number(book.id)}" aria-pressed="${Wishlist.has(book.id)}" aria-label="${escapeHtml(text('saveBook').replace('%s', book.title))}">${Wishlist.has(book.id) ? '♥' : '♡'}</button>

                            <div class="book-info">
                                <h3>${escapeHtml(book.title)}</h3>
                                <p class="author">${escapeHtml(book.author)} · ${escapeHtml(conditionLabel(book.book_condition))}</p>
                                <div class="price">${escapeHtml(priceFormatted)}</div>
                                <a href="book-details.php?id=${book.id}" class="btn-cart">
                                    ${escapeHtml(text('viewDetails'))}
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    `;
                }).join('');
                Wishlist.refreshButtons();

                // Render dynamic pagination links
                renderPagination(paginationNav, pagination);

            } else {
                booksGrid.innerHTML = `<p>${escapeHtml(text('loadFailed'))}</p>`;
            }
        } catch (error) {
            console.error('Error fetching filtered books:', error);
            booksGrid.innerHTML = `<p>${escapeHtml(text('loadError'))}</p>`;
        }
    }

    // Dynamic pagination markup renderer matching your UI design
    function renderPagination(navElement, { current_page, total_pages }) {
        if (!navElement || total_pages <= 1) {
            if (navElement) navElement.innerHTML = '';
            return;
        }

        let html = '';

        // Previous button
        const prevPage = Math.max(1, current_page - 1);
        html += `<a href="#" data-page="${prevPage}" class="${current_page === 1 ? 'disabled' : ''}">←</a>`;

        // Page Numbers
        for (let i = 1; i <= total_pages; i++) {
            const activeClass = i === current_page ? 'class="current"' : '';
            html += `<a href="#" ${activeClass} data-page="${i}">${i}</a>`;
        }

        // Next button
        const nextPage = Math.min(total_pages, current_page + 1);
        html += `<a href="#" data-page="${nextPage}" class="${current_page === total_pages ? 'disabled' : ''}">→</a>`;

        navElement.innerHTML = html;

        // Attach click handlers to page links
        navElement.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetPage = parseInt(link.getAttribute('data-page'));
                if (targetPage && targetPage !== current_page) {
                    fetchFilteredBooks(targetPage);
                }
            });
        });
    }

    // Filter changes reset pagination back to Page 1
    [categorySelect, conditionSelect, listingTypeSelect].forEach(selectEl => {
        if (selectEl) {
            selectEl.addEventListener('change', () => fetchFilteredBooks(1));
        }
    });

    fetchFilteredBooks(1);
});

function conditionLabel(value) {
    const normalized = String(value || '').trim().toLowerCase().replaceAll(' ', '_');
    const key = `condition_${normalized.charAt(0).toUpperCase()}${normalized.slice(1)}`;
    return translationsForCatalog()[key] || value;
}

function translationsForCatalog() {
    const count = document.getElementById('booksCount');
    return JSON.parse(count?.dataset.translations || '{}');
}

async function loadCategories(selectEl, translations = {}) {
    try {
        const res = await apiRequest('/category', 'GET');
        if (res.ok && Array.isArray(res.data?.data)) {
            res.data.data.forEach(cat => {
                const option = document.createElement('option');
                option.value = cat.slug;
                option.textContent = translations[`category_${cat.slug}`] || cat.name;
                selectEl.appendChild(option);
            });

            const urlParams = new URLSearchParams(window.location.search);
            const activeCategory = urlParams.get('category');
            if (activeCategory) {
                selectEl.value = activeCategory;
            }
        }
    } catch (err) {
        console.error('Failed to load categories:', err);
    }
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.innerText = text;
    return div.innerHTML;
}
