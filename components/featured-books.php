<section class="featured-books">
    <div class="container">
        <div class="section-title">
            <h2><?= __('featuredBooks.title') ?></h2>
            <p><?= __('featuredBooks.subtitle') ?></p>
            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/books.php" class="view-all"><?= __('featuredBooks.viewAll') ?></a>
        </div>

        <div class="book-grid" id="booksGrid">
            <div class="book-card">
                <div class="cover cover-one">
                    ATOMIC
                    <br />
                    HABITS
                </div>
                <span class="listing-badge buy"><?= __('featuredBooks.buy') ?></span>

                <div class="book-info">
                    <h3>Atomic Habits</h3>

                    <p class="author">James Clear · <?= __('featuredBooks.veryGood') ?></p>

                    <div class="price">180 MAD</div>

                    <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/book-details.php" class="btn-cart">
                        <?= __('featuredBooks.viewDetails') ?>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="book-card">
                <div class="cover cover-two">
                    THE
                    <br />
                    PSYCHOLOGY
                    <br />
                    OF MONEY
                </div>
                <span class="listing-badge sell"><?= __('featuredBooks.sell') ?></span>

                <div class="book-info">
                    <h3>The Psychology of Money</h3>

                    <p class="author">Morgan Housel · <?= __('featuredBooks.likeNew') ?></p>

                    <div class="price">150 MAD</div>

                    <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/book-details.php" class="btn-cart">
                        <?= __('featuredBooks.viewDetails') ?>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="book-card">
                <div class="cover cover-three">
                    CLEAN
                    <br />
                    CODE
                </div>
                <span class="listing-badge exchange"><?= __('featuredBooks.exchange') ?></span>

                <div class="book-info">
                    <h3>Clean Code</h3>

                    <p class="author">Robert C. Martin · <?= __('featuredBooks.good') ?></p>

                    <div class="price">210 MAD</div>

                    <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/book-details.php" class="btn-cart">
                        <?= __('featuredBooks.tradeOnly') ?>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="book-card">
                <div class="cover cover-four">
                    DEEP
                    <br />
                    WORK
                </div>
                <span class="listing-badge buy"><?= __('featuredBooks.buy') ?></span>

                <div class="book-info">
                    <h3>Deep Work</h3>

                    <p class="author">Cal Newport · <?= __('featuredBooks.veryGood') ?></p>

                    <div class="price">170 MAD</div>

                    <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/book-details.php" class="btn-cart">
                        <?= __('featuredBooks.viewDetails') ?>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
