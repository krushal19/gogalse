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
        body { background-color: rgb(4, 34, 65); font-family: 'Segoe UI', sans-serif; }
        .hero { background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('images/black.PNG') center/cover no-repeat; color: white; padding: 100px 0; text-align: center; }
        .hero h1 { font-size: 3rem; font-weight: bold; }
        .carousel-item { text-align: center; background-color: #f0f0f0; }
        .carousel-item img { max-height: 500px; object-fit: contain; margin: auto; }
        .section-title { font-size: 2rem; font-weight: bold; margin-bottom: 20px; }
        .feature-icon { font-size: 3rem; color: #0d6efd; }
        .category-card i { font-size: 2.5rem; margin-bottom: 10px; }
        .testimonial { background-color: white; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        footer { background-color: #343a40; color: white; padding: 30px 0; }
    </style>
</head>
<body>
<!-- Navbar -->
 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

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