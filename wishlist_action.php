<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/WishlistController.php';

require_login();

$controller   = new WishlistController();
$customer_id  = (int)($_SESSION['customer_id'] ?? 0);
$action       = $_POST['action'] ?? $_GET['action'] ?? '';
$product_id   = (int)($_POST['product_id'] ?? $_GET['product_id'] ?? 0);

if ($customer_id <= 0) {
    $_SESSION['error'] = 'Please log in again.';
    header('Location: ../views/login.php');
    exit;
}

switch ($action) {
    case 'add':
        if ($product_id <= 0) {
            $_SESSION['error'] = 'Invalid product.';
            header('Location: ../views/products.php');
            exit;
        }
        $ok = $controller->add($customer_id, $product_id);
        $_SESSION[$ok ? 'success' : 'error'] = $ok
            ? 'Added to wishlist.'
            : 'Could not add to wishlist (maybe already added).';
        header('Location: ../views/wishlist.php');
        exit;

    case 'remove':
        if ($product_id <= 0) {
            $_SESSION['error'] = 'Invalid product.';
            header('Location: ../views/wishlist.php');
            exit;
        }
        $controller->remove($customer_id, $product_id);
        $_SESSION['success'] = 'Removed from wishlist.';
        header('Location: ../views/wishlist.php');
        exit;

    default:
        header('Location: ../views/wishlist.php');
        exit;
}