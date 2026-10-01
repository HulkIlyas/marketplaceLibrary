<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';
$basePath = '../';
$pageTitle = __('commerce.cart') . ' | Marketplace Library';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="inner-page commerce-page" id="cart-page">
<section class="page-hero compact"><div class="container">
<h1><?= __('commerce.cart') ?></h1><p id="cart-count"></p>
<p id="commerce-status" class="commerce-status" role="status" aria-live="polite"></p>
<button type="button" id="commerce-retry" class="btn btn-secondary"><?= __('commerce.retry') ?></button>
</div></section>
<div class="container cart-layout">
<section><div id="cart-items" class="commerce-items"></div><div id="cart-empty" hidden>
<h2><?= __('commerce.emptyCart') ?></h2><a href="books.php" class="btn btn-primary"><?= __('commerce.browse') ?></a>
</div></section>
<aside class="order-summary"><h2><?= __('commerce.summary') ?></h2><p><span><?= __('commerce.subtotal') ?></span><strong id="cart-subtotal"></strong></p>
<p><span><?= __('commerce.delivery') ?></span><strong><?= __('commerce.later') ?></strong></p>
<p class="total"><span><?= __('commerce.total') ?></span><strong id="cart-total"></strong></p>
<a href="checkout.php" id="checkout-link" class="btn btn-primary" hidden><?= __('commerce.continue') ?></a>
</aside></div></main><script src="../assets/js/cart-page.js" defer></script>
<?php require __DIR__ . '/../components/footer.php'; ?>
