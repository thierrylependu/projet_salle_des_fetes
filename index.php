<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';

    $query = $pdo->prepare('SELECT * FROM Events ORDER BY date DESC'); 
    $query->execute();
    $events = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $pdo->prepare('SELECT * FROM Reservation');   
    $query->execute();
    $reserv = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach($reserv as $res){
        if ($res["date"] < date("Y-m-d")) {
            $query = $pdo->prepare('UPDATE Reservation SET status = "termine" WHERE id = ?');            
            $query->execute([$res["id"]]);
            $edit = $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    /* $query = $mysqli->prepare("SELECT * FROM Events ORDER BY date DESC");
    $query->execute();
    $events = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    $query->close();
           

    $query = $mysqli->prepare("SELECT * FROM Reservation");
    $query->execute();
    $reserv = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    $query->close();    

    
    foreach($reserv as $res){
        if ($res["date"] < date("Y-m-d")) {            
            $query = $mysqli->prepare("UPDATE Reservation SET status = 'termine' WHERE id = ?");        
            $query->bind_param("i", $res["id"]);    
            $query->execute();
            $query->close();
        }
    } */

    $template = 'index';
    include 'layout.phtml';


?>