<?php
require_once __DIR__ . '/../../core/core.php';
require_once __DIR__ . '/../../controller/ProductController.php';

require_admin();

$controller = new ProductController();
$brands = $controller->getAllBrands();

// Edit mode
$edit_brand = null;
if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);
    $edit_brand = $controller->getBrandById($edit_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Brands - Shoppn</title>
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
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Add / Edit Form -->
    <div class="admin-form-section">
        <h1><?= $edit_brand ? 'Edit Brand' : 'Add Brand' ?></h1>

        <form method="POST"
              action="<?= $edit_brand
                  ? '../../actions/update_brand.php'
                  : '../../actions/add_brand.php' ?>">

            <?php if ($edit_brand): ?>
                <input type="hidden" name="brand_id" value="<?= $edit_brand['brand_id'] ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="brand_name">Brand Name</label>
                <input type="text"
                       name="brand_name"
                       id="brand_name"
                       value="<?= $edit_brand ? htmlspecialchars($edit_brand['brand_name']) : '' ?>"
                       required>
            </div>

            <button type="submit">
                <?= $edit_brand ? 'Update Brand' : 'Add Brand' ?>
            </button>

            <?php if ($edit_brand): ?>
                <a href="brand.php">Cancel</a>
            <?php endif; ?>
        </form>
    </div>

    <hr style="border: none; border-top: 2px solid #E8B4B8; margin: 2rem 0;">

    <h2>All Brands</h2>

    <?php if (empty($brands)): ?>
        <p style="color: #7A5A60;">No brands found. Add one above.</p>
    <?php else: ?>
        <div class="cards-grid">
            <?php foreach ($brands as $brand): ?>
                <div class="brand-card">
                    <div class="brand-icon">
                        <?= strtoupper(substr($brand['brand_name'], 0, 1)) ?>
                    </div>
                    <h3><?= htmlspecialchars($brand['brand_name']) ?></h3>
                    <p class="brand-id">ID: <?= $brand['brand_id'] ?></p>

                    <div class="card-actions">
                        <a href="brand.php?edit_id=<?= $brand['brand_id'] ?>">Edit</a>

                        <form method="POST"
                              action="../../actions/delete_brand.php"
                              onsubmit="return confirm('Delete this brand?');">
                            <input type="hidden" name="brand_id" value="<?= $brand['brand_id'] ?>">
                            <button type="submit" class="btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</main>

<?php include __DIR__ . '/../layout/footer.php'; ?>
</body>
</html>