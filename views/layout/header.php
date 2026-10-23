<header class="site-header">
    <div class="container">
        <div class="logo">
            <a href="/~bridgetta.akoto/assignments/shoppn/index.php">Shoppn</a>
        </div>

        <form class="header-search"
              action="/~bridgetta.akoto/assignments/shoppn/views/search_results.php"
              method="GET">
            <input type="text" name="user_query" placeholder="Search products..." required>
            <button type="submit">Search</button>
        </form>

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
                <li>
                    <a href="/~bridgetta.akoto/assignments/shoppn/views/products.php">Products</a>
                </li>
                <li>
                    <a href="/~bridgetta.akoto/assignments/shoppn/views/cart.php"> Cart<?php
                    if (!empty($_SESSION['cart'])) {echo ' (' . array_sum($_SESSION['cart']) . ')';
                    }?>
                    </a>
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