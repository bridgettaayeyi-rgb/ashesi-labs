<?php
require_once __DIR__ . '/core/core.php';

// Using logout function from core.php
secure_logout();

// Redirecting to home page after logout
header('Location: index.php');
exit;