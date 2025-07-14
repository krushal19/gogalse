<!-- Footer -->
<footer style="background-color: #064860; color: rgba(255, 255, 255, 0.9); padding: 30px 0;">
  <div class="container">
    <div class="row">
      <!-- About -->
      <div class="col-md-3 mb-4">
        <h5 class="text-uppercase">GoGalse</h5>
        <p>Your trusted online eyewear and accessories shop. Explore frames, lenses, and more from top brands.</p>
      </div>

      <!-- Quick Links -->
      <div class="col-md-3 mb-4">
        <h5 class="text-uppercase">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="shop.php" style="color: rgba(255, 255, 255, 0.8); text-decoration: none;">Shop</a></li>
          <li><a href="cart.php" style="color: rgba(255, 255, 255, 0.8); text-decoration: none;">Cart</a></li>
          <li><a href="contact.php" style="color: rgba(255, 255, 255, 0.8); text-decoration: none;">Contact</a></li>
          <li><a href="#" style="color: rgba(255, 255, 255, 0.8); text-decoration: none;">About Us</a></li>
        </ul>
      </div>

      <!-- Follow Us -->
      <div class="col-md-3 mb-4">
        <h5 class="text-uppercase">Follow Us</h5>
        <a href="#" class="me-2" style="color: rgba(255, 255, 255, 0.8);"><i class="bi bi-facebook"></i> Facebook</a><br>
        <a href="#" class="me-2" style="color: rgba(255, 255, 255, 0.8);"><i class="bi bi-instagram"></i> Instagram</a><br>
        <a href="#" class="me-2" style="color: rgba(255, 255, 255, 0.8);"><i class="bi bi-twitter"></i> Twitter</a>
      </div>

      <!-- Feedback Form -->
      <div class="col-md-3 mb-4">
        <h5 class="text-uppercase">Feedback</h5>
        <form method="POST" action="save_feedback.php">
          <div class="mb-2">
            <input type="text" name="name" class="form-control form-control-sm" placeholder="Your name" required>
          </div>
          <div class="mb-2">
            <input type="email" name="email" class="form-control form-control-sm" placeholder="Your email" required>
          </div>
          <div class="mb-2">
            <textarea name="message" class="form-control form-control-sm" rows="2" placeholder="Your feedback" required></textarea>
          </div>
          <button type="submit" class="btn btn-sm btn-light">Send</button>
        </form>
      </div>
    </div>

    <hr style="border-top: 1px solid rgba(255, 255, 255, 0.2);">

    <div class="text-center">
      &copy; 2025 GoGalse. All rights reserved.
    </div>
  </div>
</footer>

<!-- Bootstrap icons (if not already included) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
