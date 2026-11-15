<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/CartController.php';

require_login();

$cart = new CartController();
$items = $cart->getCartItems();
$total = $cart->getCartTotal();

if (empty($items)) {
    header('Location: cart.php');
    exit;
}

// Paystack test public key 
$paystack_public_key = 'pk_test_6f1f076c0494f43d729cd3768adb4c1172c75a45';
$email = $_SESSION['customer_email'] ?? '';
$amount_pesewas = (int) round($total * 100); // GHS → pesewas
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Shoppn</title>
    <link rel="stylesheet" href="/~bridgetta.akoto/assignments/shoppn/css/style.css">
    <script src="https://js.paystack.co/v1/inline.js"></script>
</head>
<body>
<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <h1>Checkout</h1>
    <p>Total: <strong>GHS <?= number_format($total, 2) ?></strong></p>

    <button type="button" class="btn" onclick="payWithPaystack()">Pay with Paystack</button>
    <p style="margin-top:1rem;"><a href="/~bridgetta.akoto/assignments/shoppn/views/cart.php">Back to cart</a></p>
</main>

<script>
function payWithPaystack() {
    var handler = PaystackPop.setup({
        key: '<?= htmlspecialchars($paystack_public_key) ?>',
        email: '<?= htmlspecialchars($email) ?>',
        amount: <?= $amount_pesewas ?>,
        currency: 'GHS',
        ref: 'SHOPPN_' + Date.now(),
        callback: function(response) {
            window.location.href = '/~bridgetta.akoto/assignments/shoppn/actions/process_payment.php?reference=' + response.reference;
        },
        onClose: function() {
            alert('Payment window closed.');
        }
    });
    handler.openIframe();
}
</script>

<?php include __DIR__ . '/layout/footer.php'; ?>
</body>
</html>