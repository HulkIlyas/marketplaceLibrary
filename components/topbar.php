<?php

$params = $_GET;
?>
<section class="topbar">
    <div class="container topbar-container">
        <div class="topbar-left">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Free listings for students</span>
        </div>

        <div class="topbar-right">
            <span class="topbar-message">Buy · Sell · Exchange books</span>
            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/contact.php">Help</a>

            <span>|</span>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>profile.php#orders">Track Order</a>

            <span>|</span>

            <a href="?<?= http_build_query(array_merge($params, ['lang' => 'en'])) ?>">EN</a>

            <a href="?<?= http_build_query(array_merge($params, ['lang' => 'fr'])) ?>">FR</a>

            <a href="?<?= http_build_query(array_merge($params, ['lang' => 'ar'])) ?>">AR</a>
        </div>
    </div>
</section>
