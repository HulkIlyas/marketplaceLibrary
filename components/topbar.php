<?php
$params = $_GET;
?>
<section class="topbar">

    <div class="container topbar-container">

        <div class="topbar-left">

            <i class="fa-solid fa-phone"></i>
            <span>+212 600 000 000</span>

        </div>

        <div class="topbar-right">

            <a href="#">Help</a>

            <span>|</span>

            <a href="#">Track Order</a>

            <span>|</span>

            <a href="?<?= http_build_query(array_merge($params, ['lang' => 'en'])) ?>">EN</a>

            <a href="?<?= http_build_query(array_merge($params, ['lang' => 'fr'])) ?>">FR</a>

            <a href="?<?= http_build_query(array_merge($params, ['lang' => 'ar'])) ?>">AR</a>

        </div>

    </div>

</section>