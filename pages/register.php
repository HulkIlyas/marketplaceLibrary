<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = __('auth.createAccount') . ' | Marketplace Library';
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
            alt="<?= htmlspecialchars(__('auth.registerImageAlt')) ?>"
            width="1200"
            height="800"
        />
        <div class="auth-visual-copy">
            <span><?= __('auth.registerEyebrow') ?></span>
            <h2><?= __('auth.registerHeroTitle') ?></h2>
            <p><?= __('auth.registerHeroDescription') ?></p>
        </div>
    </aside>
    <div class="auth-container">
        <nav class="auth-breadcrumb" aria-label="<?= htmlspecialchars(__('auth.breadcrumbLabel')) ?>">
            <a href="../index.php"><?= __('navbar.home') ?></a>
            <i class="fa-solid fa-chevron-right"></i>
            <span><?= __('auth.createAccount') ?></span>
        </nav>
        <section class="auth-card" aria-labelledby="register-title">
            <header class="auth-header">
                <span class="auth-icon"><i class="fa-solid fa-user-plus"></i></span>
                <h1 id="register-title"><?= __('auth.createYourAccount') ?></h1>
                <p><?= __('auth.registerSubtitle') ?></p>
            </header>
            <div id="alert-message" class="form-status" role="status" aria-live="polite"></div>
            <form
                class="auth-form"
                id="register-form"
                method="POST"
                novalidate
                data-name-required="<?= htmlspecialchars(__('auth.nameRequired')) ?>"
                data-email-invalid="<?= htmlspecialchars(__('auth.invalidEmail')) ?>"
                data-password-required="<?= htmlspecialchars(__('auth.passwordRequired')) ?>"
                data-password-min-length="<?= htmlspecialchars(__('auth.passwordMinLength')) ?>"
                data-passwords-mismatch="<?= htmlspecialchars(__('auth.passwordsDoNotMatch')) ?>"
                data-success="<?= htmlspecialchars(__('auth.accountCreated')) ?>"
                data-failure="<?= htmlspecialchars(__('auth.unableToCreateAccount')) ?>"
                data-creating="<?= htmlspecialchars(__('auth.creatingAccount')) ?>"
            >
                <div class="form-group">
                    <label for="name"><?= __('auth.fullName') ?></label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" id="name" name="name" autocomplete="name" required />
                    </div>
                </div>
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
                            autocomplete="new-password"
                            minlength="6"
                            required
                        />
                        <button
                            type="button"
                            class="password-toggle"
                            aria-label="<?= htmlspecialchars(__('auth.showPassword')) ?>"
                            data-show-label="<?= htmlspecialchars(__('auth.showPassword')) ?>"
                            data-hide-label="<?= htmlspecialchars(__('auth.hidePassword')) ?>"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password"><?= __('auth.confirmPassword') ?></label>
                    <div class="input-wrapper password-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input
                            type="password"
                            id="confirm_password"
                            name="confirm_password"
                            autocomplete="new-password"
                            minlength="6"
                            required
                        />
                        <button
                            type="button"
                            class="password-toggle"
                            aria-label="<?= htmlspecialchars(__('auth.showPassword')) ?>"
                            data-show-label="<?= htmlspecialchars(__('auth.showPassword')) ?>"
                            data-hide-label="<?= htmlspecialchars(__('auth.hidePassword')) ?>"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>
                <button class="auth-submit" type="submit"><?= __('auth.createAccount') ?></button>
            </form>
            <div class="auth-switch">
                <span><?= __('auth.alreadyHaveAccount') ?></span>
                <a href="login.php"><?= __('auth.signIn') ?></a>
            </div>
        </section>
    </div>
</main>
<script src="../js/register.js"></script>
<?php require_once __DIR__ . '/../components/footer.php'; ?>
