<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/ProductController.php';

$pro_id = intval($_GET['pro_id'] ?? 0);
if ($pro_id <= 0) {
    header('Location: products.php');
    exit;
}

$controller = new ProductController();
$product = $controller->getProductById($pro_id);

if (!$product) {
    header('Location: products.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['product_title']) ?> - Shoppn</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <p><a href="products.php">← Back to Products</a></p>

    <div class="admin-form-section" style="max-width: 350px;">
        <?php if (!empty($product['product_image'])): ?>
            <img src="../images/products/<?= htmlspecialchars($product['product_image']) ?>"
                 alt="<?= htmlspecialchars($product['product_title']) ?>"
                 style="width: 100%; max-height: 320px; object-fit: cover; border-radius: 12px; margin-bottom: 1rem;">
        <?php endif; ?>

        <h1><?= htmlspecialchars($product['product_title']) ?></h1>
        <p style="font-size: 1.25rem; color: #6B0F1A; font-weight: 700; margin-bottom: 0.75rem;">
            $<?= number_format((float)$product['product_price'], 2) ?>
        </p>
        <p class="brand-id" style="margin-bottom: 1rem;">
            Category: <?= htmlspecialchars($product['cat_name'] ?? '—') ?><br>
            Brand: <?= htmlspecialchars($product['brand_name'] ?? '—') ?>
        </p>
        <p style="margin-bottom: 1rem;">
            <?= nl2br(htmlspecialchars($product['product_desc'] ?? '')) ?>
        </p>
        <?php if (!empty($product['product_keywords'])): ?>
            <p class="brand-id">Keywords: <?= htmlspecialchars($product['product_keywords']) ?></p>
        <?php endif; ?>
        <form method="POST" action="/~bridgetta.akoto/assignments/shoppn/actions/manage_cart.php">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
            <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" name="qty" id="qty" value="1" min="1">
            </div>
            <button type="submit">Add to Cart</button>
    </form>
    </div>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
</body>
</html>