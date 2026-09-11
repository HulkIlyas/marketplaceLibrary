<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';
?>
<header class="main-header">
    <div class="container header-container">

        <!-- Logo -->
        <a href="<?= htmlspecialchars($basePath) ?>index.php" class="header-logo">
            <img src="<?= htmlspecialchars($basePath) ?>assets/images/logo.png" alt="<?= __('header.logoAlt') ?>" width="90" height="70">
            <strong>Marketplace <span>Library</span></strong>
        </a>

        <!-- Search Bar -->
        <form class="search-box" action="<?= htmlspecialchars($basePath) ?>pages/search.php" method="get">
            <input type="search" name="q" placeholder="Search by title, author or ISBN..." aria-label="Search books">
            <button>
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

        <!-- Right Side -->
        <div class="header-actions">
            <button class="menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false"><i class="fa-solid fa-bars"></i></button>
            <a href="<?= htmlspecialchars($basePath) ?>profile.php#sell" class="sell-book-cta"><i class="fa-solid fa-plus"></i> Sell a Book</a>
            <a href="<?= htmlspecialchars($basePath) ?>pages/wishlist.php" class="action-item"><i class="fa-regular fa-heart"></i><span>Wishlist</span></a>

            <a href="<?= htmlspecialchars($basePath) ?>pages/login.php" class="action-item" data-account-link data-profile-href="<?= htmlspecialchars($basePath) ?>profile.php">
                <i class="fa-regular fa-user"></i>
                <span><?= __('header.login') ?></span>
            </a>

            <a href="<?= htmlspecialchars($basePath) ?>pages/register.php" class="action-item">
                <i class="fa-solid fa-user-plus"></i>
                <span><?= __('header.register') ?? 'Register' ?></span>
            </a>

            <a href="<?= htmlspecialchars($basePath) ?>pages/cart.php" class="action-item cart-item">
                <i class="fa-solid fa-cart-shopping"></i>
                <span><?= __('header.cart') ?></span>
                <span class="cart-count">0</span>
            </a>

        </div>

    </div>
</header>
