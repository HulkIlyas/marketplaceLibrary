<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';
$basePath = '../';
$pageTitle = __('wishlist.pageTitle') . ' | Marketplace Library';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="inner-page" data-wishlist-page data-loading-label="<?= htmlspecialchars(__('wishlist.loading')) ?>" data-error-label="<?= htmlspecialchars(__('wishlist.loadFailed')) ?>" data-wishlist-translations="<?= htmlspecialchars(json_encode(array_merge($translations['wishlist'], $translations['catalog']), JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?>">
    <section class="page-hero compact"><div class="container">
        <span class="eyebrow"><?= __('wishlist.eyebrow') ?></span><h1><?= __('wishlist.title') ?></h1><p><?= __('wishlist.description') ?></p>
    </div></section>
    <section class="featured-books"><div class="container">
        <p data-wishlist-status role="status" aria-live="polite"></p>
        <div class="book-grid" data-wishlist-list></div>
        <div class="account-empty" data-wishlist-empty hidden><span><i class="fa-regular fa-heart"></i></span>
            <h2><?= __('wishlist.empty') ?></h2><a class="btn btn-primary" href="books.php"><?= __('wishlist.exploreBooks') ?></a>
        </div>
    </div></section>
</main>
<script src="../assets/js/wishlist-page.js" defer></script>
<?php require __DIR__ . '/../components/footer.php'; ?>
