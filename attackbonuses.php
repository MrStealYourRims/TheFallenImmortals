<?php
declare(strict_types=1);

function calculateStats(array $char, PDO $pdo): array {
    $stats = [
        'strength' => $char['strength'] ?? 0,
        'dexterity' => $char['dexterity'] ?? 0,
        'endurance' => $char['endurance'] ?? 0,
        'intelligence' => $char['intelligence'] ?? 0,
        'concentration' => $char['concentration'] ?? 0,
    ];

    // Calculate equipment bonuses
    $stmt = $pdo->prepare("SELECT * FROM inventory WHERE username = :username AND equipped = 'Yes'");
    $stmt->execute(['username' => $char['username']]);
    while ($mod = $stmt->fetch(PDO::FETCH_ASSOC)) {
        foreach ($stats as $stat => &$value) {
            if ($mod[$stat] > 0) {
                $value = floor($value + $mod[$stat]);
            }
        }
    }

    // Calculate affinity bonuses
    $blessings = explode(', ', $char['blessing']);
    $affinityCount = $char['affinitys'] ?? 0;

    for ($i = 0; $i < $affinityCount && $i < count($blessings); $i++) {
        $blessing = $blessings[$i];
        $stmt = $pdo->prepare("SELECT * FROM affinity WHERE name = :name");
        $stmt->execute(['name' => $blessing]);
        $level = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($level) {
            $multiplier = 1 + ($level['level'] / 10);
            $statMap = [
                'Might' => 'strength',
                'Speed' => 'dexterity',
                'Constitution' => 'endurance',
                'Concentration' => 'concentration',
                'Intelligence' => 'intelligence'
            ];

            foreach ($statMap as $affinityName => $statName) {
                if (str_starts_with($blessing, $affinityName)) {
                    $stats[$statName] *= $multiplier;
                    break;
                }
            }
        }
    }

    // Round all stats to integers
    foreach ($stats as &$value) {
        $value = (int)round($value);
    }

    return $stats;
}

// Usage example:
// $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
// $char = [/* character data */];
// $updatedStats = calculateStats($char, $pdo);
?>
