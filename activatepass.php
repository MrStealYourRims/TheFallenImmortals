<?php
declare(strict_types=1);

require_once 'db.php';

function changePassword(PDO $pdo, string $username, string $activationCode): string
{
    $stmt = $pdo->prepare("SELECT * FROM activatenewpassword WHERE username = :username AND verificationcode = :code");
    $stmt->execute(['username' => $username, 'code' => $activationCode]);
    $verify = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$verify) {
        return "Follow the activation link from your Email address!";
    }

    $stmt = $pdo->prepare("UPDATE characters SET password = :password WHERE username = :username");
    $stmt->execute(['password' => $verify['newpassword'], 'username' => $verify['username']]);

    $stmt = $pdo->prepare("DELETE FROM activatenewpassword WHERE id = :id");
    $stmt->execute(['id' => $verify['id']]);

    return "You have changed your password!";
}

// Usage
try {
    $pdo = new PDO("mysql:host=localhost;dbname=your_database", "username", "password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = $_GET['username'] ?? '';
    $activationCode = $_GET['activationcode'] ?? '';

    if (empty($username) || empty($activationCode)) {
        throw new InvalidArgumentException("Username and activation code are required.");
    }

    $result = changePassword($pdo, $username, $activationCode);
    echo $result;
} catch (PDOException $e) {
    // Log the error and display a generic message
    error_log("Database error: " . $e->getMessage());
    echo "An error occurred. Please try again later.";
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    // Log the error and display a generic message
    error_log("Unexpected error: " . $e->getMessage());
    echo "An unexpected error occurred. Please try again later.";
}
?>
