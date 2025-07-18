<?php
session_start();

require_once "db.php"; // ✅ ADD THIS LINE to include DB configuration

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Fetch user details (username and email)
$stmt = $conn->prepare("SELECT username, email, phone FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? $user['email'];
    $phone = $_POST['phone'] ?? $user['phone'];

    $stmt = $conn->prepare("UPDATE users SET email = ?, phone = ? WHERE username = ?");
    $stmt->execute([$email, $phone, $username]);

    // Update session data
    $_SESSION['username'] = $username;
    $successMessage = "Profile updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GoGalse - Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

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

        .profile-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .profile-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            color: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            animation: fadeIn 1s ease;
        }

        .profile-box h2 {
            font-weight: 600;
            margin-bottom: 30px;
            color: #ffffff;
            text-align: center;
        }

        label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
        }

        .form-control::placeholder {
            color: #eee;
        }

        .form-control:focus {
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

        .edit-btn {
            background-color: #28a745;
            color: white;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-btn:hover {
            background-color: #218838;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

        <?php include "head.php"; ?>
        
    <div class="overlay"></div>
    <div class="profile-container">
        <div class="profile-box">
            <h2>Your Profile</h2>

            <?php if (isset($successMessage)): ?>
                <div class="alert alert-success text-center"><?= htmlspecialchars($successMessage) ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" readonly>
            </div>

            <div class="d-grid">
                <button class="edit-btn" onclick="showEditForm()">Edit Profile</button>
            </div>

            <form method="POST" action="" id="editForm" style="display:none; margin-top: 20px;">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>

            <p class="mt-4 text-center">
                <a href="index.php">Back to Home</a>
            </p>
        </div>
    </div>

    <script>
        function showEditForm() {
            document.getElementById('editForm').style.display = 'block';
            document.querySelector('.edit-btn').style.display = 'none';
        }
    </script>
    <!-- Footer -->
<?php include "footar.php"; ?>
</body>
</html>
