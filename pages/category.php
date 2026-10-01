<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = __('categories.pageTitle') . ' | Marketplace Library';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="inner-page">
    <section class="page-hero">
        <div class="container">
            <span class="eyebrow"><?= __('categories.heroEyebrow') ?></span>
            <h1><?= __('categories.browseTitle') ?></h1>
            <p><?= __('categories.browseDescription') ?></p>
        </div>
    </section>
    <?php require __DIR__ . '/../components/categories.php'; ?>
    <section class="category-feature">
        <div class="container">
            <div>
                <span class="eyebrow"><?= __('categories.featureEyebrow') ?></span>
                <h2><?= __('categories.featureTitle') ?></h2>
                <p><?= __('categories.featureDescription') ?></p>
                <a class="btn btn-primary" href="books.php?category=manga"><?= __('categories.exploreManga') ?></a>
            </div>
            <div class="category-books" aria-hidden="true">
                <span>01</span>
                <span>マンガ</span>
                <span>STORIES</span>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__ . '/../components/footer.php'; ?>
