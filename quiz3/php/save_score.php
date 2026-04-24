<?php
header('Content-Type: application/json');
include('db.php');

$name  = trim($_POST['name']  ?? '');
$score = intval($_POST['score'] ?? 0);
$total = intval($_POST['total'] ?? 10);

if ($name === '') {
    echo json_encode(['error' => 'Player name is required.']);
    exit;
}

// WRITE: insert the player's score — prepared statement because name is user input
$stmt = $db->prepare('INSERT INTO quiz3_scores (player_name, score, total) VALUES (?, ?, ?)');
$stmt->bind_param('sii', $name, $score, $total);
$stmt->execute();
$stmt->close();

// READ: return top 10 scores for the leaderboard — no user input, no prepared statement needed
$result = $db->query(
    'SELECT player_name, score, total
     FROM quiz3_scores
     ORDER BY score DESC, played_at ASC
     LIMIT 10'
);

$leaderboard = [];
while ($row = $result->fetch_assoc()) {
    $leaderboard[] = $row;
}

$result->free();
$db->close();

echo json_encode(['success' => true, 'leaderboard' => $leaderboard]);
?>
