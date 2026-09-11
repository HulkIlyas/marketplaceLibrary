<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = 'About | Marketplace Library';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="inner-page">
    <section class="story-hero">
        <div class="container">
            <div>
                <span class="eyebrow">OUR STORY</span>
                <h1>Good books deserve more than one reader.</h1>
                <p>
                    We are building a local marketplace where books remain affordable, useful and loved for longer.
                </p>
            </div>
            <img
                src="../assets/images/editorial/second-hand-bookshop.webp"
                alt="Reader browsing a second-hand bookshop"
                width="1200"
                height="800"
            />
        </div>
    </section>
    <section class="values container">
        <article>
            <i class="fa-solid fa-leaf"></i>
            <h2>More sustainable</h2>
            <p>Every reused book saves resources and keeps stories in circulation.</p>
        </article>
        <article>
            <i class="fa-solid fa-people-group"></i>
            <h2>Built for community</h2>
            <p>Buy, sell and exchange directly with readers around Morocco.</p>
        </article>
        <article>
            <i class="fa-solid fa-wallet"></i>
            <h2>More affordable</h2>
            <p>Access more knowledge without paying new-book prices.</p>
        </article>
    </section>
</main>
<?php require __DIR__ . '/../components/footer.php'; ?>
