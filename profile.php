<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/translator.php';

$basePath = '';
$pageTitle = __('account.pageTitle') . ' | Marketplace Library';
$pageStylesheet = 'account.css';

require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/topbar.php';
require_once __DIR__ . '/components/logo-search.php';
require_once __DIR__ . '/components/navbar.php';
?>

<script>
    if (!Auth.isAuthenticated()) {
        window.location.replace("pages/login.php");
    }
</script>

<main class="account-page" data-listing-translations="<?= htmlspecialchars(json_encode(array_merge($translations['myListings'], $translations['account']), JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?>">
    <section class="account-hero">
        <div class="container account-hero-inner">
            <div class="account-identity">
                <span class="account-avatar" id="account-avatar" aria-hidden="true">—</span>
                <div>
                    <span class="eyebrow"><?= __('account.brandEyebrow') ?></span>
                    <h1><?= __('account.pageTitle') ?></h1>
                    <p class="account-name" id="account-name"><?= __('account.loading') ?></p>
                    <p class="account-email" id="account-email"></p>
                    <span class="member-badge">
                        <i class="fa-solid fa-circle-check"></i>
                        <?= __('account.active') ?>
                    </span>
                </div>
            </div>
            <div class="account-actions">
                <button class="btn btn-secondary" type="button" data-account-tab="settings">
                    <i class="fa-regular fa-pen-to-square"></i>
                    <?= __('account.editProfile') ?>
                </button>
                <button class="btn btn-primary" id="logout-button" type="button">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <?= __('header.logout') ?>
                </button>
            </div>
        </div>
    </section>

    <div class="container account-layout">
        <aside class="account-sidebar" aria-label="<?= htmlspecialchars(__('account.navigation')) ?>">
            <div class="account-sidebar-heading">
                <span class="account-avatar account-avatar-small" id="sidebar-avatar" aria-hidden="true">—</span>
                <div>
                    <strong id="sidebar-name"><?= __('account.pageTitle') ?></strong>
                    <small><?= __('account.readerAccount') ?></small>
                </div>
            </div>
            <nav class="account-tabs" role="tablist" aria-label="<?= htmlspecialchars(__('account.sections')) ?>">
                <button
                    class="account-tab is-active"
                    type="button"
                    role="tab"
                    aria-selected="true"
                    aria-controls="panel-overview"
                    data-tab="overview"
                >
                    <i class="fa-solid fa-table-columns"></i>
                    <span><?= __('account.overview') ?></span>
                </button>
                <button
                    class="account-tab"
                    type="button"
                    role="tab"
                    aria-selected="false"
                    aria-controls="panel-listings"
                    data-tab="listings"
                >
                    <i class="fa-solid fa-book"></i>
                    <span><?= __('myListings.title') ?></span>
                </button>
                <button
                    class="account-tab"
                    type="button"
                    role="tab"
                    aria-selected="false"
                    aria-controls="panel-wishlist"
                    data-tab="wishlist"
                >
                    <i class="fa-regular fa-heart"></i>
                    <span><?= __('wishlist.pageTitle') ?></span>
                </button>
                <button
                    class="account-tab"
                    type="button"
                    role="tab"
                    aria-selected="false"
                    aria-controls="panel-orders"
                    data-tab="orders"
                >
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span><?= __('commerce.myOrders') ?></span>
                </button>
                <button
                    class="account-tab"
                    type="button"
                    role="tab"
                    aria-selected="false"
                    aria-controls="panel-sales"
                    data-tab="sales"
                    aria-label="<?= __('commerce.sales') ?>"
                >
                    <i class="fa-solid fa-store"></i>
                    <span><?= __('commerce.sales') ?></span>
                </button>
                <button class="account-tab" type="button" role="tab" aria-selected="false" aria-controls="panel-settings"
                    data-tab="settings"
                >
                    <i class="fa-solid fa-gear"></i>
                    <span><?= __('account.settings') ?></span>
                </button>
            </nav>
        </aside>

        <div class="account-content">
            <section class="account-panel is-active" id="panel-overview" role="tabpanel" data-panel="overview">
                <div class="panel-heading">
                    <div>
                        <span class="eyebrow"><?= __('account.glance') ?></span>
                        <h2>
                            <?= __('account.welcomeBack') ?>
                            <span id="welcome-name"><?= __('account.reader') ?></span>
                            .
                        </h2>
                    </div>
                    <p><?= __('account.activityDescription') ?></p>
                </div>
                <div class="account-stats">
                    <article>
                        <span class="stat-icon"><i class="fa-solid fa-book"></i></span>
                        <div>
                            <strong id="active-listings-count">—</strong>
                            <span><?= __('myListings.active') ?></span>
                        </div>
                    </article>
                    <article>
                        <span class="stat-icon amber"><i class="fa-regular fa-heart"></i></span>
                        <div>
                            <strong id="wishlist-count">0</strong>
                            <span><?= __('account.wishlistItems') ?></span>
                        </div>
                    </article>
                    <article>
                        <span class="stat-icon soft"><i class="fa-solid fa-bag-shopping"></i></span>
                        <div>
                            <strong id="buyer-order-count">—</strong>
                            <span><?= __('commerce.myOrders') ?></span>
                        </div>
                    </article>
                </div>
                <div class="account-card getting-started">
                    <div>
                        <span class="eyebrow"><?= __('account.getStarted') ?></span>
                        <h3><?= __('account.nextChapter') ?></h3>
                        <p><?= __('myListings.subtitle') ?></p>
                    </div>
                    <button class="btn btn-primary" type="button" data-account-tab="listings">
                        <?= __('myListings.title') ?>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </section>

            <section class="account-panel" id="panel-listings" role="tabpanel" data-panel="listings" hidden>
                <div class="panel-heading">
                    <div>
                        <span class="eyebrow"><?= __('myListings.shelf') ?></span>
                        <h2><?= __('myListings.title') ?></h2>
                    </div>
                    <p><?= __('myListings.subtitle') ?></p>
                </div>
                <p id="listings-status" role="status" aria-live="polite"></p>
                <div id="my-listings" class="my-listings"></div>
                <div class="account-empty" id="listings-empty" hidden>
                    <span><i class="fa-solid fa-book-open"></i></span>
                    <h3><?= __('myListings.empty') ?></h3>
                    <a class="btn btn-primary" href="pages/create-listing.php"><?= __('myListings.sellBook') ?></a>
                </div>
            </section>

            <section class="account-panel" id="panel-wishlist" role="tabpanel" data-panel="wishlist" data-wishlist-page data-profile-wishlist data-loading-label="<?= htmlspecialchars(__('wishlist.loading')) ?>" data-error-label="<?= htmlspecialchars(__('wishlist.loadFailed')) ?>" data-wishlist-translations="<?= htmlspecialchars(json_encode(array_merge($translations['wishlist'], $translations['catalog']), JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?>" hidden>
                <div class="panel-heading">
                    <div>
                        <span class="eyebrow"><?= __('account.savedBooks') ?></span>
                        <h2><?= __('wishlist.pageTitle') ?></h2>
                    </div>
                    <p><?= __('account.wishlistDescription') ?></p>
                </div>
                <p data-wishlist-status role="status" aria-live="polite"></p>
                <div class="book-grid" data-wishlist-list></div>
                <div class="account-empty" data-wishlist-empty hidden>
                    <span><i class="fa-regular fa-heart"></i></span>
                    <h3><?= __('account.wishlistEmpty') ?></h3>
                    <p><?= __('account.wishlistEmptyDescription') ?></p>
                    <a class="btn btn-primary" href="pages/books.php"><?= __('home.exploreBooks') ?></a>
                </div>
            </section>

            <section class="account-panel" id="panel-orders" role="tabpanel" data-panel="orders" hidden>
                <h2><?= __('commerce.myOrders') ?></h2>
                <p id="orders-status" class="commerce-status" role="status" aria-live="polite"></p>
                <button type="button" class="btn btn-secondary" id="orders-retry"><?= __('commerce.retry') ?></button>
                <div id="buyer-orders" class="commerce-items"></div>
            </section>
            <section class="account-panel" id="panel-sales" role="tabpanel" data-panel="sales" hidden>
                <h2><?= __('commerce.sales') ?></h2>
                <p id="sales-status" class="commerce-status" role="status" aria-live="polite"></p>
                <button type="button" class="btn btn-secondary" id="sales-retry"><?= __('commerce.retry') ?></button>
                <div id="seller-orders" class="commerce-items"></div>
            </section>

            <section class="account-panel" id="panel-settings" role="tabpanel" data-panel="settings" hidden>
                <div class="panel-heading">
                    <div>
                        <span class="eyebrow"><?= __('account.details') ?></span>
                        <h2><?= __('account.settings') ?></h2>
                    </div>
                    <p><?= __('account.authenticatedDetails') ?></p>
                </div>
                <div class="account-card profile-details">
                    <dl>
                        <div>
                            <dt><?= __('account.name') ?></dt>
                            <dd id="settings-name">—</dd>
                        </div>
                        <div>
                            <dt><?= __('account.email') ?></dt>
                            <dd id="settings-email">—</dd>
                        </div>
                        <div>
                            <dt><?= __('account.userId') ?></dt>
                            <dd id="settings-user-id">—</dd>
                        </div>
                    </dl>
                    <p class="settings-note">
                        <i class="fa-solid fa-circle-info"></i>
                        <?= __('account.editingUnavailable') ?>
                    </p>
                </div>
            </section>
        </div>
    </div>
</main>

<dialog id="delete-listing-dialog" class="delete-listing-dialog" aria-labelledby="delete-listing-title" aria-describedby="delete-listing-warning">
    <h2 id="delete-listing-title"><?= __('myListings.confirm') ?></h2>
    <p id="delete-listing-warning"><?= __('myListings.warning') ?></p>
    <p id="delete-listing-error" role="alert"></p>
    <div class="listing-actions">
        <button class="btn btn-secondary" type="button" id="cancel-listing-delete" autofocus><?= __('myListings.cancel') ?></button>
        <button class="btn btn-primary" type="button" id="confirm-listing-delete"><?= __('myListings.deleteListing') ?></button>
    </div>
</dialog>

<script src="assets/js/account.js"></script>
<script src="assets/js/orders.js"></script>
<script src="assets/js/wishlist-page.js"></script>
<?php require_once __DIR__ . '/components/footer.php'; ?>
