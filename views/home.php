<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/ProductController.php';

$controller = new ProductController();
$page_title = 'Featured Products';

if (isset($_GET['cat']) && intval($_GET['cat']) > 0) {
    $cat_id = intval($_GET['cat']);
    $products = $controller->getProductsByCategory($cat_id);
    $page_title = 'Products by Category';
} elseif (isset($_GET['brand']) && intval($_GET['brand']) > 0) {
    $brand_id = intval($_GET['brand']);
    $products = $controller->getProductsByBrand($brand_id);
    $page_title = 'Products by Brand';
} else {
    $products = $controller->getFeaturedProducts(6);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoppn - Home</title>
    <link rel="stylesheet" href="/~bridgetta.akoto/assignments/shoppn/css/style.css">
</head>
<body>

<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <div class="shop-layout">
        <?php include __DIR__ . '/layout/sidebar.php'; ?>

        <section>
            <?php if (is_logged_in()): ?>
                <p class="welcome-msg" style="margin-bottom: 1rem;">
                    Hello, <strong><?= htmlspecialchars($_SESSION['customer_name']) ?></strong>!
                </p>
            <?php endif; ?>

            <h1><?= htmlspecialchars($page_title) ?></h1>

            <?php if (empty($products)): ?>
                <p style="color: #7A5A60;">No products found.</p>
            <?php else: ?>
                <div class="cards-grid">
                    <?php foreach ($products as $p): ?>
                        <div class="brand-card">
                            <?php if (!empty($p['product_image'])): ?>
                                <img src="/~bridgetta.akoto/assignments/shoppn/images/products/<?= htmlspecialchars($p['product_image']) ?>"
                                     alt="<?= htmlspecialchars($p['product_title']) ?>"
                                     style="width:100%;height:160px;object-fit:cover;border-radius:10px;margin-bottom:0.75rem;">
                            <?php else: ?>
                                <div class="brand-icon">P</div>
                            <?php endif; ?>

                            <h3><?= htmlspecialchars($p['product_title']) ?></h3>
                            <p class="brand-id">
                                $<?= number_format((float)$p['product_price'], 2) ?>
                            </p>
                            <div class="card-actions">
                                <a href="/~bridgetta.akoto/assignments/shoppn/views/single_product.php?pro_id=<?= $p['product_id'] ?>">Details</a>
                                <a href="/~bridgetta.akoto/assignments/shoppn/actions/manage_cart.php?action=add&product_id=<?= $p['product_id'] ?>&qty=1">Add to Cart</a>
                                <!-- Add to Cart link -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
</body>
</html>