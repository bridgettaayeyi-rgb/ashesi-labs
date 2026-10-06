<?php
require_once __DIR__ . '/../../core/core.php';
require_admin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Shoppn</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php include __DIR__ . '/../layout/header.php'; ?>

<main class="container">
    <h1>Admin Dashboard</h1>
    <p class="dashboard-intro">
        Welcome, <?= htmlspecialchars($_SESSION['customer_name']) ?>. Choose a section to manage.
    </p>

    <div class="cards-grid">

        <a href="brand.php" class="dash-card">
            <div class="dash-icon">B</div>
            <h3>Manage Brands</h3>
            <p>Add, edit, and delete product brands</p>
        </a>

        <a href="category.php" class="dash-card">
            <div class="dash-icon">C</div>
            <h3>Manage Categories</h3>
            <p>Organise product categories</p>
        </a>

        <a href="product.php" class="dash-card">
            <div class="dash-icon">P</div>
            <h3>Manage Products</h3>
            <p>Add and edit store products</p>
        </a>

    </div>
</main>

<?php include __DIR__ . '/../layout/footer.php'; ?>
</body>
</html>