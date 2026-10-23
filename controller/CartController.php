<?php
require_once __DIR__ . '/../class/CartClass.php';

class CartController {
    private $cart;

    public function __construct() {
        $this->cart = new CartClass();
    }

    public function addToCart($product_id, $qty = 1) {
        return $this->cart->addToCart($product_id, $qty);
    }

    public function updateQty($product_id, $qty) {
        return $this->cart->updateQty($product_id, $qty);
    }

    public function removeFromCart($product_id) {
        return $this->cart->removeFromCart($product_id);
    }

    public function emptyCart() {
        return $this->cart->emptyCart();
    }

    public function getCartItems() {
        return $this->cart->getCartItems();
    }

    public function getCartCount() {
        return $this->cart->getCartCount();
    }

    public function getCartTotal() {
        return $this->cart->getCartTotal();
    }
}