<?php
// Database connection — same credentials as lab09
$db = new mysqli('localhost', 'phpmyadmin', 'Oftheway13$', 'iit');

if ($db->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed.']);
    exit;
}
?>
