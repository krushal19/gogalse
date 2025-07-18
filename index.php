<?php
// Import database connection
include 'db.php';

// Now $conn is available from db.php and ready to use
?>


<?php include "head.php"; ?>

<!-- Hero section -->
<section class="hero">
    <div class="container">
        <h1>Welcome to GoGalse</h1>
        <p class="lead">Your trusted platform for buying and selling top-quality products.</p>
        <a href="shop.php" class="btn btn-primary btn-lg mt-3">Start Shopping</a>
    </div>
</section>

<!-- Image carousel -->
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
    <!-- Features -->
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

    <!-- Categories -->
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

    <!-- Testimonials -->
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
</div>

<!-- Footer -->
<?php include "footar.php"; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
