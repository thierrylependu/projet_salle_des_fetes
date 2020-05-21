<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';


    if (!empty($_POST)) {
      
      $count = count($_POST["selectMsg"]);
      for ($i=0; $i < $count; $i++) { 
        
        if ($_POST["submit"] === "Supprimer") {
          $query = $pdo->prepare('DELETE FROM `Message` WHERE id = ?');
          $query->execute([$_POST["selectMsg"][$i]]);
          $delete = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("DELETE FROM `Message` WHERE id = ?");        
          $query->bind_param("i", $_POST["selectMsg"][$i]);    
          $query->execute();
          $query->close();  */ 

        } elseif($_POST["submit"] === "Marquer comme lu"){

          $query = $pdo->prepare('UPDATE Message SET status = "lu" WHERE id = ?');
          $query->execute([$_POST["selectMsg"][$i]]);
          $lu = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Message SET status = 'lu' WHERE id = ?");        
          $query->bind_param("i", $_POST["selectMsg"][$i]);    
          $query->execute();
          $query->close(); */  
    
        } elseif($_POST["submit"] === "Marquer comme non lu"){
    
          $query = $pdo->prepare('UPDATE Message SET status = "Non lu" WHERE id = ?');
          $query->execute([$_POST["selectMsg"][$i]]);
          $nonlu = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Message SET status = 'Non lu' WHERE id = ?");        
          $query->bind_param("i", $_POST["selectMsg"][$i]);    
          $query->execute();
          $query->close(); */ 
        }
      }

  }



    $query = $pdo->prepare('SELECT * FROM `Message` ORDER BY date DESC');
    $query->execute();
    $messages = $query->fetchAll(PDO::FETCH_ASSOC);

    /* $query = $mysqli->prepare("SELECT * FROM `Message` ORDER BY date DESC");
    $query->execute();
    $messages = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    $query->close();  */      

    function getTypeColor($type){
      if ($type === "demande") {
        return "table-success";
      } elseif ($type === "question") {
        return "table-primary";
      } elseif ($type === "remarque") {
        return "table-warning";
      } else{
        return "table-secondary";
      }
    }


    $template = 'messages';
    include 'layout.phtml';


?>