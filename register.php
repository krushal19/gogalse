<?php
session_start();

// CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['csrf_token'] === $_SESSION['csrf_token']) {
        $username = $_POST['username'];
        $email    = $_POST['email'];
        $phone    = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // encrypted
        $role     = $_POST['role'];

        // Insert user
        $stmt = $pdo->prepare("INSERT INTO users (username, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$username, $email, $phone, $password, $role])) {
            header("Location: register.php?registered=1");
            exit();
        } else {
            $error = "Registration failed.";
        }
    } else {
        $error = "Invalid CSRF token.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - JK Shopping</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
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
        .register-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .register-box {
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
        .register-box h2 {
            font-weight: 600;
            margin-bottom: 30px;
            color: #ffffff;
            text-align: center;
        }
        label {
            font-weight: 500;
        }
        .form-control, .form-select {
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
        }
        .form-control::placeholder {
            color: #eee;
        }
        .form-control:focus, .form-select:focus {
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
<div class="register-container">
    <div class="register-box">
        <h2>Register to GoGalse</h2>

        <?php if (!empty($_GET['registered'])): ?>
            <div class="alert alert-success text-center">Registration successful! Please log in.</div>
        <?php elseif (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Select Role:</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="">-- Select Role --</option>
                    <option value="customer">Customer</option>
                    <option value="seller">Seller</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <div class="login-link text-center mt-3">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</div>
</body>
</html>
