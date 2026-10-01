<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controller/CustomerController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/register.php');
    exit;
}

// Sanitise inputs
$name     = trim(strip_tags($_POST['customer_name'] ?? ''));
$email    = trim(strip_tags($_POST['customer_email'] ?? ''));
$pass     = $_POST['customer_pass'] ?? '';
$country  = trim(strip_tags($_POST['customer_country'] ?? ''));
$city     = trim(strip_tags($_POST['customer_city'] ?? ''));
$contact  = trim(strip_tags($_POST['customer_contact'] ?? ''));

// Server-side validation
$errors = [];

if (empty($name) || strlen($name) < 5) {
    $errors[] = 'Full name is required (min 5 characters)';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 50) {
    $errors[] = 'Valid email is required (max 50 characters)';
}
if (strlen($pass) < 8) {
    $errors[] = 'Password must be at least 8 characters';
}
if (empty($country)) {
    $errors[] = 'Country is required';
}
if (empty($city)) {
    $errors[] = 'City is required';
}
if (!preg_match('/^[0-9+\-\s]{10,15}$/', $contact)) {
    $errors[] = 'Valid contact number is required (10-15 digits)';
}

if (!empty($errors)) {
    $_SESSION['error'] = implode('<br>', $errors);
    header('Location: ../views/register.php');
    exit;
}

$controller = new CustomerController();
$result = $controller->register([
    'name'    => $name,
    'email'   => $email,
    'pass'    => $pass,
    'country' => $country,
    'city'    => $city,
    'contact' => $contact
]);

if ($result['success']) {
    // Get the newly registered customer to set session
    $customerClass = new CustomerClass();
    $customer = $customerClass->getCustomerByEmail($email);

    $_SESSION['customer_id']    = $customer['customer_id'];
    $_SESSION['customer_name']  = $customer['customer_name'];
    $_SESSION['customer_email'] = $customer['customer_email'];
    $_SESSION['user_role']      = $customer['user_role'];

    header('Location: ../views/account/my_account.php');
    exit;
} else {
    $_SESSION['error'] = $result['error'];
    header('Location: ../views/register.php');
    exit;
}