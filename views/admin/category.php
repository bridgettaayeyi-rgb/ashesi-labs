<?php
require_once __DIR__ . '/../../core/core.php';
require_once __DIR__ . '/../../controller/ProductController.php';

require_admin();

$controller = new ProductController();
$categories = $controller->getAllCategories();

$edit_category = null;
if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);
    $edit_category = $controller->getCategoryById($edit_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories - Shoppn</title>
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

    <div class="admin-form-section">
        <h1><?= $edit_category ? 'Edit Category' : 'Add Category' ?></h1>

        <form method="POST"
              action="<?= $edit_category
                  ? '../../actions/update_category.php'
                  : '../../actions/add_category.php' ?>">

            <?php if ($edit_category): ?>
                <input type="hidden" name="cat_id" value="<?= $edit_category['cat_id'] ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="cat_name">Category Name</label>
                <input type="text"
                       name="cat_name"
                       id="cat_name"
                       value="<?= $edit_category ? htmlspecialchars($edit_category['cat_name']) : '' ?>"
                       required>
            </div>

            <button type="submit">
                <?= $edit_category ? 'Update Category' : 'Add Category' ?>
            </button>

            <?php if ($edit_category): ?>
                <a href="category.php">Cancel</a>
            <?php endif; ?>
        </form>
    </div>

    <hr style="border: none; border-top: 2px solid #E8B4B8; margin: 2rem 0;">

    <h2>All Categories</h2>

    <?php if (empty($categories)): ?>
        <p style="color: #7A5A60;">No categories found. Add one above.</p>
    <?php else: ?>
        <div class="cards-grid">
            <?php foreach ($categories as $cat): ?>
                <div class="brand-card">
                    <div class="brand-icon">
                        <?= strtoupper(substr($cat['cat_name'], 0, 1)) ?>
                    </div>
                    <h3><?= htmlspecialchars($cat['cat_name']) ?></h3>
                    <p class="brand-id">ID: <?= $cat['cat_id'] ?></p>

                    <div class="card-actions">
                        <a href="category.php?edit_id=<?= $cat['cat_id'] ?>">Edit</a>

                        <form method="POST"
                              action="../../actions/delete_category.php"
                              onsubmit="return confirm('Delete this category?');">
                            <input type="hidden" name="cat_id" value="<?= $cat['cat_id'] ?>">
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