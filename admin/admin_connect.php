<?php
//Tell PHP to log errors
ini_set('log_errors', 'On');
//Tell PHP to not display errors
 ini_set('display_errors', 'Off');
//Set error_reporting to E_ALL
 ini_set('error_reporting', E_ALL );
 $servername = "localhost";
 $username = "spcom_userahja";
 $password = "B99YIWJRB2KX";
 $dbname = "spcom_ahja";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  mysqli_close($conn);
}


?>