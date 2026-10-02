<section class="newsletter">
    <div class="container">
        <div class="newsletter-content">
            <h2><?= __('newsletter.title') ?></h2>

            <p><?= __('newsletter.description') ?></p>

            <form class="newsletter-form" data-ui-newsletter>
                <input type="email" placeholder="<?= htmlspecialchars(__('newsletter.emailPlaceholder')) ?>" required />

                <button type="submit" data-subscribed-label="<?= htmlspecialchars(__('newsletter.subscribed')) ?>"><?= __('newsletter.subscribe') ?></button>
            </form>
        </div>
    </div>
</section>
