<?php

  session_start();
  include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';

  $query = $pdo->prepare('DELETE FROM Account WHERE id = ?');
  $query->execute([$_SESSION["id"]]);
  $delete = $query->fetch(PDO::FETCH_ASSOC);

  /* $query = $mysqli->prepare("DELETE FROM Account WHERE id = ?");        
  $query->bind_param("i", $_SESSION["id"]);    
  $query->execute();
  $query->close();   */  

  session_destroy();

  header("Location: index.php");
?>
