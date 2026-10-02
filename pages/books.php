<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = __('catalog.pageTitle') . ' | Marketplace Library';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="catalog-page">
    <div class="container">
        <span class="eyebrow"><?= __('catalog.eyebrow') ?></span>
        <h1><?= __('catalog.title') ?></h1>
        <div class="catalog-layout">
            <aside class="catalog-filters">
                <strong><?= __('catalog.filters') ?></strong>

                <label for="categoryFilter">
                    <?= __('catalog.category') ?>
                    <select id="categoryFilter">
                        <option value=""><?= __('catalog.allCategories') ?></option>
                        <!-- Dynamic category options loaded from API -->
                    </select>
                </label>

                <label for="conditionFilter">
                    <?= __('catalog.condition') ?>
                    <select id="conditionFilter">
                        <option value=""><?= __('catalog.anyCondition') ?></option>
                        <option value="Like new"><?= __('catalog.likeNew') ?></option>
                        <option value="Very good"><?= __('catalog.veryGood') ?></option>
                        <option value="Good condition"><?= __('catalog.good') ?></option>
                    </select>
                </label>

                <label for="listingTypeFilter">
                    <?= __('catalog.listingType') ?>
                    <select id="listingTypeFilter">
                        <option value=""><?= __('catalog.anyListingType') ?></option>
                        <option value="BUY"><?= __('catalog.buy') ?></option>
                        <option value="SELL"><?= __('catalog.sell') ?></option>
                        <option value="EXCHANGE"><?= __('catalog.exchange') ?></option>
                    </select>
                </label>
            </aside>
            <section>
                <div class="catalog-toolbar">
                    <button class="mobile-filter">
                        <i class="fa-solid fa-sliders"></i>
                        <?= __('catalog.filters') ?>
                    </button>
                    <span
                        id="booksCount"
                        data-listing-singular="<?= htmlspecialchars(__('categories.listing')) ?>"
                        data-listing-plural="<?= htmlspecialchars(__('categories.listings')) ?>"
                        data-translations="<?= htmlspecialchars(json_encode($translations['catalog'], JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?>"
                        aria-live="polite"
                    ></span>
                    <select>
                        <option><?= __('catalog.mostRelevant') ?></option>
                        <option><?= __('catalog.newest') ?></option>
                        <option><?= __('catalog.priceLowHigh') ?></option>
                    </select>
                </div>
                <?php require __DIR__ . '/../components/featured-books.php'; ?>
                <nav class="pagination" id="paginationNav" aria-label="<?= htmlspecialchars(__('catalog.paginationLabel')) ?>">
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
