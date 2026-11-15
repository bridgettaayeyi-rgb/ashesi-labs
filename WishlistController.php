<?php
require_once __DIR__ . '/../class/WishlistClass.php';

class WishlistController {
    private $wishlist;

    public function __construct() {
        $this->wishlist = new WishlistClass();
    }

    public function add($customer_id, $product_id) {
        return $this->wishlist->add($customer_id, $product_id);
    }

    public function remove($customer_id, $product_id) {
        return $this->wishlist->remove($customer_id, $product_id);
    }

    public function getItems($customer_id) {
        return $this->wishlist->getItems($customer_id);
    }
}