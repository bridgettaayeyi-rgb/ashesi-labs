<nav>
    <ul>
        <li><a href="/~bridgetta.akoto/assignments/shoppn/index.php">Home</a></li>

        <?php if (is_logged_in()): ?>
            <h3>Welcome, <?= htmlspecialchars($_SESSION['customer_name']) ?></h3>
            <li><a href="views/account/my_account.php">My Account</a></li>
            <li><a href="/~bridgetta.akoto/assignments/shoppn/logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="views/register.php">Register</a></li>
            <li><a href="views/login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>