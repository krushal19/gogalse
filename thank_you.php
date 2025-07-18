<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>Thank You!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap RTL CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />

  <style>
    * {
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      margin: 0;
      background-color: #002b49;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      flex-direction: column;
    }

    /* Header/navbar stays on top */
    header {
      flex-shrink: 0;
    }

    /* Footer sticks to the bottom */
    footer {
      flex-shrink: 0;
      background-color: #035b68;
      color: white;
      padding: 20px;
      text-align: center;
    }

    /* Main content grows and centers the thank box */
    main {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .thank-box {
      background-color: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      max-width: 450px;
      width: 100%;
      text-align: center;
      direction: ltr; /* Show English properly */
    }

    .thank-box h2 {
      color: #064860;
      margin-bottom: 15px;
    }

    .thank-box p {
      color: #555;
      font-size: 1rem;
    }

    .thank-box a {
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <!-- ✅ HEADER/NAVBAR -->
  <header>
    <?php include "head.php"; ?>
  </header>

  <!-- ✅ CENTERED THANK YOU CONTENT -->
  <main>
    <div class="thank-box">
      <h2>Thank You for Your 💙 Feedback!</h2>
      <p>We appreciate your input and will get back to you if needed.</p>
      <a href="shop.php" class="btn btn-primary w-100">Back to Shop</a>
    </div>
  </main>

  <!-- ✅ FOOTER -->
  <footer>
    <?php include "footar.php"; ?>
  </footer>

</body>
</html>
