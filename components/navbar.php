<?php

$currentPage = $currentPage ?? match (basename($_SERVER['SCRIPT_NAME'] ?? '')) {
    'index.php' => 'home',
    'books.php', 'book-details.php' => 'books',
    'category.php' => in_array($_GET['category'] ?? '', ['manga', 'school'], true)
        ? $_GET['category']
        : 'categories',
    default => '',
};
?>
<nav class="navbar" id="main-navigation">
    <div class="container">
        <ul class="nav-menu">
            <li>
                <a
                    href="<?= htmlspecialchars($basePath) ?>index.php"<?= $currentPage === 'home' ? ' class="active"' : '' ?>
                >
                    <?= __('navbar.home') ?>
                </a>
            </li>

            <li>
                <a
                    href="<?= htmlspecialchars($basePath) ?>pages/category.php"<?= $currentPage === 'categories' ? ' class="active"' : '' ?>
                >
                    <?= __('navbar.categories') ?>
                </a>
            </li>

            <li>
                <a
                    href="<?= htmlspecialchars($basePath) ?>pages/books.php"<?= $currentPage === 'books' ? ' class="active"' : '' ?>
                >
                    <?= __('navbar.books') ?>
                </a>
            </li>

            <li>
                <a href="<?= htmlspecialchars($basePath) ?>pages/books.php?sort=newest">
                    <?= __('navbar.newArrivals') ?>
                </a>
            </li>

            <li>
                <a href="<?= htmlspecialchars($basePath) ?>pages/books.php?sort=popular">
                    <?= __('navbar.bestSellers') ?>
                </a>
            </li>

            <li>
                <a
                    href="<?= htmlspecialchars($basePath) ?>pages/category.php?category=school"<?= $currentPage === 'school' ? ' class="active"' : '' ?>
                >
                    <?= __('navbar.schoolSupplies') ?>
                </a>
            </li>

            <li>
                <a
                    href="<?= htmlspecialchars($basePath) ?>pages/category.php?category=manga"<?= $currentPage === 'manga' ? ' class="active"' : '' ?>
                >
                    <?= __('navbar.manga') ?>
                </a>
            </li>
        </ul>
    </div>
</nav>
