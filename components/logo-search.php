<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';
?>
<header class="main-header">
    <div class="container header-container">

        <!-- Logo -->
        <a href="<?= htmlspecialchars($basePath) ?>index.php" class="header-logo">
            <img src="<?= htmlspecialchars($basePath) ?>assets/images/logo.png" alt="<?= __('header.logoAlt') ?>" width="90" height="70">

        </a>

        <!-- Search Bar -->
        <div class="search-box">
            <input type="text" placeholder="<?= __('header.searchPlaceholder') ?>">
            <button>
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>

        <!-- Right Side -->
        <div class="header-actions">

            <a href="<?= htmlspecialchars($basePath) ?>pages/login.php" class="action-item">
                <i class="fa-regular fa-user"></i>
                <span><?= __('header.login') ?></span>
            </a>

            <a href="#" class="action-item cart-item">
                <i class="fa-solid fa-cart-shopping"></i>
                <span><?= __('header.cart') ?></span>
                <span class="cart-count">0</span>
            </a>

        </div>

    </div>
</header>
