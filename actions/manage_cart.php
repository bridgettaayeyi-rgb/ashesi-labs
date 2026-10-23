<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/CartController.php';

$controller = new CartController();
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {

    case 'add':
        $product_id = intval($_POST['product_id'] ?? $_GET['product_id'] ?? 0);
        $qty = max(1, intval($_POST['qty'] ?? $_GET['qty'] ?? 1));

        if ($product_id <= 0) {
            $_SESSION['error'] = 'Invalid product.';
            header('Location: ../views/products.php');
            exit;
        }

        $controller->addToCart($product_id, $qty);
        $_SESSION['success'] = 'Product added to cart.';
        header('Location: ../views/cart.php');
        exit;

    case 'update':
        $product_id = intval($_POST['product_id'] ?? 0);
        $qty = intval($_POST['qty'] ?? 0);

        if ($product_id <= 0) {
            $_SESSION['error'] = 'Invalid product.';
            header('Location: ../views/cart.php');
            exit;
        }

        $controller->updateQty($product_id, $qty);
        $_SESSION['success'] = 'Cart updated.';
        header('Location: ../views/cart.php');
        exit;

    case 'remove':
        $product_id = intval($_POST['product_id'] ?? $_GET['product_id'] ?? 0);

        if ($product_id <= 0) {
            $_SESSION['error'] = 'Invalid product.';
            header('Location: ../views/cart.php');
            exit;
        }

        $controller->removeFromCart($product_id);
        $_SESSION['success'] = 'Item removed from cart.';
        header('Location: ../views/cart.php');
        exit;

    case 'empty':
        $controller->emptyCart();
        $_SESSION['success'] = 'Cart emptied.';
        header('Location: ../views/cart.php');
        exit;

    default:
        header('Location: ../views/cart.php');
        exit;
}