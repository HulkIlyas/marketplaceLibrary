<?php

$pageTitle = 'Marketplace Library';

require_once 'includes/config.php';
require_once 'includes/translator.php';

require_once 'components/header.php';
require_once 'components/topbar.php';
require_once 'components/logo-search.php';
require_once 'components/navbar.php';
?>
<main>
    <?php require_once 'components/hero.php'; ?>
    <?php require_once 'components/categories.php'; ?>
    <?php require_once 'components/featured-books.php'; ?>
    <section class="recent-listings">
        <div class="container">
            <div class="section-header">
                <span class="eyebrow"><?= __('home.recentEyebrow') ?></span>
                <h2><?= __('home.recentTitle') ?></h2>
                <p><?= __('home.recentDescription') ?></p>
            </div>
            <div class="recent-grid">
                <article>
                    <div class="mini-cover pattern-a">
                        <span>
                            THE
                            <br />
                            ALCHEMIST
                        </span>
                    </div>
                    <div>
                        <small><?= __('home.added2h') ?> · Casablanca</small>
                        <h3>The Alchemist</h3>
                        <p>Paulo Coelho</p>
                        <strong>95 MAD</strong>
                    </div>
                </article>
                <article>
                    <div class="mini-cover pattern-b"><span>1984</span></div>
                    <div>
                        <small><?= __('home.added5h') ?> · Rabat</small>
                        <h3>Nineteen Eighty-Four</h3>
                        <p>George Orwell</p>
                        <strong><?= __('home.exchange') ?></strong>
                    </div>
                </article>
                <article>
                    <div class="mini-cover pattern-c">
                        <span>
                            LE
                            <br />
                            PETIT
                            <br />
                            PRINCE
                        </span>
                    </div>
                    <div>
                        <small><?= __('home.addedYesterday') ?> · Agadir</small>
                        <h3>Le Petit Prince</h3>
                        <p>Antoine de Saint-Exupéry</p>
                        <strong>70 MAD</strong>
                    </div>
                </article>
                <article>
                    <div class="mini-cover pattern-d"><span>IKIGAI</span></div>
                    <div>
                        <small><?= __('home.addedYesterday') ?> · Marrakech</small>
                        <h3>Ikigai</h3>
                        <p>García & Miralles</p>
                        <strong>120 MAD</strong>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <section class="editorial-feature">
        <div class="container">
            <div class="editorial-art">
                <img
                    src="assets/images/editorial/second-hand-bookshop.webp"
                    loading="lazy"
                    width="1200"
                    height="800"
                    alt="<?= htmlspecialchars(__('home.editorialImageAlt')) ?>"
                />
                <span>
                    <?= __('home.secondHand') ?>
                    <br />
                    <?= __('home.firstChoice') ?>
                </span>
            </div>
            <div>
                <span class="eyebrow"><?= __('home.editorialEyebrow') ?></span>
                <h2><?= __('home.editorialTitle') ?></h2>
                <p><?= __('home.editorialDescription') ?></p>
                <div class="editorial-stats">
                    <span>
                        <strong>68%</strong>
                        <?= __('home.lessWaste') ?>
                    </span>
                    <span>
                        <strong><?= __('home.twelveCities') ?></strong>
                        <?= __('home.connected') ?>
                    </span>
                </div>
                <a class="btn btn-primary" href="pages/about.php">
                    <?= __('home.discoverStory') ?>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
    <section class="marketplace-steps">
        <div class="container">
            <div class="section-header">
                <span class="eyebrow"><?= __('home.stepsEyebrow') ?></span>
                <h2><?= __('home.stepsTitle') ?></h2>
            </div>
            <div class="steps-grid">
                <article>
                    <b>01</b>
                    <i class="fa-solid fa-bag-shopping"></i>
                    <h3><?= __('home.buy') ?></h3>
                    <p><?= __('home.buyDescription') ?></p>
                </article>
                <article>
                    <b>02</b>
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    <h3><?= __('home.sell') ?></h3>
                    <p><?= __('home.sellDescription') ?></p>
                </article>
                <article>
                    <b>03</b>
                    <i class="fa-solid fa-arrows-rotate"></i>
                    <h3><?= __('home.exchange') ?></h3>
                    <p><?= __('home.exchangeDescription') ?></p>
                </article>
            </div>
        </div>
    </section>
    <section class="benefits">
        <div class="container">
            <span>
                <i class="fa-solid fa-leaf"></i>
                <?= __('home.sustainableReading') ?>
            </span>
            <span>
                <i class="fa-solid fa-location-dot"></i>
                <?= __('home.localCommunity') ?>
            </span>
            <span>
                <i class="fa-solid fa-shield-heart"></i>
                <?= __('home.secureAccounts') ?>
            </span>
            <span>
                <i class="fa-solid fa-tags"></i>
                <?= __('home.betterPrices') ?>
            </span>
        </div>
    </section>
    <?php require_once 'components/newsletter.php'; ?>
</main>
<?php require_once 'components/footer.php'; ?>
