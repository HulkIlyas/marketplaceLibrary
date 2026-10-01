<section class="categories section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?= __('categories.ShopByCategory') ?></h2>

            <p class="section-subtitle"><?= __('categories.subtitle') ?></p>
        </div>

        <div
            class="category-grid"
            id="categoryGrid"
            data-base-path="<?= htmlspecialchars($basePath ?? '') ?>"
            data-listing-singular="<?= htmlspecialchars(__('categories.listing')) ?>"
            data-listing-plural="<?= htmlspecialchars(__('categories.listings')) ?>"
            data-no-categories="<?= htmlspecialchars(__('categories.noCategories')) ?>"
            data-load-failed="<?= htmlspecialchars(__('categories.loadFailed')) ?>"
            data-load-error="<?= htmlspecialchars(__('categories.loadError')) ?>"
        >
            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/books.php?category=books" class="category-card" data-category-slug="books">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-book"></i>
                <h3><?= __('categories.books') ?></h3>
            </a>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/books.php?category=stationery" class="category-card" data-category-slug="stationery">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-pencil"></i>
                <h3><?= __('categories.stationery') ?></h3>
            </a>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/books.php?category=digital" class="category-card" data-category-slug="digital">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-laptop"></i>
                <h3><?= __('categories.digital') ?></h3>
            </a>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/books.php?category=school" class="category-card" data-category-slug="school">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-school"></i>
                <h3><?= __('categories.school') ?></h3>
            </a>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/books.php?category=art" class="category-card" data-category-slug="art">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-palette"></i>
                <h3><?= __('categories.art') ?></h3>
            </a>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/books.php?category=manga" class="category-card" data-category-slug="manga">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-book-open"></i>
                <h3><?= __('categories.manga') ?></h3>
            </a>
        </div>
    </div>
</section>
