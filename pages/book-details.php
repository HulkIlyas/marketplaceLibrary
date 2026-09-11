<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = 'Atomic Habits | Marketplace Library';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="inner-page">
    <div class="container breadcrumb">
        <a href="../index.php">Home</a>
        /
        <a href="books.php">Books</a>
        / Atomic Habits
    </div>
    <section class="product-detail container">
        <div class="detail-cover cover-one">
            <small>MARKETPLACE EDITION</small>
            <strong>
                ATOMIC
                <br />
                HABITS
            </strong>
            <span>James Clear</span>
        </div>
        <div class="detail-info">
            <span class="listing-badge buy">BUY</span>
            <h1>Atomic Habits</h1>
            <p class="detail-author">James Clear</p>
            <div class="detail-meta">
                <span>
                    <i class="fa-solid fa-book-open"></i>
                    Very good
                </span>
                <span>
                    <i class="fa-solid fa-location-dot"></i>
                    Marrakech
                </span>
                <span>
                    <i class="fa-regular fa-user"></i>
                    Salma B.
                </span>
            </div>
            <div class="detail-price">180 MAD</div>
            <p>
                A carefully kept copy with minimal signs of use. Clean pages, firm binding and ready for its next
                reader.
            </p>
            <div class="detail-actions">
                <a href="cart.php" class="btn btn-primary">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Add to cart
                </a>
                <a href="wishlist.php" class="btn btn-secondary">
                    <i class="fa-regular fa-heart"></i>
                    Save
                </a>
            </div>
            <div class="seller-card">
                <span class="avatar">SB</span>
                <div>
                    <strong>Salma B.</strong>
                    <small>Verified reader · 18 books sold</small>
                </div>
                <a href="../profile.php">View profile →</a>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__ . '/../components/footer.php'; ?>
