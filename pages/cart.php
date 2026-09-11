<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = 'Cart | Marketplace Library';

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
            <article>
                <div class="cart-cover pattern-a">
                    ATOMIC
                    <br />
                    HABITS
                </div>
                <div>
                    <h3>Atomic Habits</h3>
                    <p>James Clear · Very good</p>
                    <small>Sold by Salma B. · Marrakech</small>
                </div>
                <strong>180 MAD</strong>
                <button aria-label="Remove item">×</button>
            </article>
            <article>
                <div class="cart-cover pattern-c">
                    LE PETIT
                    <br />
                    PRINCE
                </div>
                <div>
                    <h3>Le Petit Prince</h3>
                    <p>Antoine de Saint-Exupéry · Good</p>
                    <small>Sold by Youssef A. · Rabat</small>
                </div>
                <strong>70 MAD</strong>
                <button aria-label="Remove item">×</button>
            </article>
        </section>
        <aside class="order-summary">
            <h2>Order summary</h2>
            <p>
                <span>Subtotal</span>
                <strong>250 MAD</strong>
            </p>
            <p>
                <span>Delivery</span>
                <strong>Calculated later</strong>
            </p>
            <hr />
            <p class="total">
                <span>Total</span>
                <strong>250 MAD</strong>
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
