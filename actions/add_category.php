<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/ProductController.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/admin/category.php');
    exit;
}

$name = trim(strip_tags($_POST['cat_name'] ?? ''));

if (empty($name) || strlen($name) < 2) {
    $_SESSION['error'] = 'Category name is required (min 2 characters)';
    header('Location: ../views/admin/category.php');
    exit;
}

$controller = new ProductController();
$result = $controller->addCategory($name);

if ($result) {
    $_SESSION['success'] = 'Category added successfully.';
} else {
    $_SESSION['error'] = 'Failed to add category.';
}

header('Location: ../views/admin/category.php');
exit;