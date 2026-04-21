<?php
require_once 'includes/config.inc.php';

@$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($db->connect_error) {
   die('Connection failed: ' . $db->connect_error);
}

$query = 'SELECT firstNames, lastName, birth_year FROM actors WHERE birth_year >= 1965 ORDER BY lastName';
$result = $db->query($query);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="actors-born-1965-or-later.csv"');

$out = fopen('php://output', 'w');
fputcsv($out, array('First Name(s)', 'Last Name', 'Birth Year'));

while ($record = $result->fetch_assoc()) {
   fputcsv($out, array(
      $record['firstNames'],
      $record['lastName'],
      $record['birth_year']
   ));
}

fclose($out);
$db->close();
