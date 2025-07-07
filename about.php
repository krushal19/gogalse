<?php
// about.php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - GoGalse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: rgb(4, 34, 65);
            font-family: 'Segoe UI', sans-serif;
        }

        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('assets/images/about-hero.jpg') no-repeat center center/cover;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .content-section {
            background: #ffffff;
            padding: 40px;
            margin-top: 50px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .content-section h2, .content-section h3 {
            margin-top: 20px;
        }

        .feature-list li {
            margin-bottom: 10px;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            margin-top: 60px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<?php include "head.php"; ?>

<!-- Hero Section -->
<div class="hero">
    <div class="container">
        <h1 class="display-4 fw-bold">About GoGalse</h1>
        <p class="lead">Empowering Local Sellers, Connecting Global Shoppers</p>
    </div>
</div>

<!-- Main Content Section -->
<div class="container">
    <div class="content-section">
        <div class="row">
            <div class="col-md-6 mb-4 mb-md-0">
                <h2>Our Story</h2>
                <p>
                    GoGalse was founded with the vision of creating a seamless online platform where sellers can showcase their unique products and buyers can find quality goods from all across the country.
                </p>
                <p>
                    Our mission is to support local businesses, promote hand-crafted excellence, and provide a trusted shopping experience.
                </p>
            </div>
            <div class="col-md-6">
                <img src="assets/images/about-hero.jpg" alt="About Image" class="img-fluid rounded shadow-sm">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <h3>Why Choose GoGalse?</h3>
                <ul class="feature-list list-unstyled">
                    <li><i class="fas fa-check-circle text-success me-2"></i> Wide variety of products across departments</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Easy-to-use platform for both customers and sellers</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Secure payment and user-friendly checkout</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Responsive customer support and transparent policies</li>
                </ul>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h3>Our Location</h3>
                <p><i class="fas fa-map-marker-alt text-primary me-2"></i>We are proudly based in <strong>Sardarvill, Bardoli, Surat, Gujarat, India</strong>. From here, we serve customers nationwide and soon, globally.</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <div class="container text-center">
        <p class="mb-0">&copy; <?= date("Y") ?> GoGalse. All rights reserved.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
