<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/CartController.php';
require_once __DIR__ . '/../controller/OrderController.php';

require_login();

$reference = trim($_GET['reference'] ?? '');
if ($reference === '') {
    $_SESSION['error'] = 'No payment reference.';
    header('Location: ../views/cart.php');
    exit;
}

// Paystack test secret key — replace with yours
$secret_key = 'sk_test_2f566917086719fdbc07f6c7d0b6d8008ba21dea';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.paystack.co/transaction/verify/' . rawurlencode($reference));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $secret_key
]);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if (!$result || empty($result['status']) || $result['data']['status'] !== 'success') {
    $_SESSION['error'] = 'Payment verification failed.';
    header('Location: ../views/cart.php');
    exit;
}

// After successful Paystack verify...

$cart  = new CartController();
$items = $cart->getCartItems();
$total = $cart->getCartTotal();

if (empty($items)) {
    $_SESSION['error'] = 'Cart empty after payment — cannot save order.';
    header('Location: ../views/cart.php');
    exit;
}

$invoice_no = 'INV-' . time();
$orderCtrl  = new OrderController();

try {
    $order_id = $orderCtrl->createOrder(
        (int)$_SESSION['customer_id'],
        $invoice_no,
        $total,
        $reference,
        $items
    );
} catch (Throwable $e) {
    $_SESSION['error'] = 'Order error: ' . $e->getMessage();
    header('Location: ../views/cart.php');
    exit;
}

if ($order_id) {
    $cart->emptyCart();
    header('Location: ../views/payment_success.php?order_id=' . $order_id);
    exit;
}

$_SESSION['error'] = 'Could not save order (createOrder returned false). Check orders table columns.';
header('Location: ../views/cart.php');
exit;