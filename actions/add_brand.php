<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/ProductController.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/admin/brand.php');
    exit;
}

$name = trim(strip_tags($_POST['brand_name'] ?? ''));

if (empty($name) || strlen($name) < 2) {
    $_SESSION['error'] = 'Brand name is required (min 2 characters)';
    header('Location: ../views/admin/brand.php');
    exit;
}

$controller = new ProductController();
$result = $controller->addBrand($name);

if ($result) {
    $_SESSION['success'] = 'Brand added successfully.';
} else {
    $_SESSION['error'] = 'Failed to add brand.';
}

header('Location: ../views/admin/brand.php');
exit;