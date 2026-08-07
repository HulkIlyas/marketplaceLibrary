<footer class="footer">

    <div class="container">

        <div class="footer-grid">

            <!-- Company -->
            <div class="footer-column">

                <h3><?= __('footer.companyName') ?></h3>

                <p>
                    <?= __('footer.companyDescription') ?>
                </p>

                <div class="social-links">

                    <a href="#"><i class="fab fa-facebook-f"></i></a>

                    <a href="#"><i class="fab fa-instagram"></i></a>

                    <a href="#"><i class="fab fa-linkedin-in"></i></a>

                    <a href="#"><i class="fab fa-x-twitter"></i></a>

                </div>

            </div>

            <!-- Quick Links -->
            <div class="footer-column">

                <h4><?= __('footer.quickLinks') ?></h4>

                <ul>

                    <li><a href="<?= htmlspecialchars($basePath) ?>index.php"><?= __('navbar.home') ?></a></li>

                    <li><a href="<?= htmlspecialchars($basePath) ?>pages/books.php"><?= __('navbar.books') ?></a></li>

                    <li><a href="<?= htmlspecialchars($basePath) ?>pages/category.php"><?= __('navbar.categories') ?></a></li>

                    <li><a href="<?= htmlspecialchars($basePath) ?>pages/contact.php"><?= __('navbar.contact') ?></a></li>

                </ul>

            </div>

            <!-- Customer -->
            <div class="footer-column">

                <h4><?= __('footer.customer') ?></h4>

                <ul>

                    <li><a href="#"><?= __('footer.myAccount') ?></a></li>

                    <li><a href="#"><?= __('footer.wishlist') ?></a></li>

                    <li><a href="#"><?= __('footer.cart') ?></a></li>

                    <li><a href="#"><?= __('footer.orders') ?></a></li>

                </ul>

            </div>

            <!-- Contact -->
            <div class="footer-column">

                <h4><?= __('footer.contact') ?></h4>

                <ul>

                    <li><?= __('footer.email') ?>: support@marketplace.com</li>

                    <li><?= __('footer.phone') ?>: +212 600 000 000</li>

                    <li><?= __('footer.country') ?></li>

                </ul>

            </div>

        </div>

        <div class="footer-bottom">

            <p><?= __('footer.copyright') ?></p>

        </div>

    </div>

</footer>
