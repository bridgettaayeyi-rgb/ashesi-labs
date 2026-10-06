<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/ProductController.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/admin/brand.php');
    exit;
}

$id   = intval($_POST['brand_id'] ?? 0);
$name = trim(strip_tags($_POST['brand_name'] ?? ''));

if ($id <= 0 || empty($name) || strlen($name) < 2) {
    $_SESSION['error'] = 'Invalid brand data.';
    header('Location: ../views/admin/brand.php');
    exit;
}

$controller = new ProductController();
$result = $controller->updateBrand($id, $name);

if ($result) {
    $_SESSION['success'] = 'Brand updated successfully.';
} else {
    $_SESSION['error'] = 'Failed to update brand.';
}

header('Location: ../views/admin/brand.php');
exit;