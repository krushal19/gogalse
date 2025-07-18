<?php
require_once "db.php";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 3
    ]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get latest feedback
$feedbackStmt = $conn->query("SELECT name, message, created_at FROM feedback ORDER BY created_at DESC LIMIT 6");
$feedbacks = $feedbackStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GoGalse Optical - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f6f9;
        }
        .featured-img { height: 220px; object-fit: cover; }
        .feedback-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #ddd;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .feedback-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .feedback-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .about-optical { background-color: #1f3a52; color: white; }
        footer { background-color: #1f3a52; }
        footer a { color: #f0f6f9; text-decoration: none; }
        footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<?php include "head.php"; ?>

<!-- Product Slider -->
<div id="opticalCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/images/eyeglass1.jpg" class="d-block w-100" alt="Classic Eyeglasses" style="height:500px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block">
                <h3>Classic Eyeglasses</h3>
                <p>Elegant & timeless designs for everyday wear</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/images/sunglass1.jpg" class="d-block w-100" alt="Sport Sunglasses" style="height:500px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block">
                <h3>Sport Sunglasses</h3>
                <p>Protect your eyes in style during outdoor activities</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/images/eyeglass2.jpg" class="d-block w-100" alt="Blue Light Glasses" style="height:500px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block">
                <h3>Blue Light Glasses</h3>
                <p>Reduce eye strain from screens with trendy options</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/images/sunglass2.jpg" class="d-block w-100" alt="Fashion Sunglasses" style="height:500px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block">
                <h3>Fashion Sunglasses</h3>
                <p>Look chic while protecting your eyes from UV rays</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#opticalCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#opticalCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Featured Products -->
<section class="py-5" style="background-color: #ffffff;">
    <div class="container">
        <h2 class="text-center mb-4" style="color: #1f3a52;">Our Top Optical Picks</h2>
        <div class="row g-4">
            <?php
            $sampleProducts = [
                ["image" => "assets/images/eyeglass1.jpg", "name" => "Classic Eyeglasses", "price" => 129],
                ["image" => "assets/images/sunglass1.jpg", "name" => "Sport Sunglasses", "price" => 149],
                ["image" => "assets/images/eyeglass2.jpg", "name" => "Blue Light Glasses", "price" => 99],
                ["image" => "assets/images/sunglass2.jpg", "name" => "Fashion Sunglasses", "price" => 119],
                ["image" => "assets/images/reader.jpg", "name" => "Reading Glasses", "price" => 89],
                ["image" => "assets/images/lens.jpg", "name" => "Contact Lenses", "price" => 59],
                ["image" => "assets/images/sports.jpg", "name" => "Sports Glasses", "price" => 139],
                ["image" => "assets/images/kids.jpg", "name" => "Kids Eyewear", "price" => 79]
            ];
            foreach ($sampleProducts as $product): ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top featured-img" alt="<?= htmlspecialchars($product['name']) ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                            <p class="fw-bold text-primary">$<?= number_format($product['price'], 2) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5 about-optical">
    <div class="container">
        <h2 class="text-center mb-4">About GoGalse Optical</h2>
        <p class="text-center">At GoGalse Optical, we believe eyewear should be both functional and fashionable. From advanced lenses to modern frames, we focus on delivering premium quality and ultimate comfort. Our wide range includes prescription eyeglasses, sunglasses, readers, sports eyewear, and kids collections — so everyone can see clearly and look their best.</p>
    </div>
</section>

<!-- Feedback Section -->
<section class="py-5" style="background-color: #ffffff;">
    <div class="container">
        <h2 class="text-center mb-4" style="color: #1f3a52;">Customer Reviews</h2>
        <div class="row g-4">
            <?php if ($feedbacks): ?>
                <?php foreach ($feedbacks as $feedback): ?>
                    <div class="col-md-4">
                        <div class="feedback-card shadow-sm">
                            <div class="feedback-header">
                                <img src="assets/images/user-avatar.png" alt="User">
                                <div>
                                    <h6 class="mb-0"><?= htmlspecialchars($feedback['name']) ?></h6>
                                    <small class="text-muted"><?= date("F j, Y", strtotime($feedback['created_at'])) ?></small>
                                </div>
                            </div>
                            <p class="mt-2 flex-grow-1"><?= nl2br(htmlspecialchars($feedback['message'])) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">No feedback yet. Be the first to share your experience!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include "footar.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
