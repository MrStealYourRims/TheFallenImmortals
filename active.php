<?php
$active = time();

// Using PDO for database operations
try {
    $pdo = new PDO("mysql:host=localhost;dbname=your_database", "username", "password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("UPDATE characters SET lastactive = :active WHERE id = :userid");
    $stmt->execute([
        ':active' => $active,
        ':userid' => $_SESSION['userid']
    ]);
} catch (PDOException $e) {
    // Handle the error appropriately
    error_log("Database error: " . $e->getMessage());
}
?>
