<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';

    if (!empty($_POST)) {

        if (array_key_exists("confirm", $_POST)) {
            $query = $pdo->prepare('UPDATE Reservation SET status = "confirme" WHERE id = ?');            
            $query->execute([$_POST["confirm"]]);
            $edit = $query->fetchAll(PDO::FETCH_ASSOC);

            /* $query = $mysqli->prepare("UPDATE Reservation SET status = 'confirme' WHERE id = ?");        
            $query->bind_param("i", $_POST["confirm"]);    
            $query->execute();
            $query->close();  */              


        }elseif(array_key_exists("delete", $_POST)) {
            $query = $pdo->prepare('DELETE FROM Reservation WHERE id = ?');            
            $query->execute([$_POST["delete"]]);
            $delete = $query->fetchAll(PDO::FETCH_ASSOC);

            /* $query = $mysqli->prepare("DELETE FROM Reservation WHERE id = ?");        
            $query->bind_param("i", $_POST["delete"]);    
            $query->execute();
            $query->close();   */

        }else {
            $query = $pdo->prepare('UPDATE Reservation SET adminComment = ? WHERE id = ?');            
            $query->execute([$_POST["comment"], $_POST["id"]]);
            $edit = $query->fetchAll(PDO::FETCH_ASSOC);

            /* $query = $mysqli->prepare("UPDATE Reservation SET adminComment = ? WHERE id = ?");        
            $query->bind_param("si", $_POST["comment"], $_POST["id"]);    
            $query->execute();
            $query->close(); */

        }
    }

    $query = $pdo->prepare('SELECT * FROM `Reservation` ORDER BY date DESC');
    $query->execute();
    $reserv = $query->fetchAll(PDO::FETCH_ASSOC);  

    /* $query = $mysqli->prepare("SELECT * FROM `Reservation` ORDER BY date DESC");
    $query->execute();
    $reserv = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    $query->close();   */     
    
    function getSatusColor($status){
        if ($status === "En attente") {
            return "table-warning";
        } elseif ($status === "confirme") {
            return "table-primary";
        } elseif ($status === "termine") {
            return "table-success";
        } else{
          return "table-secondary";
        }
      }

    $template = 'historique';
    include 'layout.phtml';


?>