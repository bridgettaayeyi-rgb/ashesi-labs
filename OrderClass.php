<?php
require_once __DIR__ . '/../core/db_class.php';

class OrderClass extends Database {

    public function createOrder($customer_id, $invoice_no, $total, $payment_ref, $items) {
        $this->conn->begin_transaction();

        try {
            $status = 'Paid';
            $stmt = $this->conn->prepare(
                "INSERT INTO orders (customer_id, invoice_no, order_status, total_amount, payment_ref)
                 VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("issds", $customer_id, $invoice_no, $status, $total, $payment_ref);
            $stmt->execute();
            $order_id = $this->conn->insert_id;
            $stmt->close();

            $stmt2 = $this->conn->prepare(
                "INSERT INTO orderdetails (order_id, product_id, qty, price) VALUES (?, ?, ?, ?)"
            );

            foreach ($items as $item) {
                $pid = intval($item['product_id']);
                $qty = intval($item['qty']);
                $price = (float)$item['product_price'];
                $stmt2->bind_param("iiid", $order_id, $pid, $qty, $price);
                $stmt2->execute();
            }
            $stmt2->close();

            $this->conn->commit();
            return $order_id;
        } catch (Exception $e) {
            $this->conn->rollback();
            return false;
        }
    }
    public function getOrdersByCustomer($customer_id) {
        $customer_id = (int)$customer_id;
    
        $stmt = $this->conn->prepare(
            "SELECT * FROM orders
             WHERE customer_id = ?
             ORDER BY order_id DESC"
        );
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        $stmt->close();
        return $orders;
    }
    
    public function getOrderDetails($order_id) {
        $order_id = (int)$order_id;
    
        $stmt = $this->conn->prepare(
            "SELECT od.*, p.product_title, p.product_image
             FROM orderdetails od
             LEFT JOIN products p ON od.product_id = p.product_id
             WHERE od.order_id = ?"
        );
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $details = [];
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        $stmt->close();
        return $details;
    }
}