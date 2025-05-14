<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GoGalse - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Carousel Image Style */
    .carousel-item img {
        height: 500px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    /* Product Image Style */
    .card-img-top {
    width: 100%;
    height: 250px;
    object-fit: contain; /* or 'cover' depending on your goal */
    background-color: #f8f9fa; /* Optional: background for empty space if using 'contain' */
    padding: 10px; /* Optional: breathing room around images */
    border-radius: 8px 8px 0 0;
}


    .card-img-top:hover {
        transform: scale(1.05);
    }

    .card {
        border: none;
        border-radius: 0.5rem;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .testimonial {
        background-color: #f8f9fa;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        text-align: center;
    }

    footer {
        background: #212529;
        color: #ccc;
        padding: 2rem 0;
    }
    #footar_slider {
    margin: 40px auto;
    max-width: 1000px;
    padding: 0 15px;
}

#mainCarousel {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
}

#mainCarousel .carousel-inner img {
    height: 500px;
    width: 100%;
    object-fit: contain;
    background-color: rgb(8, 87, 101);
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.carousel-control-prev,
.carousel-control-next {
    width: 5%;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    background-size: 50%, 50%;
    padding: 10px;
}

</style>

</head>
<body style="background-color:rgb(22, 122, 140);">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">GoGalse</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarLinks">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarLinks">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="index.php" class="nav-link active">Index</a></li>
                <li class="nav-item"><a href="shop.php?type=GoGalse" class="nav-link">Shop</a></li>
                <li class="nav-item"><a href="cart.php" class="nav-link">Cart</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Slider -->
<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/home2.jpg" class="d-block w-100" alt="GoGalse Banner 1"
                 style="height: 500px; width: 100%; object-fit: contain; background-color:rgb(8, 87, 101); border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);">
        </div>
        <div class="carousel-item">
            <img src="images/home3.jpg" class="d-block w-100" alt="GoGalse Banner 2"
                 style="height: 500px; width: 100%; object-fit: contain; background-color:rgb(8, 87, 101); border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);">
        </div>
        <div class="carousel-item">
            <img src="images/home4.jpg" class="d-block w-100" alt="GoGalse Banner 3"
                 style="height: 500px; width: 100%; object-fit: contain; background-color:rgb(8, 87, 101); border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- GoGalse Category Block -->
<section class="container my-5 text-center" style="background-color:rgb(22, 122, 140); color:rgba(216, 220, 221, 0.92);">
    <h2 class="mb-4">GoGalse Collection</h2>
</section>
<div class="text-center" style="background-color:rgb(22, 122, 140);">
    <a href="shop.php?type=GoGalse" class="btn btn-lg btn-info" style="background-color:rgb(7, 72, 85); color:rgba(216, 220, 221, 0.92);">
        Shop GoGalse Products  
    </a>
</div>


<!-- Products Section -->
<section class="container my-5">
    <h2 class="text-center mb-4" style="color:rgba(216, 220, 221, 0.92);">Latest GoGalse Products</h2>
    <div class="row g-4">
        <?php foreach ($products as $product): ?>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="card-text"><?= substr(htmlspecialchars($product['description']), 0, 60) ?>...</p>
                        <p class="fw-bold text-success">$<?= number_format($product['price'], 2) ?></p>
                        <a href="shop.php?type=GoGalse" class="btn btn-outline-primary btn-sm">View Product</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Testimonials Section -->
<section class="container my-5">
    <h2 class="text-center mb-4" style="color:rgba(216, 220, 221, 0.92);">What Our Users Say</h2>
    <br>
    <div class="row text-center g-4" style="background-color:rgb(22, 122, 140);">
        <div class="col-md-4" style="background-color:rgb(22, 122, 140);">
            <div class="testimonial" style="background-color:rgba(3, 58, 72, 0.9);">
                <p style="color:rgba(216, 220, 221, 0.92);">"GoGalse products are amazing. I love the style and the quality!"</p>
                <strong style="color:rgba(216, 220, 221, 0.92);">– Priya S.</strong>
            </div>
        </div>
        <div class="col-md-4" style="background-color:rgb(22, 122, 140);">
            <div class="testimonial" style="background-color:rgba(3, 58, 72, 0.9);">
                <p style="color:rgba(216, 220, 221, 0.92);">"Fast delivery and top-notch customer service. Highly recommend GoGalse."</p>
                <strong style="color:rgba(216, 220, 221, 0.92);">– Ramesh P.</strong>
            </div>
        </div>
        <div class="col-md-4" style="background-color:rgb(22, 122, 140);">
            <div class="testimonial" style="background-color:rgba(3, 58, 72, 0.9);">
                <p style="color:rgba(216, 220, 221, 0.92);">"I'm impressed with the product durability and design. Will buy again!"</p>
                <strong style="color:rgba(216, 220, 221, 0.92);">– Anjali M.</strong>
            </div>
            <br>
        </div>
    </div>
</section>


<!-- Slider -->

 <div class="footar-slider">
<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/home2.jpg" class="d-block w-100" alt="GoGalse Banner 1"
                 style="height: 500px; width: 100%; object-fit: contain; background-color:rgb(8, 87, 101); border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);">
        </div>
        <div class="carousel-item">
            <img src="images/home3.jpg" class="d-block w-100" alt="GoGalse Banner 2"
                 style="height: 500px; width: 100%; object-fit: contain; background-color:rgb(8, 87, 101); border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);">
        </div>
        <div class="carousel-item">
            <img src="images/home4.jpg" class="d-block w-100" alt="GoGalse Banner 3"
                 style="height: 500px; width: 100%; object-fit: contain; background-color:rgb(8, 87, 101); border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
</div>

<!-- Footer -->
<footer class="text-center">
    <div class="container">
        <p class="mb-1">&copy; <?= date("Y") ?> GoGalse. All rights reserved.</p>
        <small>Designed for performance and simplicity.</small>
    </div>
</footer>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
