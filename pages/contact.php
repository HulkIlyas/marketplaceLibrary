<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = 'Contact | Marketplace Library';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="inner-page">
    <div class="container contact-layout">
        <section>
            <span class="eyebrow">LET'S TALK BOOKS</span>
            <h1>How can we help?</h1>
            <p>Questions about buying, selling or exchanging? Our team would love to hear from you.</p>
            <div class="contact-method">
                <i class="fa-regular fa-envelope"></i>
                <span>
                    <strong>Email us</strong>
                    support@marketplace.com
                </span>
            </div>
            <div class="contact-method">
                <i class="fa-solid fa-location-dot"></i>
                <span>
                    <strong>Based in</strong>
                    Morocco
                </span>
            </div>
        </section>
        <form class="contact-form">
            <label>
                Name
                <input type="text" required />
            </label>
            <label>
                Email
                <input type="email" required />
            </label>
            <label>
                Subject
                <input type="text" required />
            </label>
            <label>
                Message
                <textarea rows="6" required></textarea>
            </label>
            <button class="btn btn-primary">Send message</button>
        </form>
    </div>
</main>
<?php require __DIR__ . '/../components/footer.php'; ?>
