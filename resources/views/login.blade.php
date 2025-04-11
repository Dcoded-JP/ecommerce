@extends('layouts.master')

@section('content')

<section>
<div class="container">
        <h1 class="page-title">Login to Your Account</h1>
        
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="login-form-container">
            <form method="POST" action="{{ route('processLogin') }}" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            <div class="forgot-password">
                                <a href="forgot-password.php">Forgot Password?</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-login">Login</button>
                    </div>
                    <div class="col-12">
                        <div class="signup-link">
                            Don't have an account? <a href="{{ route('signup') }}">Sign Up</a>
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
        .login-form-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 40px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
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
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }
        .btn-login {
            background-color: #000;
            color: #fff;
            height: 45px;
            border-radius: 5px;
            font-weight: 600;
            width: 100%;
            margin-top: 20px;
        }
        .btn-login:hover {
            background-color: #333;
            color: #fff;
        }
        .signup-link {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        .signup-link a {
            color: #000;
            text-decoration: underline;
        }
        a:hover {
            color: #333;
        }
        .forgot-password {
            text-align: right;
            margin-top: 5px;
        }
        .forgot-password a {
            color: #666;
            font-size: 14px;
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
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
@endpush


