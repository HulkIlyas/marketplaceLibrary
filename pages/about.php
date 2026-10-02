<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = __('about.pageTitle') . ' | Marketplace Library';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="inner-page">
    <section class="story-hero">
        <div class="container">
            <div>
                <span class="eyebrow"><?= __('about.eyebrow') ?></span>
                <h1><?= __('about.title') ?></h1>
                <p><?= __('about.description') ?></p>
            </div>
            <img
                src="../assets/images/editorial/second-hand-bookshop.webp"
                alt="<?= htmlspecialchars(__('about.imageAlt')) ?>"
                width="1200"
                height="800"
            />
        </div>
    </section>
    <section class="values container">
        <article>
            <i class="fa-solid fa-leaf"></i>
            <h2><?= __('about.sustainableTitle') ?></h2>
            <p><?= __('about.sustainableDescription') ?></p>
        </article>
        <article>
            <i class="fa-solid fa-people-group"></i>
            <h2><?= __('about.communityTitle') ?></h2>
            <p><?= __('about.communityDescription') ?></p>
        </article>
        <article>
            <i class="fa-solid fa-wallet"></i>
            <h2><?= __('about.affordableTitle') ?></h2>
            <p><?= __('about.affordableDescription') ?></p>
        </article>
    </section>
</main>
<?php require __DIR__ . '/../components/footer.php'; ?>
