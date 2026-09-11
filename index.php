<?php
$pageTitle = 'Marketplace Library';
require_once 'includes/config.php';
require_once 'includes/translator.php';
require_once 'components/header.php';
require_once 'components/topbar.php';
require_once 'components/logo-search.php';
require_once 'components/navbar.php';
?>
<main>
    <?php require_once 'components/hero.php'; ?>
    <?php require_once 'components/categories.php'; ?>
    <?php require_once 'components/featured-books.php'; ?>
    <section class="recent-listings"><div class="container"><div class="section-header"><span class="eyebrow">FRESH FROM OUR READERS</span><h2>Recently added</h2><p>New stories arrive every day.</p></div><div class="recent-grid"><article><div class="mini-cover pattern-a"><span>THE<br>ALCHEMIST</span></div><div><small>Added 2h ago · Casablanca</small><h3>The Alchemist</h3><p>Paulo Coelho</p><strong>95 MAD</strong></div></article><article><div class="mini-cover pattern-b"><span>1984</span></div><div><small>Added 5h ago · Rabat</small><h3>Nineteen Eighty-Four</h3><p>George Orwell</p><strong>Exchange</strong></div></article><article><div class="mini-cover pattern-c"><span>LE<br>PETIT<br>PRINCE</span></div><div><small>Added yesterday · Agadir</small><h3>Le Petit Prince</h3><p>Antoine de Saint-Exupéry</p><strong>70 MAD</strong></div></article><article><div class="mini-cover pattern-d"><span>IKIGAI</span></div><div><small>Added yesterday · Marrakech</small><h3>Ikigai</h3><p>García & Miralles</p><strong>120 MAD</strong></div></article></div></div></section>
    <section class="editorial-feature"><div class="container"><div class="editorial-art"><img src="assets/images/editorial/second-hand-bookshop.webp" loading="lazy" width="1200" height="800" alt="A reader browsing shelves in a vintage bookshop"><span>SECOND-HAND<br>FIRST-CHOICE</span></div><div><span class="eyebrow">READ MORE. WASTE LESS.</span><h2>Every pre-loved book begins another chapter.</h2><p>Marketplace Library brings readers together to make good stories travel further—at better prices, close to home.</p><div class="editorial-stats"><span><strong>68%</strong> less waste</span><span><strong>12 cities</strong> connected</span></div><a class="btn btn-primary" href="pages/about.php">Discover our story <i class="fa-solid fa-arrow-right"></i></a></div></div></section>
    <section class="marketplace-steps"><div class="container"><div class="section-header"><span class="eyebrow">HOW IT WORKS</span><h2>Pass on the stories you love.</h2></div><div class="steps-grid"><article><b>01</b><i class="fa-solid fa-bag-shopping"></i><h3>Buy</h3><p>Find affordable books from readers near you.</p></article><article><b>02</b><i class="fa-solid fa-arrow-up-from-bracket"></i><h3>Sell</h3><p>Give the books you no longer need a new home.</p></article><article><b>03</b><i class="fa-solid fa-arrows-rotate"></i><h3>Exchange</h3><p>Trade your next read with the community.</p></article></div></div></section>
    <section class="benefits"><div class="container"><span><i class="fa-solid fa-leaf"></i> Sustainable reading</span><span><i class="fa-solid fa-location-dot"></i> Local community</span><span><i class="fa-solid fa-shield-heart"></i> Secure accounts</span><span><i class="fa-solid fa-tags"></i> Better prices</span></div></section>
    <?php require_once 'components/newsletter.php'; ?>
</main>
<?php require_once 'components/footer.php'; ?>
