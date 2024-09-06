<?php
require_once 'db.php';

function activateAccount(PDO $pdo, string $key): ?array {
    $stmt = $pdo->prepare("SELECT * FROM activation WHERE `key` = :key");
    $stmt->execute(['key' => $key]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteActivationKey(PDO $pdo, string $key): void {
    $stmt = $pdo->prepare("DELETE FROM activation WHERE `key` = :key");
    $stmt->execute(['key' => $key]);
}

function activateCharacter(PDO $pdo, string $username): void {
    $stmt = $pdo->prepare("UPDATE characters SET activated = 'Yes' WHERE username = :username");
    $stmt->execute(['username' => $username]);
}

$message = "Cannot find Activation Key. Please follow the link sent to your email address.";

if (isset($_GET['key']) && !empty($_GET['key'])) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=your_database_name", "username", "password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $key = activateAccount($pdo, $_GET['key']);

        if ($key) {
            $message = "The account, {$key['username']} has now been activated. You may now start playing immediately.<br /><a href='index.php'>Login Here</a>";
            deleteActivationKey($pdo, $_GET['key']);
            activateCharacter($pdo, $key['username']);
        } else {
            $message = "This Activation Key cannot be found. Please follow the link sent to your email address.";
        }
    } catch (PDOException $e) {
        $message = "An error occurred: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rise Of Immortals ~ Activation</title>
    <link href="main.css" rel="stylesheet" type="text/css">
</head>
<body>
    <center><?= htmlspecialchars($message) ?></center>
</body>
</html>
