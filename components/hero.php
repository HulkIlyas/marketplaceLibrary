<section class="hero">
    <div class="container hero-container">
        <div class="hero-content">
            <span class="hero-subtitle"><?= __('home.heroEyebrow') ?></span>

            <h1>
                <?= __('home.heroTitle') ?>
                <span><?= __('home.heroHighlight') ?></span>
            </h1>

            <p><?= __('home.heroDescription') ?></p>

            <div class="hero-buttons">
                <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/books.php" class="btn btn-primary">
                    <?= __('home.exploreBooks') ?>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

                <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/create-listing.php" class="btn btn-secondary"><?= __('home.sellYourBooks') ?></a>
            </div>
        </div>

        <div class="hero-image">
            <img
                class="hero-photo"
                src="<?= htmlspecialchars($basePath ?? '') ?>assets/images/hero/hero-reading-room.webp"
                alt="<?= htmlspecialchars(__('home.heroImageAlt')) ?>"
                width="1400"
                height="933"
                fetchpriority="high"
            />
            <div class="hero-market-badge">
                <i class="fa-solid fa-arrows-rotate"></i>
                <?= __('home.buySellExchange') ?>
            </div>
            <div class="hero-note">
                <i class="fa-solid fa-heart"></i>
                <strong>10k+</strong>
                <small><?= __('home.booksWaiting') ?></small>
            </div>
        </div>

        <div class="hero-proof">
            <span>
                <strong>10k+</strong>
                <?= __('home.listings') ?>
            </span>
            <span>
                <strong>500+</strong>
                <?= __('home.readers') ?>
            </span>
            <span>
                <strong><?= __('home.threeWays') ?></strong>
                <?= __('home.toDiscover') ?>
            </span>
        </div>
    </div>
</section>
