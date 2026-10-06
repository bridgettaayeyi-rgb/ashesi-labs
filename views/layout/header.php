<header class="site-header">
    <div class="container">
        <div class="logo">
            <a href="/shoppn/index.php">Shoppn</a>
        </div>
        <nav>
            <ul>
                <?php if (is_admin()): ?>
                    <li>
                        <a href="/~bridgetta.akoto/assignments/shoppn/views/admin/dashboard.php">Home</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/~bridgetta.akoto/assignments/shoppn/index.php">Home</a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="/~bridgetta.akoto/assignments/shoppn/views/brands.php">Brands</a>
                </li>
                <li>
                    <a href="/~bridgetta.akoto/assignments/shoppn/views/categories.php">Categories</a>
                </li>
                <?php if (is_logged_in()): ?>
                    <li class="welcome-text">
                        Welcome, <?= htmlspecialchars($_SESSION['customer_name']) ?>
                    </li>
                    <li>
                        <a href="/~bridgetta.akoto/assignments/shoppn/views/account/my_account.php">My Account</a>
                    </li>
                    <li>
                        <a href="/~bridgetta.akoto/assignments/shoppn/logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/~bridgetta.akoto/assignments/shoppn/views/register.php">Register</a>
                    </li>
                    <li>
                        <a href="/~bridgetta.akoto/assignments/shoppn/views/login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>