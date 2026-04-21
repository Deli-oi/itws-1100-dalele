<?php
include('includes/init.inc.php'); // include the DOCTYPE and opening tags

include('includes/functions.inc.php'); // functions
?>
<title>PHP &amp; MySQL - ITWS</title>

<?php
include('includes/head.inc.php');
// include global css, javascript, end the head and open the body
?>

<h1>PHP &amp; MySQL</h1>

<?php include('includes/menubody.inc.php'); ?>

<?php
// We'll need a database connection both for retrieving records and for
// inserting them.  Let's get it up front and use it for both processes
// to avoid opening the connection twice.  If we make a good connection,
// we'll change the $dbOk flag.
$dbOk = false;

require_once 'includes/config.inc.php';

/* Create a new database connection object, passing in the host, username,
     password, and database to use. The "@" suppresses errors. */
@$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($db->connect_error) {
   echo '<div class="messages">Could not connect to the database. Error: ';
   echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
   $dbOk = true;
}

// Now let's process our form:
// Have we posted?
$havePost = isset($_POST["save"]);

// Let's do some basic validation
$errors = '';
if ($havePost) {

   // Get the output and clean it for output on-screen.
   // Could also output escape with htmlentities()
   $firstNames = htmlspecialchars(trim($_POST["firstNames"]));
   $lastName = htmlspecialchars(trim($_POST["lastName"]));
   $birthYear = htmlspecialchars(trim($_POST["birth_year"]));

   $birthYearInt = (int)$birthYear;
   $birthYearOk = ($birthYearInt >= 1800 && $birthYearInt <= (int)date('Y'));

   $focusId = ''; // trap the first field that needs updating

   if ($firstNames == '') {
      $errors .= '<li>First name may not be blank</li>';
      if ($focusId == '') $focusId = '#firstNames';
   }
   if ($lastName == '') {
      $errors .= '<li>Last name may not be blank</li>';
      if ($focusId == '') $focusId = '#lastName';
   }
   if ($birthYear == '') {
      $errors .= '<li>Birth year may not be blank</li>';
      if ($focusId == '') $focusId = '#birth_year';
   }
   if (!$birthYearOk) {
      $errors .= '<li>Enter a valid 4-digit birth year</li>';
      if ($focusId == '') $focusId = '#birth_year';
   }

   if ($errors != '') {
      echo '<div class="messages"><h4>Please correct the following errors:</h4><ul>';
      echo $errors;
      echo '</ul></div>';
      echo '<script type="text/javascript">';
      echo '  $(document).ready(function() {';
      echo '    $("' . $focusId . '").focus();';
      echo '  });';
      echo '</script>';
   } else {
      if ($dbOk) {
         // Trim the input for inserting into mysql.
         // We use prepared statements so no further escaping is needed.
         $firstNamesForDb = trim($_POST["firstNames"]);
         $lastNameForDb = trim($_POST["lastName"]);
         $birthYearForDb = (int)trim($_POST["birth_year"]);

         // Setup a prepared statement.
         $insQuery = "INSERT INTO actors (`firstNames`,`lastName`,`birth_year`) VALUES (?,?,?)";
         $statement = $db->prepare($insQuery);
         // bind our variables to the question marks
         $statement->bind_param("ssi", $firstNamesForDb, $lastNameForDb, $birthYearForDb);
         // make it so:
         $statement->execute();

         // give the user some feedback
         echo '<div class="messages"><h4>Success: ' . $statement->affected_rows . ' actor added to database.</h4>';
         echo $firstNames . ' ' . $lastName . ', born ' . $birthYear . '</div>';

         // close the prepared statement obj
         $statement->close();
      }
   }
}
?>

<h3>Add Actor</h3>
<form id="addForm" name="addForm" action="index.php" method="post" onsubmit="return validate(this);">
   <fieldset>
      <div class="formData">

         <label class="field" for="firstNames">First Name(s):</label>
         <div class="value"><input type="text" size="60" value="<?php if ($havePost && $errors != '') {
                                                                     echo $firstNames;
                                                                  } ?>" name="firstNames" id="firstNames" /></div>

         <label class="field" for="lastName">Last Name:</label>
         <div class="value"><input type="text" size="60" value="<?php if ($havePost && $errors != '') {
                                                                     echo $lastName;
                                                                  } ?>" name="lastName" id="lastName" /></div>

         <label class="field" for="birth_year">Birth Year:</label>
         <div class="value"><input type="text" size="4" maxlength="4" value="<?php if ($havePost && $errors != '') {
                                                                                    echo $birthYear;
                                                                                 } ?>" name="birth_year" id="birth_year" /> <em>yyyy</em></div>

         <input type="submit" value="save" id="save" name="save" />
      </div>
   </fieldset>
</form>

<h3>Actors <a href="export-actors.php" style="font-size:0.7em; font-weight:normal;">[Export CSV (born &ge; 1965)]</a></h3>
<table id="actorTable">
   <?php
   if ($dbOk) {

      $query = 'SELECT * FROM actors ORDER BY lastName';
      $result = $db->query($query);
      $numRecords = $result->num_rows;

      echo '<tr><th>Name:</th><th>Birth Year:</th><th></th></tr>';
      for ($i = 0; $i < $numRecords; $i++) {
         $record = $result->fetch_assoc();
         if ($i % 2 == 0) {
            echo "\n" . '<tr id="actor-' . $record['id'] . '"><td>';
         } else {
            echo "\n" . '<tr class="odd" id="actor-' . $record['id'] . '"><td>';
         }
         echo htmlspecialchars($record['lastName']) . ', ';
         echo htmlspecialchars($record['firstNames']);
         echo '</td><td>';
         echo htmlspecialchars($record['birth_year']);
         echo '</td><td>';
         echo '<img src="resources/delete.png" class="deleteActor" width="16" height="16" alt="delete actor"/>';
         echo '</td></tr>';
      }

      $result->free();

      // Finally, let's close the database
      $db->close();
   }

   ?>
</table>

<?php include('includes/foot.inc.php');
// footer info and closing tags
?>
