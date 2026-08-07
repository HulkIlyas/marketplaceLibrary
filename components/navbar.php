<nav class="navbar">

    <div class="container">

        <ul class="nav-menu">

            <li><a href="<?= htmlspecialchars($basePath) ?>index.php"<?= ($currentPage ?? '') === 'home' ? ' class="active"' : '' ?>><?= __('navbar.home') ?></a></li>

            <li><a href="<?= htmlspecialchars($basePath) ?>pages/category.php"<?= ($currentPage ?? '') === 'categories' ? ' class="active"' : '' ?>><?= __('navbar.categories') ?></a></li>

            <li><a href="#"><?= __('navbar.books') ?></a></li>

            <li><a href="#"><?= __('navbar.newArrivals') ?></a></li>

            <li><a href="#"><?= __('navbar.bestSellers') ?></a></li>

            <li><a href="#"><?= __('navbar.schoolSupplies') ?></a></li>

            <li><a href="#"><?= __('navbar.manga') ?></a></li>

        </ul>

    </div>
</nav>
