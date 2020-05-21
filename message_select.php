<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';

    $query = $pdo->prepare('SELECT * FROM `Message` WHERE id = ?');
    $query->execute([$_GET["id"]]);
    $message = $query->fetch(PDO::FETCH_ASSOC);
    
   /*  $query = $mysqli->prepare("SELECT * FROM `Message` WHERE id = ?");
    $query->bind_param("i", $_GET["id"]);
    $query->execute();
    $message = $query->get_result()->fetch_assoc();
    $query->close();  */  

    $query = $pdo->prepare('UPDATE Message SET status = "lu" WHERE id = ?'); 
    $query->execute([$_GET["id"]]);
    $edit = $query->fetchAll(PDO::FETCH_ASSOC);    

    /* $query = $mysqli->prepare("UPDATE Message SET status = 'lu' WHERE id = ?");        
    $query->bind_param("i", $_GET["id"]);    
    $query->execute();
    $query->close();   */

    $template = 'message_select';
    include 'layout.phtml';


?>