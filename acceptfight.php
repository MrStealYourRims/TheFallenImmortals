<?php
session_name("icsession");
session_start();
require_once 'db.php';

$pdo = new PDO("mysql:host=localhost;dbname=your_database_name", "username", "password");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * FROM characters WHERE id = :userid");
$stmt->execute(['userid' => $_SESSION['userid']]);
$char = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM duelground WHERE tousername = :username");
$stmt->execute(['username' => $char['username']]);
$findDuel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$findDuel) {
    echo "alert('No duel to Accept.');";
} else {
    $date = time();
    $messagechat = "<strong><font color='#FF3300'>Duel accepted.... {$findDuel['fromusername']} starts the battle.</font></strong><br />";
    
    $stmt = $pdo->prepare("INSERT INTO chatroom (date, userlevel, username, message, `to`) VALUES (:date, :userlevel, :username, :message, :to)");
    $stmt->execute([
        'date' => $date,
        'userlevel' => 4,
        'username' => 'PM',
        'message' => $messagechat,
        'to' => $findDuel['tousername']
    ]);

    if ($char['posx'] != "25" || $char['posy'] != "25") {
        echo "alert('You have been appointed to the Duel Ground.');";
        $stmt = $pdo->prepare("UPDATE characters SET posx = '25', posy = '25' WHERE username = :username");
        $stmt->execute(['username' => $char['username']]);
    }
    
    $messagechat = "<strong><font color='#FF3300'>{$char['username']} has accepted your duel! <a href='javascript: attackFight();'>Attack</a>!</font></strong><br />";
    
    $stmt = $pdo->prepare("INSERT INTO chatroom (date, userlevel, username, message, `to`) VALUES (:date, :userlevel, :username, :message, :to)");
    $stmt->execute([
        'date' => $date,
        'userlevel' => 4,
        'username' => 'PM',
        'message' => $messagechat,
        'to' => $findDuel['fromusername']
    ]);

    $stmt = $pdo->prepare("UPDATE duelground SET status = 'Started', time = :date WHERE id = :id");
    $stmt->execute([
        'date' => $date,
        'id' => $findDuel['id']
    ]);
}

require_once 'updatestats.php';
?>
