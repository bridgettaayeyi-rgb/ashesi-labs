<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/ProductController.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/admin/brand.php');
    exit;
}

$id = intval($_POST['brand_id'] ?? 0);

if ($id <= 0) {
    $_SESSION['error'] = 'Invalid brand ID.';
    header('Location: ../views/admin/brand.php');
    exit;
}

$controller = new ProductController();
$result = $controller->deleteBrand($id);

if ($result) {
    $_SESSION['success'] = 'Brand deleted successfully.';
} else {
    $_SESSION['error'] = 'Failed to delete brand.';
}

header('Location: ../views/admin/brand.php');
exit;