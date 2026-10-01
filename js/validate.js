document.addEventListener('DOMContentLoaded', function () {

    // REGISTER FORM 
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            let valid = true;

            // Clear previous errors
            document.querySelectorAll('.error').forEach(el => el.textContent = '');

            const name    = document.getElementById('customer_name').value.trim();
            const email   = document.getElementById('customer_email').value.trim();
            const pass    = document.getElementById('customer_pass').value;
            const country = document.getElementById('customer_country').value;
            const city    = document.getElementById('customer_city').value.trim();
            const contact = document.getElementById('customer_contact').value.trim();

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phoneRegex = /^[0-9+\-\s]{7,15}$/;

            if (name.length < 2) {
                document.getElementById('name-error').textContent = 'Name must be at least 2 characters';
                valid = false;
            }
            if (!emailRegex.test(email)) {
                document.getElementById('email-error').textContent = 'Invalid email address';
                valid = false;
            }
            if (pass.length < 8) {
                document.getElementById('pass-error').textContent = 'Password must be at least 8 characters';
                valid = false;
            }
            if (!country) {
                document.getElementById('country-error').textContent = 'Please select a country';
                valid = false;
            }
            if (city.length < 2) {
                document.getElementById('city-error').textContent = 'City is required';
                valid = false;
            }
            if (!phoneRegex.test(contact)) {
                document.getElementById('contact-error').textContent = 'Invalid phone number (7-15 digits)';
                valid = false;
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    }

    // ===== LOGIN FORM =====
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            let valid = true;
            document.querySelectorAll('.error').forEach(el => el.textContent = '');

            const email = document.getElementById('customer_email').value.trim();
            const pass  = document.getElementById('customer_pass').value;

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email)) {
                document.getElementById('email-error').textContent = 'Invalid email address';
                valid = false;
            }
            if (pass.length < 1) {
                document.getElementById('pass-error').textContent = 'Password is required';
                valid = false;
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    }
});