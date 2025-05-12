<?php
// contact.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - GoGalse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .contact-container {
            max-width: 700px;
            margin: 60px auto;
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 80px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #198754;
        }
        .ratio iframe {
            border-radius: 10px;
        }
    </style>
</head>
<body style="background-color:rgb(8, 87, 101);">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">GoGalse</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="shop.php" class="nav-link">Shop</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link active">Contact</a></li>
                <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contact Form -->
<div class="container">
    <div class="contact-container">
        <h2 class="mb-4 text-center text-success">Contact Us</h2>
        <form method="POST" action="#">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Your full name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
            </div>
            <button type="submit" class="btn btn-success w-100">Send Message</button>
        </form>
    </div>
</div>

<!-- Google Map -->
<div class="container mt-5">
    <h5 class="text-center mb-3">Our Location: Bardoli, Sardarvill, Gujarat, India</h5>
    <div class="ratio ratio-16x9">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3706.2781082976317!2d73.10872757515818!3d21.128943480540986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be062084f3d8f95%3A0x6214fce83a8652cf!2sSardarvill%2C%20Bardoli%2C%20Gujarat%20394750%2C%20India!5e0!3m2!1sen!2sin!4v1715081816615"
            allowfullscreen="" loading="lazy">
        </iframe>
    </div>
</div>

<!-- Footer -->
<footer>
    <div class="container">
        <p class="mb-0">&copy; <?= date("Y") ?> GoGalse. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
