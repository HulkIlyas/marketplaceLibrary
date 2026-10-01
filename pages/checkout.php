<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';
$basePath = '../';
$pageTitle = __('commerce.checkout') . ' | Marketplace Library';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="inner-page commerce-page" id="checkout-page">
<div class="container checkout-layout">
<form class="checkout-form" id="checkout-form">
<h1><?= __('commerce.checkout') ?></h1>
<p id="commerce-status" class="commerce-status" role="status" aria-live="polite"></p>
<?php foreach (['full_name'=>['name',100], 'email'=>['email',255], 'address'=>['street-address',500], 'city'=>['address-level2',100], 'postal_code'=>['postal-code',30]] as $field=>$attributes): ?>
<label for="<?= $field ?>"><?= __('commerce.' . $field) ?></label>
<input id="<?= $field ?>" name="<?= $field ?>" type="<?= $field === 'email' ? 'email' : 'text' ?>" autocomplete="<?= $attributes[0] ?>" maxlength="<?= $attributes[1] ?>" required />
<?php endforeach; ?>
<p><?= __('commerce.orderRequest') ?></p>
<button class="btn btn-primary" id="place-order" type="submit" disabled><?= __('commerce.placeOrder') ?></button>
<button class="btn btn-secondary" id="commerce-retry" type="button"><?= __('commerce.retry') ?></button>
<a href="cart.php"><?= __('commerce.cart') ?></a>
</form><aside class="order-summary"><h2><?= __('commerce.summary') ?></h2>
<div id="checkout-items"></div><p><span><?= __('commerce.subtotal') ?></span><strong id="cart-subtotal"></strong></p>
<p><span><?= __('commerce.delivery') ?></span><strong><?= __('commerce.later') ?></strong></p>
<p class="total"><span><?= __('commerce.total') ?></span><strong id="cart-total"></strong></p>
</aside></div></main><script src="../assets/js/cart-page.js" defer></script>
<?php require __DIR__ . '/../components/footer.php'; ?>
