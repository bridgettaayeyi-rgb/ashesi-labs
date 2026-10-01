<?php
require_once __DIR__ . '/../core/core.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Shoppn</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <h2>Login</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error" style="color: red; margin-bottom: 15px;">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form id="login-form" action="../actions/login_action.php" method="POST" novalidate>
        <div class="form-group">
            <label for="customer_email">Email</label>
            <input type="email" name="customer_email" id="customer_email" required>
        </div>

        <div class="form-group">
            <label for="customer_pass">Password</label>
            <input type="password" name="customer_pass" id="customer_pass" required>
        </div>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
<script src="../js/validate.js"></script>
</body>
</html>