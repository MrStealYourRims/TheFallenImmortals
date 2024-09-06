<?php
declare(strict_types=1);

session_name("icsession");
session_start();

require_once 'db.php';
require_once 'varset.php';

const GUILD_JOIN_COST = 1_000_000;
const MAX_GUILD_MEMBERS = 10;

function handleGuildApplication(PDO $pdo, int $userId, string $charName, int $charGold, string $guildName): string
{
    if ($charGold < GUILD_JOIN_COST) {
        return "<font color='#FF0000'>You do not have the " . number_format(GUILD_JOIN_COST) . " Gold required to join a Guild.</font>";
    }

    $stmt = $pdo->prepare("SELECT * FROM guilds WHERE id = :guildName");
    $stmt->execute(['guildName' => $guildName]);
    $guild = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$guild) {
        return "<font color='#FF0000'>This Guild does not exist.</font>";
    }

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM characters WHERE guild = :guildName");
    $stmt->execute(['guildName' => $guild['name']]);
    $members = $stmt->fetchColumn();

    if ($guild['recruiting'] !== "Yes" || $members >= MAX_GUILD_MEMBERS) {
        return "<font color='#FF0000'>{$guild['name']} is not currently recruiting.</font>";
    }

    $newGold = $charGold - GUILD_JOIN_COST;

    if ($guild['accept'] === "Approve") {
        $stmt = $pdo->prepare("INSERT INTO applications (guild, username) VALUES (:guild, :username)");
        $stmt->execute(['guild' => $guild['name'], 'username' => $charName]);
        $pdo->prepare("UPDATE characters SET gold = :newGold WHERE id = :userId")
            ->execute(['newGold' => $newGold, 'userId' => $userId]);
        return "<font color='#00FF00'>You have sent your application to {$guild['name']}.</font><br />";
    } elseif ($guild['accept'] === "Auto") {
        $pdo->prepare("UPDATE characters SET gold = :newGold, guild = :guildName WHERE id = :userId")
            ->execute(['newGold' => $newGold, 'guildName' => $guild['name'], 'userId' => $userId]);
        return "<center><font color='#00FF00'>Your application for {$guild['name']} has been automatically approved.</font><br />" .
               "<a href='javascript: viewGuild();'>Click Here</a> to go to {$guild['name']}'s Guild Portal.</center>";
    }

    return "<font color='#FF0000'>An error occurred processing your application.</font>";
}

$pdo = new PDO("mysql:host=localhost;dbname=your_database", "username", "password");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = handleGuildApplication(
    $pdo,
    $_SESSION['userid'] ?? 0,
    $charname ?? '',
    $chargold ?? 0,
    $_POST['guildname'] ?? ''
);

echo "fillDiv('guildinfo', " . json_encode($data) . ");";
