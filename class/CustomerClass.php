<?php
require_once __DIR__ . '/../core/db_class.php';

class CustomerClass extends Database {

    // Check if email already exists
    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT customer_email FROM customer WHERE customer_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    // Register a new customer
    public function addCustomer($name, $email, $pass, $country, $city, $contact) {
        $hashed = password_hash($pass, PASSWORD_BCRYPT);

        $stmt = $this->conn->prepare(
            "INSERT INTO customer (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, user_role) 
             VALUES (?, ?, ?, ?, ?, ?, 2)"
        );
        $stmt->bind_param("ssssss", $name, $email, $hashed, $country, $city, $contact);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    // Get customer by email (for login)
    public function getCustomerByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM customer WHERE customer_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row ? $row : false;
    }

    // Login – verify password
    public function login($email, $pass) {
        $customer = $this->getCustomerByEmail($email);
        if ($customer && password_verify($pass, $customer['customer_pass'])) {
            return $customer;
        }
        return false;
    }
}