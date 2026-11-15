<?php
require_once __DIR__ . '/../core/db_class.php';
require_once __DIR__ . '/ProductClass.php';

class WishlistClass extends Database {

    public function add($customer_id, $product_id) {
        $customer_id = intval($customer_id);
        $product_id = intval($product_id);

        $stmt = $this->conn->prepare(
            "INSERT IGNORE INTO wishlist (customer_id, product_id) VALUES (?, ?)"
        );
        $stmt->bind_param("ii", $customer_id, $product_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function remove($customer_id, $product_id) {
        $customer_id = intval($customer_id);
        $product_id = intval($product_id);

        $stmt = $this->conn->prepare(
            "DELETE FROM wishlist WHERE customer_id = ? AND product_id = ?"
        );
        $stmt->bind_param("ii", $customer_id, $product_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function getItems($customer_id) {
        $customer_id = intval($customer_id);

        $stmt = $this->conn->prepare(
            "SELECT p.*, c.cat_name, b.brand_name, w.wishlist_id
             FROM wishlist w
             JOIN products p ON w.product_id = p.product_id
             LEFT JOIN categories c ON p.product_cat = c.cat_id
             LEFT JOIN brands b ON p.product_brand = b.brand_id
             WHERE w.customer_id = ?
             ORDER BY w.wishlist_id DESC"
        );
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        return $items;
    }
}