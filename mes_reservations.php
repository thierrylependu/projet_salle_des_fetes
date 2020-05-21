<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';


    if (!empty($_POST)) {
        $query = $pdo->prepare('UPDATE Reservation SET userComment = ? WHERE id = ?');            
        $query->execute([$_POST["comment"], $_POST["id"]]);
        $edit = $query->fetchAll(PDO::FETCH_ASSOC);

        /* $query = $mysqli->prepare("UPDATE Reservation SET userComment = ? WHERE id = ?");        
        $query->bind_param("si", $_POST["comment"], $_POST["id"]);    
        $query->execute();
        $query->close();    */       

    }

    $query = $pdo->prepare('SELECT * FROM `Reservation` WHERE userId =? ORDER BY date DESC');
    $query->execute([$_SESSION["id"]]);
    $reserv = $query->fetchAll(PDO::FETCH_ASSOC);  

    /* $query = $mysqli->prepare("SELECT * FROM `Reservation` WHERE userId =? ORDER BY date DESC");
    $query->bind_param("i", $_SESSION["id"]);
    $query->execute();
    $reserv = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    $query->close(); */   

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

    $template = 'mes_reservations';
    include 'layout.phtml';


?>