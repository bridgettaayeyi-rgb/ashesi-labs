<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/CustomerController.php';

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/login.php');
    exit;
}

$email = trim(strip_tags($_POST['customer_email'] ?? ''));
$pass  = $_POST['customer_pass'] ?? '';

// Basic validation
if (empty($email) || empty($pass) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Please enter a valid email and password';
    header('Location: ../views/login.php');
    exit;
}

// Attempt login
$controller = new CustomerController();
$result = $controller->login($email, $pass);

// Login successful
if (isset($result['success']) && $result['success'] === true) {

    $customer = $result['customer'];

    $_SESSION['customer_id']    = $customer['customer_id'];
    $_SESSION['customer_name']  = $customer['customer_name'];
    $_SESSION['customer_email'] = $customer['customer_email'];
    $_SESSION['user_role']      = $customer['user_role'];

    header('Location: ../index.php');
    exit;

} else {

    $_SESSION['error'] = $result['error'] ?? 'Invalid email or password';

    header('Location: ../views/login.php');
    exit;
}