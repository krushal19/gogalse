<?php
require_once "db.php"; // Ensure $conn is properly set in db.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect and sanitize inputs
    $name = trim(htmlspecialchars($_POST['name'] ?? ''));
    $email = trim(htmlspecialchars($_POST['email'] ?? ''));
    $message = trim(htmlspecialchars($_POST['message'] ?? ''));

    // Basic validation
    if (!empty($name) && !empty($email) && !empty($message)) {
        try {
            // Prepare and execute insert query
            $stmt = $conn->prepare("INSERT INTO feedback (name, email, message, created_at) VALUES (:name, :email, :message, NOW())");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':message' => $message
            ]);

            // Redirect to thank you page
            header("Location: thank_you.php");
            exit;

        } catch (PDOException $e) {
            echo "<p style='color: red;'>❌ Error saving feedback: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ All fields are required. Please fill in all fields.</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Invalid request method.</p>";
}
?>

<!-- Footer -->
<?php include "footar.php"; ?>
