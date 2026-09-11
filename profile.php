<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/translator.php';

$basePath = '';
$pageTitle = 'My Account | Marketplace Library';
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

<main class="account-page">
    <section class="account-hero">
        <div class="container account-hero-inner">
            <div class="account-identity">
                <span class="account-avatar" id="account-avatar" aria-hidden="true">—</span>
                <div>
                    <span class="eyebrow">MARKETPLACE LIBRARY</span>
                    <h1>My Account</h1>
                    <p class="account-name" id="account-name">Loading account…</p>
                    <p class="account-email" id="account-email"></p>
                    <span class="member-badge">
                        <i class="fa-solid fa-circle-check"></i>
                        Account active
                    </span>
                </div>
            </div>
            <div class="account-actions">
                <button class="btn btn-secondary" type="button" data-account-tab="settings">
                    <i class="fa-regular fa-pen-to-square"></i>
                    Edit Profile
                </button>
                <button class="btn btn-primary" id="logout-button" type="button">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout
                </button>
            </div>
        </div>
    </section>

    <div class="container account-layout">
        <aside class="account-sidebar" aria-label="Account navigation">
            <div class="account-sidebar-heading">
                <span class="account-avatar account-avatar-small" id="sidebar-avatar" aria-hidden="true">—</span>
                <div>
                    <strong id="sidebar-name">My Account</strong>
                    <small>Reader account</small>
                </div>
            </div>
            <nav class="account-tabs" role="tablist" aria-label="Account sections">
                <button
                    class="account-tab is-active"
                    type="button"
                    role="tab"
                    aria-selected="true"
                    aria-controls="panel-overview"
                    data-tab="overview"
                >
                    <i class="fa-solid fa-table-columns"></i>
                    <span>Overview</span>
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
                    <span>My Listings</span>
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
                    <span>Wishlist</span>
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
                    <span>Orders</span>
                </button>
                <button
                    class="account-tab"
                    type="button"
                    role="tab"
                    aria-selected="false"
                    aria-controls="panel-settings"
                    data-tab="settings"
                >
                    <i class="fa-solid fa-gear"></i>
                    <span>Profile Settings</span>
                </button>
            </nav>
        </aside>

        <div class="account-content">
            <section class="account-panel is-active" id="panel-overview" role="tabpanel" data-panel="overview">
                <div class="panel-heading">
                    <div>
                        <span class="eyebrow">AT A GLANCE</span>
                        <h2>
                            Welcome back,
                            <span id="welcome-name">reader</span>
                            .
                        </h2>
                    </div>
                    <p>Your Marketplace Library activity will appear here.</p>
                </div>
                <div class="account-stats">
                    <article>
                        <span class="stat-icon"><i class="fa-solid fa-book"></i></span>
                        <div>
                            <strong>0</strong>
                            <span>Active listings</span>
                        </div>
                    </article>
                    <article>
                        <span class="stat-icon amber"><i class="fa-regular fa-heart"></i></span>
                        <div>
                            <strong>0</strong>
                            <span>Wishlist items</span>
                        </div>
                    </article>
                    <article>
                        <span class="stat-icon soft"><i class="fa-solid fa-bag-shopping"></i></span>
                        <div>
                            <strong>0</strong>
                            <span>Orders</span>
                        </div>
                    </article>
                </div>
                <div class="account-card getting-started">
                    <div>
                        <span class="eyebrow">GET STARTED</span>
                        <h3>Give a book its next chapter.</h3>
                        <p>Your listings will be shown here when marketplace persistence is available.</p>
                    </div>
                    <button class="btn btn-primary" type="button" data-account-tab="listings">
                        View My Listings
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </section>

            <section class="account-panel" id="panel-listings" role="tabpanel" data-panel="listings" hidden>
                <div class="panel-heading">
                    <div>
                        <span class="eyebrow">YOUR SHELF</span>
                        <h2>My Listings</h2>
                    </div>
                    <p>Manage the books you offer to the community.</p>
                </div>
                <div class="account-empty">
                    <span><i class="fa-solid fa-book-open"></i></span>
                    <h3>No listings yet</h3>
                    <p>Your active book listings will appear here when this feature is connected.</p>
                </div>
            </section>

            <section class="account-panel" id="panel-wishlist" role="tabpanel" data-panel="wishlist" hidden>
                <div class="panel-heading">
                    <div>
                        <span class="eyebrow">SAVED BOOKS</span>
                        <h2>Wishlist</h2>
                    </div>
                    <p>Keep track of books you would like to read next.</p>
                </div>
                <div class="account-empty">
                    <span><i class="fa-regular fa-heart"></i></span>
                    <h3>Your wishlist is empty</h3>
                    <p>Browse the marketplace to discover and save your next read.</p>
                    <a class="btn btn-primary" href="pages/books.php">Explore Books</a>
                </div>
            </section>

            <section class="account-panel" id="panel-orders" role="tabpanel" data-panel="orders" hidden>
                <div class="panel-heading">
                    <div>
                        <span class="eyebrow">PURCHASE HISTORY</span>
                        <h2>Orders</h2>
                    </div>
                    <p>Your marketplace orders will be organized here.</p>
                </div>
                <div class="account-empty">
                    <span><i class="fa-solid fa-bag-shopping"></i></span>
                    <h3>No orders yet</h3>
                    <p>Completed and current orders will appear here when ordering is connected.</p>
                    <a class="btn btn-primary" href="pages/books.php">Browse Books</a>
                </div>
            </section>

            <section class="account-panel" id="panel-settings" role="tabpanel" data-panel="settings" hidden>
                <div class="panel-heading">
                    <div>
                        <span class="eyebrow">ACCOUNT DETAILS</span>
                        <h2>Profile Settings</h2>
                    </div>
                    <p>These details come from your authenticated account.</p>
                </div>
                <div class="account-card profile-details">
                    <dl>
                        <div>
                            <dt>Name</dt>
                            <dd id="settings-name">—</dd>
                        </div>
                        <div>
                            <dt>Email</dt>
                            <dd id="settings-email">—</dd>
                        </div>
                        <div>
                            <dt>User ID</dt>
                            <dd id="settings-user-id">—</dd>
                        </div>
                    </dl>
                    <p class="settings-note">
                        <i class="fa-solid fa-circle-info"></i>
                        Profile editing will be available when the account update feature is connected.
                    </p>
                </div>
            </section>
        </div>
    </div>
</main>

<script src="assets/js/account.js"></script>
<?php require_once __DIR__ . '/components/footer.php'; ?>
