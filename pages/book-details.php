<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = __('bookDetails.pageTitle') . ' | Marketplace Library';
$pageStylesheet = 'book-details.css';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="inner-page book-details-page" id="book-details-page"
    data-translations="<?= htmlspecialchars(json_encode($translations['bookDetails'], JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?>">
    <div class="container breadcrumb">
        <a href="../index.php"><?= __('navbar.home') ?></a>
        /
        <a href="books.php"><?= __('navbar.books') ?></a>
        / <span id="book-breadcrumb"><?= __('bookDetails.pageTitle') ?></span>
    </div>
    <div class="container detail-status" id="book-status" role="status" aria-live="polite"><?= __('bookDetails.loading') ?></div>
    <section class="product-detail container" id="book-content" aria-labelledby="book-title" hidden>
        <div class="detail-media">
            <div class="detail-cover cover-one" id="book-cover">
                <img id="book-image" hidden alt="" />
                <small id="cover-edition"></small>
                <strong id="cover-title"></strong>
                <span id="cover-author"></span>
            </div>
            <div class="detail-thumbnails" id="book-thumbnails" aria-label="<?= __('bookDetails.photos') ?>" hidden></div>
        </div>
        <div class="detail-info">
            <span class="listing-badge" id="book-type"></span>
            <h1 id="book-title"></h1>
            <p class="detail-author" id="book-author"></p>
            <div class="detail-meta" id="book-meta"></div>
            <div class="detail-price" id="book-price"></div>
            <p id="book-exchange-note" hidden><?= __('bookDetails.exchangeAccepted') ?></p>
            <p class="detail-description" id="book-description"></p>
            <div class="detail-actions">
                <a href="cart.php" class="btn btn-primary" id="book-cart" hidden>
                    <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                    <?= __('bookDetails.addToCart') ?>
                </a>
                <button type="button" class="btn btn-primary" id="book-exchange" aria-describedby="exchange-unavailable" disabled hidden>
                    <i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i>
                    <?= __('bookDetails.proposeExchange') ?>
                </button>
                <a href="wishlist.php" class="btn btn-secondary">
                    <i class="fa-regular fa-heart" aria-hidden="true"></i>
                    <?= __('bookDetails.save') ?>
                </a>
            </div>
            <p id="exchange-unavailable" hidden><?= __('bookDetails.exchangeUnavailable') ?></p>
            <div class="seller-card" id="book-seller" hidden>
                <span class="avatar" id="owner-avatar" aria-hidden="true"></span>
                <div>
                    <strong id="book-owner"></strong>
                    <small><?= __('bookDetails.owner') ?></small>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="../assets/js/book-details.js" defer></script>
<?php require __DIR__ . '/../components/footer.php'; ?>
