<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f9fb;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .thank-box {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        .thank-box h2 {
            color: #064860;
        }
        .thank-box p {
            color: #555;
        }
    </style>
</head>
<body>
    <?php include "head.php"; ?>

<div class="thank-box">
    <h2>Thank You for Your Feedback! 💙</h2>
    <p>We appreciate your input and will get back to you if needed.</p>
    <a href="shop.php" class="btn btn-primary mt-3">Back to Shop</a>
</div>

<?php include "footar.php"; ?>
</body>
</html>
