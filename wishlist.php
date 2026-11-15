<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/WishlistController.php';

require_login();

$controller = new WishlistController();
$items = $controller->getItems($_SESSION['customer_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wishlist - Shoppn</title>
    <link rel="stylesheet" href="/~bridgetta.akoto/assignments/shoppn/css/style.css">
</head>
<body>
<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <h1>My Wishlist</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <div style="color:green;margin-bottom:15px;"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (empty($items)): ?>
        <p style="color:#7A5A60;">Your wishlist is empty.</p>
        <p><a href="/~bridgetta.akoto/assignments/shoppn/views/products.php">Browse products</a></p>
    <?php else: ?>
        <div class="cards-grid">
            <?php foreach ($items as $p): ?>
                <div class="brand-card">
                    <?php if (!empty($p['product_image'])): ?>
                        <img src="/~bridgetta.akoto/assignments/shoppn/images/products/<?= htmlspecialchars($p['product_image']) ?>"
                             alt="" style="width:100%;height:140px;object-fit:cover;border-radius:10px;margin-bottom:0.75rem;">
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($p['product_title']) ?></h3>
                    <p class="brand-id">$<?= number_format((float)$p['product_price'], 2) ?></p>
                    <div class="card-actions">
                        <a href="/~bridgetta.akoto/assignments/shoppn/views/single_product.php?pro_id=<?= $p['product_id'] ?>">Details</a>
                        <a href="/~bridgetta.akoto/assignments/shoppn/actions/manage_cart.php?action=add&product_id=<?= $p['product_id'] ?>&qty=1">Add to Cart</a>
                        <a href="/~bridgetta.akoto/assignments/shoppn/actions/wishlist_action.php?action=remove&product_id=<?= $p['product_id'] ?>"
                           onclick="return confirm('Remove from wishlist?');">Remove</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
</body>
</html>