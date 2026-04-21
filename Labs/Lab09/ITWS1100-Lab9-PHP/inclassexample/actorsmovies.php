<?php
include('includes/init.inc.php');
include('includes/functions.inc.php');
?>
<title>PHP &amp; MySQL - ITWS</title>

<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>

<?php include('includes/menubody.inc.php'); ?>

<?php
$dbOk = false;

require_once 'includes/config.inc.php';

@$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($db->connect_error) {
   echo '<div class="messages">Could not connect to the database. Error: ';
   echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
   $dbOk = true;
}
?>

<h3>Actors &amp; Movies</h3>
<table id="actorTable">
   <?php
   if ($dbOk) {
      $query = 'SELECT m.title, m.year, a.firstNames, a.lastName
                FROM movies m
                JOIN movie_actors ma ON m.movieid = ma.movie_id
                JOIN actors a ON ma.actor_id = a.id
                ORDER BY m.title';
      $result = $db->query($query);
      $numRecords = $result->num_rows;

      echo '<tr><th>Movie:</th><th>Year:</th><th>Actor:</th></tr>';
      for ($i = 0; $i < $numRecords; $i++) {
         $record = $result->fetch_assoc();
         if ($i % 2 == 0) {
            echo "\n" . '<tr><td>';
         } else {
            echo "\n" . '<tr class="odd"><td>';
         }
         echo htmlspecialchars($record['title']);
         echo '</td><td>';
         echo htmlspecialchars($record['year']);
         echo '</td><td>';
         echo htmlspecialchars($record['lastName']) . ', ' . htmlspecialchars($record['firstNames']);
         echo '</td></tr>';
      }

      $result->free();
      $db->close();
   }
   ?>
</table>

<?php include('includes/foot.inc.php'); ?>
