@extends('layouts.master')

@section('content')

<section>
    <div class="container">
        <h1 class="page-title">Create Account</h1>

        <div class="signup-form-container">
            <form method="POST" action="{{ route('saveSignup') }}" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="terms-and-conditions.php">Terms and Conditions</a> and
                                <a href="privacy-policy.php">Privacy Policy</a>
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-signup">Create Account</button>
                    </div>
                    <div class="col-12">
                        <div class="login-link">
                            Already have an account? <a href="{{ route('login') }}">Login</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@push('styles')
<style>
body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.signup-form-container {
    max-width: 500px;
    margin: 40px auto;
    padding: 40px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.page-title {
    text-align: center;
    margin: 40px 0;
    color: #333;
    font-weight: 600;
}

.form-group {
    margin-bottom: 20px;
}

.form-control {
    height: 45px;
    border-radius: 5px;
    border: 1px solid #ddd;
    padding: 10px 15px;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
}

.form-label {
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
}

.btn-signup {
    background-color: #000;
    color: #fff;
    height: 45px;
    border-radius: 5px;
    font-weight: 600;
    width: 100%;
    margin-top: 20px;
}

.btn-signup:hover {
    background-color: #333;
    color: #fff;
}

.form-check {
    margin: 15px 0;
}

.form-check-label {
    color: #333;
}

.login-link {
    text-align: center;
    margin-top: 20px;
    color: #333;
}

.login-link a {
    color: #000;
    text-decoration: underline;
}

a:hover {
    color: #333;
}
</style>
@endpush
@push('scripts')
<!-- Form validation -->
<script>
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
<!-- Form validation -->
<script>
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');

        // Email validation function
        function validateEmail(email) {
            // Basic email format regex
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (!emailRegex.test(email)) {
                return "Please enter a valid email address";
            }

            // Check minimum length
            if (email.length < 5) {
                return "Email address is too short";
            }

            // Check for common invalid patterns
            if (email.includes('..') || email.includes('@@')) {
                return "Invalid email format";
            }

            return ""; // Return empty string if email is valid
        }

        // Password validation function
        function validatePassword(password) {
            // Minimum length check
            if (password.length < 8) {
                return "Password must be at least 8 characters long";
            }

            // Check for uppercase letter
            if (!/[A-Z]/.test(password)) {
                return "Password must contain at least one uppercase letter";
            }

            // Check for lowercase letter
            if (!/[a-z]/.test(password)) {
                return "Password must contain at least one lowercase letter";
            }

            // Check for number
            if (!/[0-9]/.test(password)) {
                return "Password must contain at least one number";
            }

            // Check for special character
            if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                return "Password must contain at least one special character";
            }

            return ""; // Return empty string if password is valid
        }

        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                // Email validation
                const email = document.querySelector('input[name="email"]').value;
                const emailError = validateEmail(email);

                if (emailError) {
                    event.preventDefault();
                    alert(emailError);
                    return false;
                }

                // Password validation
                const password = document.querySelector('input[name="password"]').value;
                const confirmPassword = document.querySelector(
                    'input[name="confirm_password"]').value;
                const passwordError = validatePassword(password);

                if (passwordError) {
                    event.preventDefault();
                    alert(passwordError);
                    return false;
                }

                // Check if passwords match
                if (password !== confirmPassword) {
                    event.preventDefault();
                    alert("Passwords do not match!");
                    return false;
                }

                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
@endpush