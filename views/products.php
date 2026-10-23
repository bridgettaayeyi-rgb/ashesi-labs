<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/ProductController.php';

$controller = new ProductController();
$products = $controller->getAllProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - Shoppn</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <h1>Products</h1>

    <?php if (empty($products)): ?>
        <p style="color: #7A5A60;">No products available yet.</p>
    <?php else: ?>
        <div class="cards-grid">
            <?php foreach ($products as $p): ?>
                <div class="brand-card product-card">
                    <?php if (!empty($p['product_image'])): ?>
                        <img src="/~bridgetta.akoto/assignments/shoppn/images/products/<?= htmlspecialchars($p['product_image']) ?>"
                             alt="<?= htmlspecialchars($p['product_title']) ?>"
                             style="width: 100%; height: 160px; object-fit: cover; border-radius: 10px; margin-bottom: 0.75rem;">
                    <?php else: ?>
                        <div class="brand-icon">P</div>
                    <?php endif; ?>

                    <h3><?= htmlspecialchars($p['product_title']) ?></h3>
                    <p class="brand-id">
                        $<?= number_format((float)$p['product_price'], 2) ?>
                    </p>
                    <p class="brand-id" style="margin-bottom: 0.75rem;">
                        <?= htmlspecialchars($p['cat_name'] ?? '') ?>
                        <?php if (!empty($p['brand_name'])): ?>
                            · <?= htmlspecialchars($p['brand_name']) ?>
                        <?php endif; ?>
                    </p>

                    <div class="card-actions">
                        <a href="single_product.php?pro_id=<?= $p['product_id'] ?>">Details</a>
                        <a href="/~bridgetta.akoto/assignments/shoppn/actions/manage_cart.php?action=add&product_id=<?= $p['product_id'] ?>&qty=1">Add to Cart</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
</body>
</html>