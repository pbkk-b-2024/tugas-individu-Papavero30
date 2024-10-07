<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Our Restaurant</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: url('https://img.freepik.com/free-photo/close-up-delicious-fast-food-meal_23-2149303576.jpg?size=626&ext=jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            text-align: center;
            overflow: hidden;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        .content {
            position: relative;
            z-index: 2;
            animation: fadeIn 2s ease-in-out;
        }
        .btn-custom {
            margin: 10px;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 50px;
            transition: transform 0.3s;
        }
        .btn-custom:hover {
            transform: scale(1.1);
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="content">
        <h1 class="display-4 mb-4">Welcome To Our Kantin Gymbro!</h1>
        <p class="lead mb-5">Delicious food and beverages low calorie and high protein awaits you!</p>
        <div>
            <a href="{{ route('login') }}" class="btn btn-primary btn-custom"><i class="fas fa-sign-in-alt"></i> Login</a>
            <a href="{{ route('register') }}" class="btn btn-success btn-custom"><i class="fas fa-user-plus"></i> Register</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS for Animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-custom');
            buttons.forEach(button => {
                button.addEventListener('mouseover', () => {
                    button.style.transform = 'scale(1.1)';
                });
                button.addEventListener('mouseout', () => {
                    button.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>