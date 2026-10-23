<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/ProductController.php';

$query = trim($_GET['user_query'] ?? '');
$controller = new ProductController();
$products = $query !== '' ? $controller->searchProducts($query) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search - Shoppn</title>
    <link rel="stylesheet" href="/~bridgetta.akoto/assignments/shoppn/css/style.css">
</head>
<body>

<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <div class="shop-layout">
        <?php include __DIR__ . '/layout/sidebar.php'; ?>

        <section>
            <h1>Search Results</h1>
            <?php if ($query === ''): ?>
                <p style="color: #7A5A60;">Enter a search term.</p>
            <?php else: ?>
                <p style="color: #7A5A60; margin-bottom: 1rem;">
                    Results for “<?= htmlspecialchars($query) ?>”
                </p>
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
                                <?php endif; ?>
                                <h3><?= htmlspecialchars($p['product_title']) ?></h3>
                                <p class="brand-id">$<?= number_format((float)$p['product_price'], 2) ?></p>
                                <div class="card-actions">
                                    <a href="/~bridgetta.akoto/assignments/shoppn/views/single_product.php?pro_id=<?= $p['product_id'] ?>">Details</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </div>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
</body>
</html>