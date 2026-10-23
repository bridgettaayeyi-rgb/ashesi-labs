<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/CartController.php';

$controller = new CartController();
$items = $controller->getCartItems();
$total = $controller->getCartTotal();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart - Shoppn</title>
    <link rel="stylesheet" href="/~bridgetta.akoto/assignments/shoppn/css/style.css">
</head>
<body>

<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <h1>Your Cart</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <div style="color: green; margin-bottom: 15px;">
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div style="color: red; margin-bottom: 15px;">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (empty($items)): ?>
        <p style="color: #7A5A60;">Your cart is empty.</p>
        <p><a href="/~bridgetta.akoto/assignments/shoppn/views/products.php">Continue shopping</a></p>
    <?php else: ?>
        <div class="cards-grid">
            <?php foreach ($items as $item): ?>
                <div class="brand-card">
                    <?php if (!empty($item['product_image'])): ?>
                        <img src="/~bridgetta.akoto/assignments/shoppn/images/products/<?= htmlspecialchars($item['product_image']) ?>"
                             alt="<?= htmlspecialchars($item['product_title']) ?>"
                             style="width:100%;height:140px;object-fit:cover;border-radius:10px;margin-bottom:0.75rem;">
                    <?php endif; ?>

                    <h3><?= htmlspecialchars($item['product_title']) ?></h3>
                    <p class="brand-id">
                        $<?= number_format((float)$item['product_price'], 2) ?> each
                    </p>
                    <p class="brand-id">
                        Line total: $<?= number_format($item['line_total'], 2) ?>
                    </p>

                    <form method="POST" action="/~bridgetta.akoto/assignments/shoppn/actions/manage_cart.php"
                          class="header-search" style="margin: 0.75rem 0;">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                        <input type="number" name="qty" value="<?= $item['qty'] ?>" min="1" style="width:70px;">
                        <button type="submit">Update</button>
                    </form>

                    <form method="POST" action="/~bridgetta.akoto/assignments/shoppn/actions/manage_cart.php"
                          onsubmit="return confirm('Remove this item?');"
                          style="display:inline;">
                        <input type="hidden" name="action" value="remove">
                        <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                        <button type="submit" class="btn-danger">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="admin-form-section" style="margin-top: 2rem;">
            <h2>Total: $<?= number_format($total, 2) ?></h2>

            <form method="POST" action="/~bridgetta.akoto/assignments/shoppn/actions/manage_cart.php"
                  onsubmit="return confirm('Empty the entire cart?');">
                <input type="hidden" name="action" value="empty">
                <button type="submit" class="btn-danger">Empty Cart</button>
            </form>

            <p style="margin-top: 1rem;">
                <a href="/~bridgetta.akoto/assignments/shoppn/views/products.php">Continue shopping</a>
            </p>
        </div>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
</body>
</html>