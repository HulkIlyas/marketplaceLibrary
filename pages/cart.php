<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

// Ensure session is active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$basePath = '../';
$pageTitle = 'Cart | Marketplace Library';

// Handle item removal via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'remove') {
    $itemId = $_POST['item_id'] ?? null;
    if ($itemId !== null && isset($_SESSION['cart'][$itemId])) {
        unset($_SESSION['cart'][$itemId]);
    }
    header('Location: cart.php');
    exit;
}

// Get cart items from session (array of items)
$cartItems = $_SESSION['cart'] ?? [];
$itemCount = count($cartItems);
$subtotal = 0;

foreach ($cartItems as $item) {
    $subtotal += (float) ($item['price'] ?? 0);
}

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?> 
<main class="inner-page">
    <section class="page-hero compact">
        <div class="container">
            <span class="eyebrow">YOUR SELECTION</span>
            <h1>Shopping cart</h1>
            <p>2 pre-loved books are ready for a new shelf.</p>
        </div>
    </section>
    <div class="container cart-layout">
        <section class="cart-items">
            <?php foreach ($cartItems as $id => $item): ?>
                <article>
                    <div class="cart-cover <?= htmlspecialchars($item['pattern_class'] ?? 'pattern-a') ?>">
                        <?= nl2br(htmlspecialchars($item['cover_text'] ?? $item['title'])) ?>
                    </div>
                    <div>
                        <h3><?= htmlspecialchars($item['title']) ?></h3>
                        <p><?= htmlspecialchars($item['author']) ?> · <?= htmlspecialchars($item['condition']) ?></p>
                        <small>Sold by <?= htmlspecialchars($item['seller_name']) ?> · <?= htmlspecialchars($item['seller_city']) ?></small>
                    </div>
                    <strong><?= number_format($item['price'], 2) ?> MAD</strong>
                    <form method="POST" action="cart.php" style="margin: 0;">
                        <input type="hidden" name="action" value="remove">
                        <input type="hidden" name="item_id" value="<?= htmlspecialchars($id) ?>">
                        <button type="submit" aria-label="Remove item">×</button>
                    </form>
                </article>
            <?php endforeach; ?>
        </section>
        <aside class="order-summary">
            <h2>Order summary</h2>
            <p>
                <span>Subtotal</span>
                <strong><?= number_format($subtotal, 2) ?> MAD</strong>
            </p>
            <p>
                <span>Delivery</span>
                <strong>Calculated later</strong>
            </p>
            <hr />
            <p class="total">
                <span>Total</span>
                <strong><?= number_format($subtotal, 2) ?> MAD</strong>
            </p>
            <a class="btn btn-primary" href="checkout.php">Continue to checkout</a>
            <small>
                <i class="fa-solid fa-lock"></i>
                Secure checkout
            </small>
        </aside>
    </div>
</main>
<?php require __DIR__ . '/../components/footer.php'; ?>