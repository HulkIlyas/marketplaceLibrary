<?php
// MUST be at the very top of the file before any output
if (session_status() === PHP_SESSION_NONE) {
    // Ensure session cookie works across all subdirectories
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $_POST['book_id'] ?? null;

    if ($bookId) {
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Store item into PHP Session
        $_SESSION['cart'][$bookId] = [
            'id'            => $bookId,
            'title'         => $_POST['title'] ?? '',
            'author'        => $_POST['author'] ?? '',
            'condition'     => $_POST['condition'] ?? '',
            'seller_name'   => $_POST['seller_name'] ?? '',
            'seller_city'   => $_POST['seller_city'] ?? '',
            'price'         => (float) ($_POST['price'] ?? 0),
            'pattern_class' => $_POST['pattern_class'] ?? 'pattern-a',
            'cover_text'    => $_POST['cover_text'] ?? ''
        ];

        // CRITICAL: Save session memory to disk before finishing the request
        session_write_close();

        echo json_encode(['success' => true, 'cart_count' => count($_SESSION['cart'])]);
        exit;
    }
}

http_response_code(400);
echo json_encode(['success' => false, 'error' => 'Missing book_id']);
exit;
