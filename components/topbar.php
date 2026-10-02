<?php

$params = $_GET;
?>
<section class="topbar">
    <div class="container topbar-container">
        <div class="topbar-left">
            <i class="fa-solid fa-graduation-cap"></i>
            <span><?= __('topbar.studentListings') ?></span>
        </div>

        <div class="topbar-right">
            <span class="topbar-message"><?= __('topbar.marketplaceMessage') ?></span>
            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/contact.php"><?= __('topbar.help') ?></a>

            <span>|</span>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>profile.php#orders"><?= __('topbar.trackOrder') ?></a>

            <span>|</span>

            <a href="?<?= http_build_query(array_merge($params, ['lang' => 'en'])) ?>">EN</a>

            <a href="?<?= http_build_query(array_merge($params, ['lang' => 'fr'])) ?>">FR</a>

            <a href="?<?= http_build_query(array_merge($params, ['lang' => 'ar'])) ?>">AR</a>
        </div>
    </div>
</section>
