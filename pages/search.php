<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';
$basePath = '../';
$pageTitle = __('search.pageTitle') . ' | Marketplace Library';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
$query = trim((string) ($_GET['q'] ?? ''));
?>
<main class="inner-page" id="search-page" data-query="<?= htmlspecialchars($query, ENT_QUOTES, 'UTF-8') ?>" data-translations="<?= htmlspecialchars(json_encode(array_merge($translations['search'], $translations['catalog']), JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?>">
    <section class="page-hero compact"><div class="container">
        <span class="eyebrow"><?= __('search.eyebrow') ?></span>
        <h1><?= $query === '' ? __('search.enterTerm') : htmlspecialchars(sprintf(__('search.resultsFor'), $query), ENT_QUOTES, 'UTF-8') ?></h1>
        <p><?= __('search.description') ?></p>
    </div></section>
    <section class="featured-books"><div class="container">
        <p id="search-count" aria-live="polite"></p>
        <div class="book-grid" id="search-results"></div>
        <nav class="pagination" id="search-pagination" aria-label="<?= htmlspecialchars(__('search.paginationLabel')) ?>"></nav>
    </div></section>
</main>
<script src="../assets/js/search.js" defer></script>
<?php require __DIR__ . '/../components/footer.php'; ?>
