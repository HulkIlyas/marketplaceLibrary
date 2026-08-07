<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$currentPage = 'categories';
$pageTitle = __('categoryPage.browseTitle') . ' | Marketplace Library';

$categories = [
    'books' => ['icon' => 'fa-solid fa-book', 'translation' => 'books'],
    'stationery' => ['icon' => 'fa-solid fa-pencil', 'translation' => 'stationery'],
    'digital' => ['icon' => 'fa-solid fa-laptop', 'translation' => 'digital'],
    'school' => ['icon' => 'fa-solid fa-school', 'translation' => 'school'],
    'art' => ['icon' => 'fa-solid fa-palette', 'translation' => 'art'],
    'manga' => ['icon' => 'fa-solid fa-book-open', 'translation' => 'manga'],
];

$requestedCategory = isset($_GET['category']) ? strtolower(trim($_GET['category'])) : '';
$selectedCategory = array_key_exists($requestedCategory, $categories) ? $requestedCategory : null;
$showEmptyState = $requestedCategory === 'empty';

$products = [
    ['title' => 'Atomic Habits', 'author' => 'James Clear', 'condition' => 'veryGood', 'price' => 180],
    ['title' => 'The Psychology of Money', 'author' => 'Morgan Housel', 'condition' => 'likeNew', 'price' => 150],
    ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'condition' => 'good', 'price' => 210],
    ['title' => 'Deep Work', 'author' => 'Cal Newport', 'condition' => 'veryGood', 'price' => 170],
];

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>

<main class="categories-page">
    <header class="categories-page-header">
        <div class="category-page-container">
            <nav class="category-breadcrumb" aria-label="<?= __('categoryPage.breadcrumbLabel') ?>">
                <a href="../index.php"><?= __('navbar.home') ?></a>
                <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                <a href="category.php"><?= __('navbar.categories') ?></a>
                <?php if ($selectedCategory): ?>
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    <span aria-current="page"><?= __('categories.' . $categories[$selectedCategory]['translation']) ?></span>
                <?php endif; ?>
            </nav>
            <h1><?= $selectedCategory ? __('categories.' . $categories[$selectedCategory]['translation']) : __('categoryPage.browseTitle') ?></h1>
            <p><?= $selectedCategory ? __('categoryPage.selectedDescription') : __('categoryPage.browseDescription') ?></p>
        </div>
    </header>

    <?php if (!$selectedCategory && !$showEmptyState): ?>
        <section class="category-browser" aria-labelledby="category-grid-title">
            <div class="category-page-container">
                <div class="category-section-heading">
                    <h2 id="category-grid-title"><?= __('categoryPage.chooseCategory') ?></h2>
                    <p><?= __('categoryPage.chooseDescription') ?></p>
                </div>
                <div class="category-browser-grid">
                    <?php foreach ($categories as $slug => $category): ?>
                        <a class="category-browser-card" href="category.php?category=<?= urlencode($slug) ?>">
                            <span class="category-card-icon"><i class="<?= $category['icon'] ?>" aria-hidden="true"></i></span>
                            <span class="category-card-content">
                                <strong><?= __('categories.' . $category['translation']) ?></strong>
                                <span><?= __('categoryPage.descriptions.' . $category['translation']) ?></span>
                                <small><?= __('categoryPage.itemCount') ?></small>
                                <span class="category-card-link"><?= __('categoryPage.viewBooks') ?> <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></span>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="category-products">
            <div class="category-page-container">
                <div class="category-toolbar">
                    <strong><?= $showEmptyState ? '0' : '24' ?> <?= __('categoryPage.results') ?></strong>
                    <label for="sort-products"><?= __('categoryPage.sortBy') ?></label>
                    <select id="sort-products" aria-label="<?= __('categoryPage.sortBy') ?>">
                        <option><?= __('categoryPage.relevance') ?></option>
                        <option><?= __('categoryPage.priceLowHigh') ?></option>
                        <option><?= __('categoryPage.priceHighLow') ?></option>
                        <option><?= __('categoryPage.newest') ?></option>
                    </select>
                </div>

                <div class="category-layout">
                    <aside class="category-sidebar" aria-label="<?= __('categoryPage.filters') ?>">
                        <details open>
                            <summary><?= __('navbar.categories') ?></summary>
                            <div class="filter-options">
                                <?php foreach ($categories as $slug => $category): ?>
                                    <label><input type="checkbox"<?= $slug === $selectedCategory ? ' checked' : '' ?>> <?= __('categories.' . $category['translation']) ?></label>
                                <?php endforeach; ?>
                            </div>
                        </details>
                        <details open>
                            <summary><?= __('categoryPage.price') ?></summary>
                            <div class="price-inputs"><input type="number" min="0" placeholder="<?= __('categoryPage.minimum') ?>"><span>–</span><input type="number" min="0" placeholder="<?= __('categoryPage.maximum') ?>"></div>
                        </details>
                        <details open>
                            <summary><?= __('categoryPage.condition') ?></summary>
                            <div class="filter-options">
                                <?php foreach (['likeNew', 'veryGood', 'good', 'acceptable'] as $condition): ?>
                                    <label><input type="checkbox"> <?= __('categoryPage.' . $condition) ?></label>
                                <?php endforeach; ?>
                            </div>
                        </details>
                    </aside>

                    <div class="category-results">
                        <?php if ($showEmptyState): ?>
                            <div class="empty-state">
                                <span><i class="fa-solid fa-book-open" aria-hidden="true"></i></span>
                                <h2><?= __('categoryPage.noProducts') ?></h2>
                                <p><?= __('categoryPage.noProductsDescription') ?></p>
                                <a href="category.php" class="btn btn-primary"><?= __('categoryPage.allCategories') ?></a>
                            </div>
                        <?php else: ?>
                            <div class="category-product-grid">
                                <?php foreach ($products as $product): ?>
                                    <article class="book-card category-book-card">
                                        <div class="book-image-wrap">
                                            <img src="../assets/images/hero-books.png" alt="<?= htmlspecialchars($product['title']) ?>">
                                            <button type="button" class="wishlist-button" aria-label="<?= __('categoryPage.addWishlist') ?>"><i class="fa-regular fa-heart" aria-hidden="true"></i></button>
                                        </div>
                                        <div class="book-info">
                                            <h3><?= htmlspecialchars($product['title']) ?></h3>
                                            <p class="author"><?= htmlspecialchars($product['author']) ?></p>
                                            <p class="book-condition"><?= __('categoryPage.condition') ?> : <?= __('categoryPage.' . $product['condition']) ?></p>
                                            <div class="price"><?= $product['price'] ?> MAD</div>
                                            <a href="book-details.php" class="btn-cart"><?= __('categoryPage.viewBook') ?></a>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
