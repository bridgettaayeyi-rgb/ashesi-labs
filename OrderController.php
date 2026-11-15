<?php
require_once __DIR__ . '/../class/OrderClass.php';

class OrderController {
    private $order;

    public function __construct() {
        $this->order = new OrderClass();
    }

    public function createOrder($customer_id, $invoice_no, $total, $payment_ref, $items) {
        return $this->order->createOrder($customer_id, $invoice_no, $total, $payment_ref, $items);
    }
    public function getOrdersByCustomer($customer_id) {
        return $this->order->getOrdersByCustomer($customer_id);
    }
    
    public function getOrderDetails($order_id) {
        return $this->order->getOrderDetails($order_id);
    }
}