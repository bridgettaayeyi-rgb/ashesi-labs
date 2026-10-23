<?php
require_once __DIR__ . '/../../core/core.php';
require_once __DIR__ . '/../../controller/ProductController.php';

require_admin();

$controller  = new ProductController();
$categories  = $controller->getAllCategories();
$brands      = $controller->getAllBrands();
$products    = $controller->getAllProducts();

$edit_product = null;
if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);
    $edit_product = $controller->getProductById($edit_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products - Shoppn</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php include __DIR__ . '/../layout/header.php'; ?>

<main class="container">

    <?php if (isset($_SESSION['success'])): ?>
        <div style="color: green; margin-bottom: 15px;">
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div style="color: red; margin-bottom: 15px;">
            <?= $_SESSION['error'] ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="admin-form-section" style="max-width: 560px;">
        <h1><?= $edit_product ? 'Edit Product' : 'Add Product' ?></h1>

        <form method="POST"
              enctype="multipart/form-data"
              action="<?= $edit_product
                  ? '../../actions/update_product.php'
                  : '../../actions/add_product.php' ?>">

            <?php if ($edit_product): ?>
                <input type="hidden" name="product_id" value="<?= $edit_product['product_id'] ?>">
                <input type="hidden" name="old_image" value="<?= htmlspecialchars($edit_product['product_image']) ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="product_title">Product Title</label>
                <input type="text" name="product_title" id="product_title"
                       value="<?= $edit_product ? htmlspecialchars($edit_product['product_title']) : '' ?>"
                       required>
            </div>

            <div class="form-group">
                <label for="product_price">Price</label>
                <input type="number" step="0.01" min="0" name="product_price" id="product_price"
                       value="<?= $edit_product ? htmlspecialchars($edit_product['product_price']) : '' ?>"
                       required>
            </div>

            <div class="form-group">
                <label for="product_cat">Category</label>
                <select name="product_cat" id="product_cat" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['cat_id'] ?>"
                            <?= ($edit_product && $edit_product['product_cat'] == $cat['cat_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['cat_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="product_brand">Brand</label>
                <select name="product_brand" id="product_brand" required>
                    <option value="">Select Brand</option>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?= $brand['brand_id'] ?>"
                            <?= ($edit_product && $edit_product['product_brand'] == $brand['brand_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($brand['brand_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="product_desc">Description</label>
                <textarea name="product_desc" id="product_desc" rows="4"><?= $edit_product ? htmlspecialchars($edit_product['product_desc']) : '' ?></textarea>
            </div>

            <div class="form-group">
                <label for="product_keywords">Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords"
                       value="<?= $edit_product ? htmlspecialchars($edit_product['product_keywords']) : '' ?>"
                       placeholder="e.g. dress, summer, cotton">
            </div>

            <div class="form-group">
                <label for="product_image">Product Image <?= $edit_product ? '(leave empty to keep current)' : '' ?></label>
                <input type="file" name="product_image" id="product_image" accept="image/jpeg,image/png,image/gif,image/webp"
                       <?= $edit_product ? '' : 'required' ?>>
                <?php if ($edit_product && !empty($edit_product['product_image'])): ?>
                    <p style="margin-top: 0.5rem;">
                        <img src="../../images/products/<?= htmlspecialchars($edit_product['product_image']) ?>"
                             alt="Current" style="max-width: 120px; border-radius: 8px;">
                    </p>
                <?php endif; ?>
            </div>

            <button type="submit">
                <?= $edit_product ? 'Update Product' : 'Add Product' ?>
            </button>
            <?php if ($edit_product): ?>
                <a href="product.php">Cancel</a>
            <?php endif; ?>
        </form>
    </div>

    <hr style="border: none; border-top: 2px solid #E8B4B8; margin: 2rem 0;">

    <h2>All Products</h2>

    <?php if (empty($products)): ?>
        <p style="color: #7A5A60;">No products yet. Add one above.</p>
    <?php else: ?>
        <div class="cards-grid">
            <?php foreach ($products as $p): ?>
                <div class="brand-card">
                    <?php if (!empty($p['product_image'])): ?>
                        <img src="../../images/products/<?= htmlspecialchars($p['product_image']) ?>"
                             alt="<?= htmlspecialchars($p['product_title']) ?>"
                             style="width: 100%; height: 140px; object-fit: cover; border-radius: 10px; margin-bottom: 0.75rem;">
                    <?php else: ?>
                        <div class="brand-icon">P</div>
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($p['product_title']) ?></h3>
                    <p class="brand-id">
                        $<?= number_format((float)$p['product_price'], 2) ?><br>
                        <?= htmlspecialchars($p['cat_name'] ?? '') ?> · <?= htmlspecialchars($p['brand_name'] ?? '') ?>
                    </p>
                    <div class="card-actions">
                        <a href="product.php?edit_id=<?= $p['product_id'] ?>">Edit</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</main>

<?php include __DIR__ . '/../layout/footer.php'; ?>
</body>
</html>