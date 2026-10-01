<?php
require_once __DIR__ . '/../../core/core.php';

// Protect this page – only logged-in users can see it
require_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account - Shoppn</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php include __DIR__ . '/../layout/header.php'; ?>

<main class="container">
    <h1><?= htmlspecialchars($_SESSION['customer_name']) ?>'s Account</h1>

    <div class="account-info">
        <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['customer_name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['customer_email']) ?></p>
        <p><strong>Role:</strong> <?= ($_SESSION['user_role'] == 1) ? 'Admin' : 'Customer' ?></p>
    </div>

    <div class="account-actions">
        <a href="edit_account.php" class="btn">Edit Account</a>
        <a href="change_pass.php" class="btn">Change Password</a>
    </div>
</main>

<?php include __DIR__ . '/../layout/footer.php'; ?>

</body>
</html>