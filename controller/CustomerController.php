<?php
require_once __DIR__ . '/../class/CustomerClass.php';

class CustomerController {
    private $customer;

    public function __construct() {
        $this->customer = new CustomerClass();
    }

    public function register($data) {
        if ($this->customer->emailExists($data['email'])) {
            return ['success' => false, 'error' => 'Email already registered'];
        }

        $result = $this->customer->addCustomer(
            $data['name'],
            $data['email'],
            $data['pass'],
            $data['country'],
            $data['city'],
            $data['contact']
        );

        if ($result) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Registration failed. Please try again.'];
    }

    public function login($email, $pass) {
        $customer = $this->customer->login($email, $pass);

        if ($customer) {
            return [
                'success'  => true,
                'customer' => $customer
            ];
        }

        return [
            'success' => false,
            'error'   => 'Invalid email or password'
        ];
    }
}