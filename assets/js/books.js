document.addEventListener('DOMContentLoaded', async () => {
    const booksGrid = document.getElementById('booksGrid');

    if (!booksGrid) return;

    try {
        const res = await apiRequest('/books', 'GET');

        if (res.ok && Array.isArray(res.data?.data)) {
            const books = res.data.data;

            booksGrid.innerHTML = '';

            if (books.length === 0) {
                booksGrid.innerHTML = '<p>No books found.</p>';
                return;
            }

            const basePath = window.basePath || '';

            booksGrid.innerHTML = books.map(book => {
                const listingType = (book.listing_type || 'BUY').toUpperCase();
                const badgeClass = listingType.toLowerCase(); // buy, sell, or exchange
                const priceFormatted = Math.round(book.price || 0);
                const coverStyle = book.cover_color ? `style="background-color: ${book.cover_color};"` : '';

                // Formats title for cover text (e.g. ATOMIC<br />HABITS)
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

                            <a href="${basePath}pages/book-details.php?id=${book.id}" class="btn-cart">
                                View Details
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                `;
            }).join('');
        } else {
            booksGrid.innerHTML = '<p>Failed to load books.</p>';
        }
    } catch (error) {
        console.error('Error fetching books:', error);
        booksGrid.innerHTML = '<p>An error occurred while loading books.</p>';
    }
});

// Helper function to prevent XSS vulnerability
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.innerText = text;
    return div.innerHTML;
}