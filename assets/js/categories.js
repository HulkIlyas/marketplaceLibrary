document.addEventListener('DOMContentLoaded', async () => {
    const categoryGrid = document.getElementById('categoryGrid');

    if (!categoryGrid) return;

    try {
        // Fetch categories from your API endpoint
        const res = await apiRequest('/category', 'GET');

        if (res.ok && Array.isArray(res.data?.data)) {
            const categories = res.data.data;

            // Clear any loading indicator or existing content
            categoryGrid.innerHTML = '';

            if (categories.length === 0) {
                categoryGrid.innerHTML = '<p>No categories found.</p>';
                return;
            }

            // Define base path (fallback to empty string if undefined)
            const basePath = window.basePath || '';

            // Render category cards dynamically
            categoryGrid.innerHTML = categories.map(category => {
                const href = `${basePath}category.php?category=${encodeURIComponent(category.slug)}`;
                const iconClass = category.icon || 'fa-solid fa-folder';

                return `
                    <a href="${href}" class="category-card">
                        <span class="category-arrow">→</span>
                        <i class="${iconClass}"></i>
                        <h3>${escapeHtml(category.name)}</h3>
                    </a>
                `;
            }).join('');
        } else {
            categoryGrid.innerHTML = '<p>Failed to load categories.</p>';
        }
    } catch (error) {
        console.error('Error fetching categories:', error);
        categoryGrid.innerHTML = '<p>An error occurred while loading categories.</p>';
    }
});

// Helper function to prevent XSS attacks when rendering database content
function escapeHtml(text) {
    const div = document.createElement('div');
    div.innerText = text;
    return div.innerHTML;
}