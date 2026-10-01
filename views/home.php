<?php
// home.php is included by index.php after core.php,
// so session and helper functions are already available.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoppn - Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <section class="hero">
        <h1>Welcome to Shoppn</h1>

        <?php if (is_logged_in()): ?>
            <p class="welcome-msg">
                Hello, <strong><?= htmlspecialchars($_SESSION['customer_name']) ?></strong>! 
                You are logged in.
            </p>
            <p>
                <a href="views/account/my_account.php" class="btn">Go to My Account</a>
            </p>
        <?php else: ?>
            <p>Please login or register to start shopping.</p>
            <p>
                <a href="views/login.php" class="btn">Login</a>
                <a href="views/register.php" class="btn">Register</a>
            </p>
        <?php endif; ?>
    </section>

</main>

<?php include __DIR__ . '/layout/footer.php'; ?>

</body>
</html>