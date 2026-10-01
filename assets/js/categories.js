document.addEventListener('DOMContentLoaded', async () => {
    const categoryGrid = document.getElementById('categoryGrid');

    if (!categoryGrid) return;

    const basePath = categoryGrid.dataset.basePath || '';
    const categoryLabels = new Map(
        Array.from(categoryGrid.querySelectorAll('[data-category-slug]')).map(card => [
            card.dataset.categorySlug,
            card.querySelector('h3')?.textContent.trim(),
        ])
    );

    const formatListingCount = (count) => {
        const numericCount = Number(count) || 0;
        const label = numericCount === 1
            ? categoryGrid.dataset.listingSingular
            : categoryGrid.dataset.listingPlural;

        return `${numericCount} ${label}`;
    };

    try {
        const res = await apiRequest('/category', 'GET');

        if (res.ok && Array.isArray(res.data?.data)) {
            const categories = res.data.data;

            if (categories.length === 0) {
                categoryGrid.innerHTML = `<p>${escapeHtml(categoryGrid.dataset.noCategories)}</p>`;
                return;
            }

            categoryGrid.innerHTML = categories.map(category => {
                const href = `${basePath}pages/books.php?category=${encodeURIComponent(category.slug)}`;
                const iconClass = category.icon || 'fa-solid fa-folder';
                const count = category.listing_count ?? 0;
                const name = categoryLabels.get(category.slug) || category.name;

                return `
                    <a href="${href}" class="category-card" data-category-slug="${escapeHtml(category.slug)}">
                        <span class="category-arrow">→</span>
                        <i class="${escapeHtml(iconClass)}"></i>
                        <h3 data-count="${escapeHtml(formatListingCount(count))}">${escapeHtml(name)}</h3>
                    </a>
                `;
            }).join('');
        } else {
            categoryGrid.innerHTML = `<p>${escapeHtml(categoryGrid.dataset.loadFailed)}</p>`;
        }
    } catch (error) {
        console.error('Error fetching categories:', error);
        categoryGrid.innerHTML = `<p>${escapeHtml(categoryGrid.dataset.loadError)}</p>`;
    }
});

// Helper function to prevent XSS attacks when rendering database content
function escapeHtml(text) {
    const div = document.createElement('div');
    div.innerText = text;
    return div.innerHTML;
}
