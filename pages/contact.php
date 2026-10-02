<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = __('contact.pageTitle') . ' | Marketplace Library';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="inner-page">
    <div class="container contact-layout">
        <section>
            <span class="eyebrow"><?= __('contact.eyebrow') ?></span>
            <h1><?= __('contact.title') ?></h1>
            <p><?= __('contact.description') ?></p>
            <div class="contact-method">
                <i class="fa-regular fa-envelope"></i>
                <span>
                    <strong><?= __('contact.emailUs') ?></strong>
                    support@marketplace.com
                </span>
            </div>
            <div class="contact-method">
                <i class="fa-solid fa-location-dot"></i>
                <span>
                    <strong><?= __('contact.basedIn') ?></strong>
                    <?= __('footer.country') ?>
                </span>
            </div>
        </section>
        <form class="contact-form">
            <label>
                <?= __('contact.name') ?>
                <input type="text" required />
            </label>
            <label>
                <?= __('contact.email') ?>
                <input type="email" required />
            </label>
            <label>
                <?= __('contact.subject') ?>
                <input type="text" required />
            </label>
            <label>
                <?= __('contact.message') ?>
                <textarea rows="6" required></textarea>
            </label>
            <button class="btn btn-primary"><?= __('contact.send') ?></button>
        </form>
    </div>
</main>
<?php require __DIR__ . '/../components/footer.php'; ?>
