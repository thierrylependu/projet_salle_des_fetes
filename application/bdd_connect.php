<?php

$pdo = new PDO('mysql:host=localhost;dbname=salle_fete', 'user', 'user');

// Paramétrage de la liaison PHP <-> MySQL, les données sont encodées en UTF-8.
$pdo->exec('SET NAMES UTF8');


/* mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
$mysqli = new mysqli("localhost", "user", "user", "salle_fete");

// Paramétrage de la liaison PHP <-> MySQL, les données sont encodées en UTF-8.
$mysqli->set_charset("utf8mb4");
}catch(Exception $e) {
  error_log($e->getMessage());
  exit('Error connecting to database'); //Should be a message a typical user could understand
} */

?>
