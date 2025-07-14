<?php
require_once "db.php"; // Make sure this file defines $conn
<?php include "head.php"; ?>

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect and sanitize inputs
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    // Simple validation
    if (!empty($name) && !empty($email) && !empty($message)) {
        try {
            // Insert into feedback table
            $stmt = $conn->prepare("INSERT INTO feedback (name, email, message, created_at) VALUES (:name, :email, :message, NOW())");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'message' => $message
            ]);

            // Redirect to a thank you page (you can create thank_you.php), or show a message
            header("Location: thank_you.php");
            exit;

        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
