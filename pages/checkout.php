<?php
require_once __DIR__ . '/../includes/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

require_once __DIR__ . '/../includes/translator.php';
$basePath = '../';
$pageTitle = 'Checkout | Marketplace Library';

// Get items from session
$cartItems = $_SESSION['cart'] ?? [];
$itemCount = count($cartItems);

// Redirect to cart if empty
if ($itemCount === 0) {
    header('Location: cart.php');
    exit;
}

// Fixed delivery fee calculation (can be dynamic based on requirements)
$deliveryFee = 30.00;
$subtotal = 0;

foreach ($cartItems as $item) {
    $subtotal += (float) ($item['price'] ?? 0);
}

$grandTotal = $subtotal + $deliveryFee;
$orderSuccess = false;
$errorMessage = '';

// Handle Checkout Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'place_order') {
    $fullName   = trim($_POST['full_name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $address    = trim($_POST['address'] ?? '');
    $city       = trim($_POST['city'] ?? '');
    $postalCode = trim($_POST['postal_code'] ?? '');

    if (empty($fullName) || empty($email) || empty($address) || empty($city)) {
        $errorMessage = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Please provide a valid email address.';
    } else {
        // Save order logic (e.g., save to DB) goes here

        // Clear cart after successful checkout
        unset($_SESSION['cart']);
        $orderSuccess = true;
    }
}

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<script>
    window.CHECKOUT_CART = <?= json_encode($cartItems ?? []) ?>;
</script>
<script src="<?= $basePath ?>/assets/js/checkout.js"></script>
<main class="inner-page">
    <div class="container checkout-layout">
        <?php if ($orderSuccess): ?>
            <section class="checkout-success" style="text-align: center; width: 100%; padding: 3rem 0;">
                <i class="fa-solid fa-circle-check" style="font-size: 3rem; color: #2e7d32; margin-bottom: 1rem;"></i>
                <h1>Thank you for your order!</h1>
                <p>Your order has been placed successfully. A confirmation email has been sent to your address.</p>
                <a href="catalog.php" class="btn btn-primary" style="margin-top: 1.5rem; display: inline-block;">Continue Shopping</a>
            </section>
        <?php else: ?>
            <form class="checkout-form" method="POST" action="checkout.php">
                <input type="hidden" name="action" value="place_order">
                <span class="eyebrow">SECURE CHECKOUT</span>
                <h1>Delivery details</h1>

                <?php if ($errorMessage): ?>
                    <div class="alert alert-danger" style="color: #d32f2f; margin-bottom: 1rem;">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>

                <fieldset>
                    <legend>Contact information</legend>
                    <div class="field-grid">
                        <label>
                            Full name
                            <input type="text" name="full_name" placeholder="Your full name" value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>" required />
                        </label>
                        <label>
                            Email
                            <input type="email" name="email" placeholder="you@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required />
                        </label>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Delivery information</legend>
                    <label>
                        Address
                        <input type="text" name="address" placeholder="Street and number" value="<?= htmlspecialchars($_POST['address'] ?? '') ?>" required />
                    </label>
                    <div class="field-grid">
                        <label>
                            City
                            <input type="text" name="city" value="<?= htmlspecialchars($_POST['city'] ?? '') ?>" required />
                        </label>
                        <label>
                            Postal code
                            <input type="text" name="postal_code" value="<?= htmlspecialchars($_POST['postal_code'] ?? '') ?>" />
                        </label>
                    </div>
                </fieldset>

                <button class="btn btn-primary" type="submit">Place order</button>
            </form>

            <aside class="order-summary">
                <h2>Your order</h2>
                <p>
                    <span><?= $itemCount ?> <?= $itemCount === 1 ? 'book' : 'books' ?></span>
                    <strong><?= number_format($subtotal, 2) ?> MAD</strong>
                </p>
                <p>
                    <span>Delivery</span>
                    <strong><?= number_format($deliveryFee, 2) ?> MAD</strong>
                </p>
                <hr />
                <p class="total">
                    <span>Total</span>
                    <strong><?= number_format($grandTotal, 2) ?> MAD</strong>
                </p>
                <small>Payment integration will be available later.</small>
            </aside>
        <?php endif; ?>
    </div>
</main>

<?php require __DIR__ . '/../components/footer.php'; ?>