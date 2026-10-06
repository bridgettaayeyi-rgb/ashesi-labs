<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/ProductController.php';

$controller = new ProductController();
$brands = $controller->getAllBrands();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Brands - Shoppn</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <h1>Our Brands</h1>

    <?php if (empty($brands)): ?>
        <p>No brands available yet.</p>
    <?php else: ?>
        <div class="cards-grid">
            <?php foreach ($brands as $brand): ?>
                <div class="brand-card">
                    <div class="brand-icon">
                        <?= strtoupper(substr($brand['brand_name'], 0, 1)) ?>
                    </div>
                    <h3><?= htmlspecialchars($brand['brand_name']) ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
</body>
</html>