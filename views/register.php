<?php
require_once __DIR__ . '/../core/core.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Shoppn</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include __DIR__ . '/layout/header.php'; ?>

<main class="container">
    <h2>Create an Account</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error">
            <?= $_SESSION['error'] ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form id="register-form" action="../actions/register_action.php" method="POST" novalidate>
        <div class="form-group">
            <label for="customer_name">Full Name</label>
            <input type="text" name="customer_name" id="customer_name" required>
            <span class="error" id="name-error"></span>
        </div>

        <div class="form-group">
            <label for="customer_email">Email</label>
            <input type="email" name="customer_email" id="customer_email" required>
            <span class="error" id="email-error"></span>
        </div>

        <div class="form-group">
            <label for="customer_pass">Password</label>
            <input type="password" name="customer_pass" id="customer_pass" required>
            <span class="error" id="pass-error"></span>
        </div>

        <div class="form-group">
            <label for="customer_country">Country</label>
            <select name="customer_country" id="customer_country" required>
                <option value=""> Select Country </option>
                <option value="Ghana">Ghana</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Kenya">Kenya</option>
                <option value="Algeria">Algeria</option>
                <option value="Egypt">Egypt</option>
                <option value="Libya">Libya</option>
                <option value="Morocco">Morocco</option>
                <option value="Sudan">Sudan</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Benin">Benin</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                <option value="Gambia">Gambia</option>
                <option value="Niger">Niger</option>
                <option value="Mali">Mali</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Chad">Chad</option>
                <option value="Gabon">Gabon</option>
                <option value="Burundi">Burundi</option>
                <option value="Comoros">Niger</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Malawi">Malawi</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Uganda">Uganda</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Tanzania">Tanzania</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
                <option value="Angola">Angola</option>
                <option value="Botswana">Botswana</option>
                <option value="Namibia">Namibia</option>
                <option value="South Africa">South Africa</option>
            </select>
            <span class="error" id="country-error"></span>
        </div>

        <div class="form-group">
            <label for="customer_city">City</label>
            <input type="text" name="customer_city" id="customer_city" required>
            <span class="error" id="city-error"></span>
        </div>

        <div class="form-group">
            <label for="customer_contact">Contact Number</label>
            <input type="text" name="customer_contact" id="customer_contact" required>
            <span class="error" id="contact-error"></span>
        </div>

        <button type="submit" id="register-btn">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>
<script src="../js/validate.js"></script>
</body>
</html>