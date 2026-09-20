<section class="categories section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?= __('categories.ShopByCategory') ?></h2>

            <p class="section-subtitle"><?= __('categories.subtitle') ?></p>
        </div>

        <div class="category-grid">
            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/category.php?category=books" class="category-card">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-book"></i>
                <h3><?= __('categories.books') ?></h3>
            </a>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/category.php?category=stationery" class="category-card">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-pencil"></i>
                <h3><?= __('categories.stationery') ?></h3>
            </a>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/category.php?category=digital" class="category-card">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-laptop"></i>
                <h3><?= __('categories.digital') ?></h3>
            </a>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/category.php?category=school" class="category-card">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-school"></i>
                <h3><?= __('categories.school') ?></h3>
            </a>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/category.php?category=art" class="category-card">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-palette"></i>
                <h3><?= __('categories.art') ?></h3>
            </a>

            <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/category.php?category=manga" class="category-card">
                <span class="category-arrow">→</span>
                <i class="fa-solid fa-book-open"></i>
                <h3><?= __('categories.manga') ?></h3>
            </a>
        </div>
    </div>
</section>
