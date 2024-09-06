<?php
require_once 'db.php';

function verifyEmailChange(string $newEmail, string $activationCode): void
{
    $pdo = getDbConnection();
    
    $stmt = $pdo->prepare("SELECT * FROM activatenewemail WHERE newemail = :newemail AND verificationcode = :activationcode");
    $stmt->execute([
        'newemail' => $newEmail,
        'activationcode' => $activationCode
    ]);
    
    $verify = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$verify) {
        echo "Follow the activation link from your Old Email address!";
        return;
    }
    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM characters WHERE email = :email");
    $stmt->execute(['email' => $verify['newemail']]);
    
    if ($stmt->fetchColumn() > 0) {
        echo "Someone is already using this email address!";
        return;
    }
    
    $stmt = $pdo->prepare("UPDATE characters SET email = :newemail WHERE username = :username");
    $stmt->execute([
        'newemail' => $verify['newemail'],
        'username' => $verify['username']
    ]);
    
    $stmt = $pdo->prepare("DELETE FROM activatenewemail WHERE id = :id");
    $stmt->execute(['id' => $verify['id']]);
    
    echo "You have changed your email to {$verify['newemail']}";
}

// Usage
$newEmail = $_GET['nemail'] ?? '';
$activationCode = $_GET['activationcode'] ?? '';

if ($newEmail && $activationCode) {
    verifyEmailChange($newEmail, $activationCode);
} else {
    echo "Invalid or missing parameters.";
}
?>


//Here is db connection file script db.php
<?php
function getDbConnection(): PDO
{
    $host = 'localhost';
    $db   = 'your_database_name';
    $user = 'your_username';
    $pass = 'your_password';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
?>
