<?php
header('Content-Type: application/json');
include('db.php');

// No user input in this query — no prepared statement required
$result = $db->query(
    'SELECT id, question, correct_answer, wrong1, wrong2, wrong3
     FROM quiz3_questions
     ORDER BY RAND()
     LIMIT 10'
);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

$result->free();
$db->close();

echo json_encode($questions);
?>
