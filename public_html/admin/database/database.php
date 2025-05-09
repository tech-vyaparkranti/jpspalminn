<?php
/*user pass db*/
// $link=mysqli_connect("localhost","u658479103_jps","root","");
$link = mysqli_connect("localhost", "jpspalminn", "xH#2a9aTCnr3xd%m", "u658479103_jps"); // 'jps' is your local database name


if ($link -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
 
?>