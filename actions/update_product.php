<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/ProductController.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/admin/product.php');
    exit;
}

$id            = intval($_POST['product_id'] ?? 0);
$title         = trim(strip_tags($_POST['product_title'] ?? ''));
$price         = trim($_POST['product_price'] ?? '');
$desc          = trim(strip_tags($_POST['product_desc'] ?? ''));
$keywords      = trim(strip_tags($_POST['product_keywords'] ?? ''));
$cat           = intval($_POST['product_cat'] ?? 0);
$brand         = intval($_POST['product_brand'] ?? 0);
$old_image     = trim($_POST['old_image'] ?? '');

$errors = [];

if ($id <= 0) {
    $errors[] = 'Invalid product';
}
if (strlen($title) < 2) {
    $errors[] = 'Product title is required';
}
if (!is_numeric($price) || $price <= 0) {
    $errors[] = 'Valid price is required';
}
if ($cat <= 0) {
    $errors[] = 'Please select a category';
}
if ($brand <= 0) {
    $errors[] = 'Please select a brand';
}

$image_filename = $old_image;
$allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$max_size = 2 * 1024 * 1024;

// New image optional on edit
if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] !== UPLOAD_ERR_NO_FILE) {
    if ($_FILES['product_image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Image upload failed';
    } else {
        $file = $_FILES['product_image'];
        if (!in_array($file['type'], $allowed)) {
            $errors[] = 'Only JPG, PNG, GIF, or WEBP images are allowed';
        }
        if ($file['size'] > $max_size) {
            $errors[] = 'Image must be under 2MB';
        }
        if (empty($errors)) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $image_filename = uniqid('prod_', true) . '.' . strtolower($ext);
            $dest = __DIR__ . '/../images/products/' . $image_filename;
            if (!is_dir(__DIR__ . '/../images/products/')) {
                mkdir(__DIR__ . '/../images/products/', 0755, true);
            }
            if (!move_uploaded_file($file['tmp_name'], $dest)) {
                $errors[] = 'Failed to save image';
            }
        }
    }
}

if (!empty($errors)) {
    $_SESSION['error'] = implode('<br>', $errors);
    header('Location: ../views/admin/product.php?edit_id=' . $id);
    exit;
}

$controller = new ProductController();
$result = $controller->updateProduct($id, $cat, $brand, $title, (float)$price, $desc, $image_filename, $keywords);

$_SESSION[$result ? 'success' : 'error'] = $result
    ? 'Product updated successfully.'
    : 'Failed to update product.';

header('Location: ../views/admin/product.php');
exit;