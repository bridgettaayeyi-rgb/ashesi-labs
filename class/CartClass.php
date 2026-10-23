<?php
require_once __DIR__ . '/../core/db_class.php';
require_once __DIR__ . '/ProductClass.php';

class CartClass extends Database {

    public function addToCart($product_id, $qty = 1) {
        $product_id = intval($product_id);
        $qty = max(1, intval($qty));

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $qty;
        } else {
            $_SESSION['cart'][$product_id] = $qty;
        }
        return true;
    }

    public function updateQty($product_id, $qty) {
        $product_id = intval($product_id);
        $qty = intval($qty);

        if (!isset($_SESSION['cart'][$product_id])) {
            return false;
        }

        if ($qty <= 0) {
            unset($_SESSION['cart'][$product_id]);
        } else {
            $_SESSION['cart'][$product_id] = $qty;
        }
        return true;
    }

    public function removeFromCart($product_id) {
        $product_id = intval($product_id);
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
            return true;
        }
        return false;
    }

    public function emptyCart() {
        $_SESSION['cart'] = [];
        return true;
    }

    public function getCartItems() {
        if (empty($_SESSION['cart'])) {
            return [];
        }

        $productModel = new ProductClass();
        $items = [];

        foreach ($_SESSION['cart'] as $product_id => $qty) {
            $product = $productModel->getProductById($product_id);
            if ($product) {
                $product['qty'] = $qty;
                $product['line_total'] = $qty * (float)$product['product_price'];
                $items[] = $product;
            }
        }
        return $items;
    }

    public function getCartCount() {
        if (empty($_SESSION['cart'])) {
            return 0;
        }
        return array_sum($_SESSION['cart']);
    }

    public function getCartTotal() {
        $total = 0;
        foreach ($this->getCartItems() as $item) {
            $total += $item['line_total'];
        }
        return $total;
    }
}