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
    <div class="auth-container">
        <nav class="auth-breadcrumb" aria-label="<?= __('auth.breadcrumbLabel') ?>">
            <a href="../index.php"><?= __('navbar.home') ?></a>
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
            <span aria-current="page"><?= __('auth.loginTitle') ?></span>
        </nav>

        <section class="auth-card" aria-labelledby="login-title">
            <header class="auth-header">
                <span class="auth-icon" aria-hidden="true"><i class="fa-regular fa-user"></i></span>
                <h1 id="login-title"><?= __('auth.loginTitle') ?></h1>
                <p><?= __('auth.loginSubtitle') ?></p>
            </header>

            <form class="auth-form" id="login-form" novalidate>
                <div class="form-group">
                    <label for="email"><?= __('auth.email') ?></label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                        <input type="email" id="email" name="email" autocomplete="email" required>
                    </div>
                    <span class="form-error" aria-live="polite"></span>
                </div>

                <div class="form-group">
                    <label for="password"><?= __('auth.password') ?></label>
                    <div class="input-wrapper password-wrapper">
                        <i class="fa-solid fa-lock" aria-hidden="true"></i>
                        <input type="password" id="password" name="password" autocomplete="current-password" required>
                        <button type="button" class="password-toggle" aria-label="<?= __('auth.showPassword') ?>" data-show-label="<?= __('auth.showPassword') ?>" data-hide-label="<?= __('auth.hidePassword') ?>">
                            <i class="fa-regular fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    <span class="form-error" aria-live="polite"></span>
                </div>

                <div class="auth-options">
                    <label class="checkbox-label"><input type="checkbox" name="remember"> <span><?= __('auth.rememberMe') ?></span></label>
                    <a href="#" data-ui-link><?= __('auth.forgotPassword') ?></a>
                </div>

                <button class="auth-submit" type="submit"><?= __('auth.loginButton') ?></button>
                <p class="form-status" id="login-status" aria-live="polite"></p>
            </form>

            <div class="auth-switch">
                <span><?= __('auth.noAccount') ?></span>
                <a href="register.php"><?= __('auth.createAccount') ?></a>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../components/footer.php'; ?>
<script src="../js/login.js"></script>
</body>
</html>
