<?php

$currentPage = $currentPage ?? match (basename($_SERVER['SCRIPT_NAME'] ?? '')) {
    'index.php' => 'home',
    'books.php', 'book-details.php' => 'books',
    'category.php' => 'categories',
    'about.php' => 'about',
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
                <a
                    href="<?= htmlspecialchars($basePath) ?>pages/about.php"<?= $currentPage === 'about' ? ' class="active"' : '' ?>
                >
                    <?= __('navbar.about') ?>
                </a>
            </li>

        </ul>
    </div>
</nav>
