document.addEventListener('DOMContentLoaded', async () => {
    const booksGrid = document.getElementById('booksGrid');
    const booksCount = document.getElementById('booksCount');
    const paginationNav = document.getElementById('paginationNav');

    const categorySelect = document.getElementById('categoryFilter');
    const conditionSelect = document.getElementById('conditionFilter');
    const listingTypeSelect = document.getElementById('listingTypeFilter');

    let currentPage = 1;

    if (categorySelect) {
        await loadCategories(categorySelect);
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
                    booksCount.innerText = `${pagination.total_items} books available`;
                }

                booksGrid.innerHTML = '';

                if (books.length === 0) {
                    booksGrid.innerHTML = '<p>No books match your selected filters.</p>';
                    if (paginationNav) paginationNav.innerHTML = '';
                    return;
                }

                const basePath = window.basePath || '';

                booksGrid.innerHTML = books.map(book => {
                    const listingType = (book.listing_type || 'BUY').toUpperCase();
                    const badgeClass = listingType.toLowerCase();
                    const priceFormatted = Math.round(book.price || 0);
                    const coverStyle = book.cover_color ? `style="background-color: ${book.cover_color};"` : '';
                    const coverTitle = escapeHtml(book.title).replace(/\s+/g, '<br />');

                    return `
                        <div class="book-card">
                            <div class="cover cover-one" ${coverStyle}>
                                ${coverTitle}
                            </div>
                            <span class="listing-badge ${badgeClass}">${escapeHtml(listingType)}</span>
                            <button class="wish" aria-label="Save ${escapeHtml(book.title)}">♡</button>

                            <div class="book-info">
                                <h3>${escapeHtml(book.title)}</h3>
                                <p class="author">${escapeHtml(book.author)} · ${escapeHtml(book.book_condition)}</p>
                                <div class="price">${priceFormatted} MAD</div>
                                <a href="book-details.php?id=${book.id}" class="btn-cart">
                                    View Details
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    `;
                }).join('');

                // Render dynamic pagination links
                renderPagination(paginationNav, pagination);

            } else {
                booksGrid.innerHTML = '<p>Failed to load books.</p>';
            }
        } catch (error) {
            console.error('Error fetching filtered books:', error);
            booksGrid.innerHTML = '<p>An error occurred while loading books.</p>';
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

async function loadCategories(selectEl) {
    try {
        const res = await apiRequest('/category', 'GET');
        if (res.ok && Array.isArray(res.data?.data)) {
            res.data.data.forEach(cat => {
                const option = document.createElement('option');
                option.value = cat.slug;
                option.textContent = cat.name;
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