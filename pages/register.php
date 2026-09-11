<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';
$basePath = '../';
$pageTitle = 'Create account | Marketplace Library';
$pageStylesheet = 'auth.css';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="auth-page">
    <aside class="auth-visual">
        <img src="../assets/images/editorial/second-hand-bookshop.webp" alt="A reader discovering pre-loved books" width="1200" height="800">
        <div class="auth-visual-copy"><span>JOIN THE COMMUNITY</span><h2>Give every book another story.</h2><p>Buy, sell and exchange with readers across Morocco.</p></div>
    </aside>
    <div class="auth-container">
        <nav class="auth-breadcrumb" aria-label="Breadcrumb"><a href="../index.php"><?= __('navbar.home') ?></a><i class="fa-solid fa-chevron-right"></i><span>Create account</span></nav>
        <section class="auth-card auth-card-wide" aria-labelledby="register-title">
            <header class="auth-header"><span class="auth-icon"><i class="fa-solid fa-user-plus"></i></span><h1 id="register-title">Create your account</h1><p>Join Marketplace Library today</p></header>
            <div id="alert-message" role="status" aria-live="polite"></div>
            <form class="auth-form" id="register-form" method="POST">
                <div class="form-group"><label for="name">Name</label><div class="input-wrapper"><i class="fa-regular fa-user"></i><input type="text" id="name" name="name" autocomplete="name" required></div></div>
                <div class="form-group"><label for="email">Email</label><div class="input-wrapper"><i class="fa-regular fa-envelope"></i><input type="email" id="email" name="email" autocomplete="email" required></div></div>
                <div class="form-group"><label for="password">Password</label><div class="input-wrapper password-wrapper"><i class="fa-solid fa-lock"></i><input type="password" id="password" name="password" autocomplete="new-password" required><button type="button" class="password-toggle" aria-label="Show password"><i class="fa-regular fa-eye"></i></button></div></div>
                <div class="form-group"><label for="confirm_password">Confirm Password</label><div class="input-wrapper password-wrapper"><i class="fa-solid fa-lock"></i><input type="password" id="confirm_password" name="confirm_password" autocomplete="new-password" required><button type="button" class="password-toggle" aria-label="Show password"><i class="fa-regular fa-eye"></i></button></div></div>
                <button type="submit" class="auth-submit">Create Account</button>
            </form>
            <div class="auth-switch"><span>Already have an account?</span><a href="login.php">Sign in</a></div>
        </section>
    </div>
</main>
<script src="../assets/js/api.js"></script>
<script src="../js/register.js"></script>
<?php require_once __DIR__ . '/../components/footer.php'; ?>
