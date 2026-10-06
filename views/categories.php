<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/ProductController.php';

$controller = new ProductController();
$categories = $controller->getAllCategories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories - Shoppn</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <h1>Categories</h1>

    <?php if (empty($categories)): ?>
        <p style="color: #7A5A60;">No categories available yet.</p>
    <?php else: ?>
        <div class="cards-grid">
            <?php foreach ($categories as $cat): ?>
                <div class="brand-card">
                    <div class="brand-icon">
                        <?= strtoupper(substr($cat['cat_name'], 0, 1)) ?>
                    </div>
                    <h3><?= htmlspecialchars($cat['cat_name']) ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
</body>
</html>