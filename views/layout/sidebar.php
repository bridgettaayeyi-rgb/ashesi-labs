<?php
if (!isset($controller)) {
    require_once __DIR__ . '/../../controller/ProductController.php';
    $controller = new ProductController();
}
$sidebar_cats   = $controller->getAllCategories();
$sidebar_brands = $controller->getAllBrands();
?>
<aside class="sidebar">
    <h3>Categories</h3>
    <ul class="sidebar-list">
        <?php if (empty($sidebar_cats)): ?>
            <li>No categories</li>
        <?php else: ?>
            <?php foreach ($sidebar_cats as $cat): ?>
                <li>
                    <a href="/~bridgetta.akoto/assignments/shoppn/index.php?cat=<?= $cat['cat_id'] ?>">
                        <?= htmlspecialchars($cat['cat_name']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <h3>Brands</h3>
    <ul class="sidebar-list">
        <?php if (empty($sidebar_brands)): ?>
            <li>No brands</li>
        <?php else: ?>
            <?php foreach ($sidebar_brands as $brand): ?>
                <li>
                    <a href="/~bridgetta.akoto/assignments/shoppn/index.php?brand=<?= $brand['brand_id'] ?>">
                        <?= htmlspecialchars($brand['brand_name']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</aside>