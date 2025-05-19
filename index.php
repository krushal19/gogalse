<?php
$host = "localhost";
$user = "root";
$password = ""; // default password is empty for XAMPP
$dbname = "gogalse"; // or whatever your local DB is

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GoGalse - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color:rgb(4, 34, 65);
            font-family: 'Segoe UI', sans-serif;
        }

        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('images/black.PNG') center/cover no-repeat;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .carousel-item {
    text-align: center;
    background-color: #f0f0f0;
}
.carousel-item img {
    max-height: 500px;
    width: auto;
    height: auto;
    object-fit: contain;
    margin: auto;
}


        .section-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .feature-icon {
            font-size: 3rem;
            color: #0d6efd;
        }

        .category-card i {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .testimonial {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 30px 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-store"></i> GoGalse</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="mainNav">
            <ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
    <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
    <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>

    <!-- Profile Dropdown -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle"></i> Profile
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
            <li><a class="dropdown-item" href="edit_profile.php">Edit Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
    </li>
</ul>

        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Welcome to GoGalse</h1>
        <p class="lead">Your trusted platform for buying and selling top-quality products.</p>
        <a href="shop.php" class="btn btn-primary btn-lg mt-3">Start Shopping</a>
    </div>
</section>

<!-- Image Carousel -->
<div class="container mt-5">
    <div id="mainSlider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/black.PNG" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="images/numimage.png" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="images/num3.png" class="d-block w-100" alt="Slide 3">
            </div>
            <div class="carousel-item">
                <img src="images/img4.png" class="d-block w-100" alt="Slide 4">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>
<div style="color: rgb(238, 240, 242);">
<!-- Features Section -->
<section class="container mt-5 text-center">
    <div class="row">
        <div class="col-md-4">
            <div class="feature-icon mb-3"><i class="fas fa-truck-fast"></i></div>
            <h5>Fast Delivery</h5>
            <p>Speedy shipping across the country at no extra cost.</p>
        </div>
        <div class="col-md-4">
            <div class="feature-icon mb-3"><i class="fas fa-thumbs-up"></i></div>
            <h5>Trusted Sellers</h5>
            <p>We verify all sellers for quality and service.</p>
        </div>
        <div class="col-md-4">
            <div class="feature-icon mb-3"><i class="fas fa-headset"></i></div>
            <h5>24/7 Support</h5>
            <p>Customer support that's always available when you need it.</p>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="container mt-5 text-center">
    <h2 class="section-title">Top Categories</h2>
    <div class="row">
        <div class="col-md-3 category-card">
            <i class="fas fa-tshirt text-primary"></i>
            <h6>Clothing</h6>
        </div>
        <div class="col-md-3 category-card">
            <i class="fas fa-laptop text-primary"></i>
            <h6>Electronics</h6>
        </div>
        <div class="col-md-3 category-card">
            <i class="fas fa-couch text-primary"></i>
            <h6>Home & Furniture</h6>
        </div>
        <div class="col-md-3 category-card">
            <i class="fas fa-gem text-primary"></i>
            <h6>Jewelry</h6>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="container mt-5">
    <h2 class="section-title text-center">What Our Customers Say</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="testimonial">
                <p style="color: black;">"Great experience shopping on GoGalse. The product arrived on time and in perfect condition!"</p>
                <small style="color: black;">- Priya Sharma</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="testimonial">
                <p style="color: black;">"Customer support was very helpful when I had questions. Highly recommend this site!"</p>
                <small style="color: black;">- Rahul Verma</small>
            </div>
        </div>
    </div>
</section>
    
<!-- Footer -->
<footer class="mt-5">
    <div class="container text-center">
        <p>&copy; <?= date("Y") ?> GoGalse. All rights reserved.</p>
    </div>
</footer>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
