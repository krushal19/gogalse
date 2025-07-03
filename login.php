<?php
session_start();

// Include the database connection
require_once 'db.php'; // This should return $conn

$error = "";

// CSRF token generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token. Please refresh the page and try again.");  
    }

    $username = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if (!empty($username) && !empty($pass) && !empty($role)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
        $stmt->execute([$username, $role]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pass, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $user['id']; 

            if ($role === 'customer') {
                header("Location: index.php");
                exit;
            }
            elseif ($role === 'seller') {
                header("Location: seller.php");
                exit;
            }
        }

        else {
            $error = "Invalid login credentials!";
        }
    } 
    else {
        $error = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GoGalse - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: url('images/gogalse.png') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            height: 100%;
            width: 100%;
            z-index: -1;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            color: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            animation: fadeIn 1s ease;
        }

        .login-box h2 {
            font-weight: 600;
            margin-bottom: 30px;
            color: #ffffff;
            text-align: center;
        }

        label {
            font-weight: 500;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
        }

        .form-control::placeholder {
            color: #eee;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: rgba(255, 255, 255, 0.3);
            color: #fff;
            box-shadow: none;
        }

        .btn-primary {
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 500;
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert {
            font-size: 0.95rem;
        }

        a {
            color: #a5d8ff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="login-container">
        <div class="login-box">
            <h2>Welcome to GoGalse</h2>

            <?php if (!empty($_GET['registered'])): ?>
                <div class="alert alert-success text-center">Registration successful! Please log in.</div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Login as</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Select Role --</option>
                        <option value="customer">Customer</option>
                        <option value="seller">Seller</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>

            <p class="mt-4 text-center">
                Don't have an account? <a href="register.php">Register here</a>.
            </p>
        </div>
    </div>
</body>
</html>
