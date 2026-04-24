<?php
// BROKEN COPY — SQL injection vulnerable
header('Content-Type: application/json');
include('../php/db.php');

$name  = trim($_POST['name']  ?? '');
$score = intval($_POST['score'] ?? 0);
$total = intval($_POST['total'] ?? 10);

if ($name === '') {
    echo json_encode(['error' => 'Player name is required.']);
    exit;
}

// VULNERABLE: name is dropped directly into the query string
$query = "INSERT INTO quiz3_scores (player_name, score, total) VALUES ('" . $name . "', " . $score . ", " . $total . ")";
$db->query($query);

$result = $db->query('SELECT player_name, score, total FROM quiz3_scores ORDER BY score DESC, played_at ASC LIMIT 10');
$leaderboard = [];
while ($row = $result->fetch_assoc()) {
    $leaderboard[] = $row;
}
$result->free();
$db->close();

echo json_encode(['success' => true, 'leaderboard' => $leaderboard]);
?>
