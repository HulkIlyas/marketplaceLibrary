<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = 'Books | Marketplace Library';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="catalog-page">
    <div class="container">
        <span class="eyebrow">MARKETPLACE</span>
        <h1>Find your next favourite book.</h1>
        <div class="catalog-layout">
            <aside class="catalog-filters">
                <strong>Filters</strong>
                <label>
                    Category
                    <select>
                        <option>All categories</option>
                        <option>Books</option>
                        <option>Manga</option>
                    </select>
                </label>
                <label>
                    Condition
                    <select>
                        <option>Any condition</option>
                        <option>Like new</option>
                        <option>Very good</option>
                    </select>
                </label>
                <label>
                    Listing type
                    <select>
                        <option>Buy, sell or exchange</option>
                        <option>Buy</option>
                        <option>Exchange</option>
                    </select>
                </label>
            </aside>
            <section>
                <div class="catalog-toolbar">
                    <button class="mobile-filter">
                        <i class="fa-solid fa-sliders"></i>
                        Filters
                    </button>
                    <span>24 books available</span>
                    <select>
                        <option>Most relevant</option>
                        <option>Newest</option>
                        <option>Price: low to high</option>
                    </select>
                </div>
                <?php require __DIR__ . '/../components/featured-books.php'; ?>
                <nav class="pagination" aria-label="Catalog pages">
                    <a href="?page=1">←</a>
                    <a class="current" href="?page=1">1</a>
                    <a href="?page=2">2</a>
                    <a href="?page=3">3</a>
                    <a href="?page=2">→</a>
                </nav>
            </section>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../components/footer.php'; ?>
