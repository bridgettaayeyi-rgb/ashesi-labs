<?php
require_once __DIR__ . '/../core/core.php';
require_login();
$order_id = intval($_GET['order_id'] ?? 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Success - Shoppn</title>
    <link rel="stylesheet" href="/~bridgetta.akoto/assignments/shoppn/css/style.css">
</head>
<body>
<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <div class="hero">
        <h1>Payment Successful</h1>
        <p class="welcome-msg">
            Thank you! Your order<?php if ($order_id) echo ' #' . $order_id; ?> has been placed.
            <p style="margin-top: 1.25rem;">
            <a class="btn" href="/~bridgetta.akoto/assignments/shoppn/views/account/my_account.php">View my orders</a>
        </p>
        <p style="margin-top: 0.75rem;">
            <a class="btn" href="/~bridgetta.akoto/assignments/shoppn/views/products.php">Continue shopping</a>
        </p>
    </div>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
</body>
</html>