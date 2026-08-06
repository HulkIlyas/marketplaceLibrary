<?php

$pageTitle = "Marketplace Library";

require_once 'components/header.php';
require_once 'components/topbar.php';
require_once 'components/logo-search.php';
require_once 'components/navbar.php';

?>

<main>

    <?php require_once 'components/hero.php'; ?>

    <?php require_once 'components/categories.php'; ?>
    <?php require_once 'components/featured-books.php'; ?>
    <?php require_once 'components/newsletter.php'; ?>


</main>

<?php

require_once 'components/footer.php';

?>