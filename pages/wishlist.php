<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = 'Wishlist | Marketplace Library';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="inner-page">
    <section class="page-hero compact">
        <div class="container">
            <span class="eyebrow">SAVED FOR LATER</span>
            <h1>Your wishlist</h1>
            <p>Books you love, all in one place.</p>
        </div>
    </section>
    <?php require __DIR__ . '/../components/featured-books.php'; ?>
</main>
<?php require __DIR__ . '/../components/footer.php'; ?>
