<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = __('auth.loginTitle') . ' | Marketplace Library';
$pageStylesheet = 'auth.css';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="auth-page">
    <aside class="auth-visual">
        <img
            src="../assets/images/editorial/second-hand-bookshop.webp"
            alt="A reader discovering pre-loved books"
            width="1200"
            height="800"
        />
        <div class="auth-visual-copy">
            <span>WELCOME BACK</span>
            <h2>Your next chapter is waiting.</h2>
            <p>Return to your shelf, listings, and reader community.</p>
        </div>
    </aside>
    <div class="auth-container">
        <nav class="auth-breadcrumb" aria-label="<?= __('auth.breadcrumbLabel') ?>">
            <a href="../index.php"><?= __('navbar.home') ?></a>
            <i class="fa-solid fa-chevron-right"></i>
            <span><?= __('auth.loginTitle') ?></span>
        </nav>
        <section class="auth-card" aria-labelledby="login-title">
            <header class="auth-header">
                <span class="auth-icon"><i class="fa-regular fa-user"></i></span>
                <h1 id="login-title"><?= __('auth.loginTitle') ?></h1>
                <p><?= __('auth.loginSubtitle') ?></p>
            </header>
            <div id="alert-message" class="form-status" role="status" aria-live="polite"></div>
            <form class="auth-form" id="login-form" method="POST">
                <div class="form-group">
                    <label for="email"><?= __('auth.email') ?></label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="email" name="email" autocomplete="email" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password"><?= __('auth.password') ?></label>
                    <div class="input-wrapper password-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                            required
                        />
                        <button
                            type="button"
                            class="password-toggle"
                            aria-label="<?= __('auth.showPassword') ?>"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="auth-options">
                    <label class="checkbox-label">
                        <input type="checkbox" id="remember" />
                        <span><?= __('auth.rememberMe') ?></span>
                    </label>
                    <a href="../pages/contact.php"><?= __('auth.forgotPassword') ?></a>
                </div>
                <button class="auth-submit" type="submit"><?= __('auth.loginButton') ?></button>
            </form>
            <div class="auth-switch">
                <span><?= __('auth.noAccount') ?></span>
                <a href="register.php"><?= __('auth.createAccount') ?></a>
            </div>
        </section>
    </div>
</main>
<script src="../assets/js/api.js"></script>
<script src="../js/login.js"></script>
<?php require_once __DIR__ . '/../components/footer.php'; ?>
