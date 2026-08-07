<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = __('auth.registerTitle') . ' | Marketplace Library';
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
            <span aria-current="page"><?= __('auth.registerTitle') ?></span>
        </nav>

        <section class="auth-card auth-card-wide" aria-labelledby="register-title">
            <header class="auth-header">
                <span class="auth-icon" aria-hidden="true"><i class="fa-solid fa-user-plus"></i></span>
                <h1 id="register-title"><?= __('auth.registerTitle') ?></h1>
                <p><?= __('auth.registerSubtitle') ?></p>
            </header>

            <form class="auth-form" id="register-form" novalidate>
                <div class="auth-name-grid">
                    <div class="form-group">
                        <label for="first-name"><?= __('auth.firstName') ?></label>
                        <div class="input-wrapper"><i class="fa-regular fa-user" aria-hidden="true"></i><input type="text" id="first-name" name="first_name" autocomplete="given-name" required></div>
                        <span class="form-error" aria-live="polite"></span>
                    </div>
                    <div class="form-group">
                        <label for="last-name"><?= __('auth.lastName') ?></label>
                        <div class="input-wrapper"><i class="fa-regular fa-user" aria-hidden="true"></i><input type="text" id="last-name" name="last_name" autocomplete="family-name" required></div>
                        <span class="form-error" aria-live="polite"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email"><?= __('auth.email') ?></label>
                    <div class="input-wrapper"><i class="fa-regular fa-envelope" aria-hidden="true"></i><input type="email" id="email" name="email" autocomplete="email" required></div>
                    <span class="form-error" aria-live="polite"></span>
                </div>

                <div class="form-group">
                    <label for="password"><?= __('auth.password') ?></label>
                    <div class="input-wrapper password-wrapper"><i class="fa-solid fa-lock" aria-hidden="true"></i><input type="password" id="password" name="password" autocomplete="new-password" minlength="8" required><button type="button" class="password-toggle" aria-label="<?= __('auth.showPassword') ?>" data-show-label="<?= __('auth.showPassword') ?>" data-hide-label="<?= __('auth.hidePassword') ?>"><i class="fa-regular fa-eye" aria-hidden="true"></i></button></div>
                    <span class="form-error" aria-live="polite"></span>
                </div>

                <div class="form-group">
                    <label for="confirm-password"><?= __('auth.confirmPassword') ?></label>
                    <div class="input-wrapper password-wrapper"><i class="fa-solid fa-lock" aria-hidden="true"></i><input type="password" id="confirm-password" name="confirm_password" autocomplete="new-password" required><button type="button" class="password-toggle" aria-label="<?= __('auth.showPassword') ?>" data-show-label="<?= __('auth.showPassword') ?>" data-hide-label="<?= __('auth.hidePassword') ?>"><i class="fa-regular fa-eye" aria-hidden="true"></i></button></div>
                    <span class="form-error" aria-live="polite" data-confirm-error="<?= __('auth.passwordMismatch') ?>"></span>
                </div>

                <div class="form-group terms-group">
                    <label class="checkbox-label"><input type="checkbox" id="terms" name="terms" required> <span><?= __('auth.acceptTerms') ?></span></label>
                    <span class="form-error" aria-live="polite"></span>
                </div>

                <button class="auth-submit" type="submit"><?= __('auth.registerButton') ?></button>
                <p class="form-status" id="register-status" aria-live="polite"></p>
            </form>

            <div class="auth-switch"><span><?= __('auth.hasAccount') ?></span> <a href="login.php"><?= __('auth.loginLink') ?></a></div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../components/footer.php'; ?>
<script src="../js/register.js"></script>
</body>
</html>
