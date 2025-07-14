
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="color: #ffffff;">
    
<!-- Navbar -->
<?php include "head.php"; ?>
<?php
require_once "db.php";

// Connect
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $address = trim($_POST['address'] ?? '');
    $gmail = $_POST['gmail'] ?? '';
    $left_lens_number = $_POST['left_lens_number'] ?? '';
    $right_lens_number = $_POST['right_lens_number'] ?? '';
    $selected_frame_id = $_POST['selected_frame_id'] ?? '';
    $selected_frame_name = $_POST['selected_frame_name'] ?? '';
    $notes = $_POST['notes'] ?? '';

    // Calculate total (frame price only here)
    $total = 0;
    if (!empty($selected_frame_id)) {
        $stmt = $conn->prepare("SELECT price FROM products WHERE id = :id");
        $stmt->execute(['id' => $selected_frame_id]);
        $frame = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($frame) {
            $total += $frame['price'];
        }
    }

    // Insert into recover table
    $stmt = $conn->prepare("INSERT INTO recover (username, mobile, address, gmail, left_lens_number, right_lens_number, frame_id, frame_name, total, notes) 
                            VALUES (:username, :mobile, :address, :gmail, :left_lens_number, :right_lens_number, :frame_id, :frame_name, :total, :notes)");
    $stmt->execute([
        'username' => $username,
        'mobile' => $mobile,
        'address' => $address,
        'gmail' => $gmail,
        'left_lens_number' => $left_lens_number,
        'right_lens_number' => $right_lens_number,
        'frame_id' => $selected_frame_id,
        'frame_name' => $selected_frame_name,
        'total' => $total,
        'notes' => $notes
    ]);

    // Find nearby shop
    $shopStmt = $conn->query("SELECT * FROM shops");
    $shops = $shopStmt->fetchAll(PDO::FETCH_ASSOC);

    $selectedShop = null;
    foreach ($shops as $shop) {
        if (stripos($address, $shop['address']) !== false) {
            $selectedShop = $shop;
            break;
        }
    }

    if (!$selectedShop) {
        // Default shop if no match
        $selectedShop = [
            'shop_name' => 'Main Gogalse Shop',
            'address' => 'Main Road, City Center, YourCity',
            'email' => 'mainshop@example.com'
        ];
    }

    // -----------------------
    // Send email to shop
    // -----------------------
    $toShop = $selectedShop['email'];
    $subjectShop = "New Recovery Order from $username";
    $messageShop = "New user recovery request:\n\n"
        . "User Name: $username\n"
        . "Mobile: $mobile\n"
        . "Address: $address\n"
        . "Gmail: $gmail\n"
        . "Left Lens: $left_lens_number\n"
        . "Right Lens: $right_lens_number\n"
        . "Frame: $selected_frame_name\n"
        . "Total: $total\n"
        . "Notes: $notes";
    $headersShop = "From: noreply@gogalse.com";

    @mail($toShop, $subjectShop, $messageShop, $headersShop);

    // -----------------------
    // Send email to user
    // -----------------------
    $toUser = $gmail;
    $subjectUser = "Your Order Details & Nearby Shop Information";
    $messageUser = "Hello $username,\n\n"
        . "Thank you for your recovery request!\n"
        . "Our nearby shop will process your order.\n\n"
        . "Shop Name: " . $selectedShop['shop_name'] . "\n"
        . "Shop Address: " . $selectedShop['address'] . "\n\n"
        . "You can contact the shop or visit to collect your order.\n\n"
        . "Thank you,\nGogalse Team";
    $headersUser = "From: noreply@gogalse.com";

    @mail($toUser, $subjectUser, $messageUser, $headersUser);

    echo "<h3 style='color:green; text-align:center;'>✅ Your request has been submitted successfully!</h3>";
    echo "<p style='text-align:center;'>Nearby Shop: <b>" . htmlspecialchars($selectedShop['shop_name']) . "</b><br>Address: <b>" . htmlspecialchars($selectedShop['address']) . "</b></p>";
    echo "<p style='text-align:center;'>We have also emailed this shop information to your email: <b>" . htmlspecialchars($gmail) . "</b></p>";
    echo "<p style='text-align:center;'><a href='recover.php'>Go back to Recover Page</a></p>";
} else {
    echo "<h3 style='color:red; text-align:center;'>Invalid request. Please submit the form properly.</h3>";
}
?>
</body>
</html>