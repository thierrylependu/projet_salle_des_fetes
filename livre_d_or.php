<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';

    
    $query = $pdo->prepare('SELECT * FROM Review');
    $query->execute();
    $reviews = $query->fetchAll(PDO::FETCH_ASSOC);

    /* $query = $mysqli->prepare("SELECT * FROM Review");
    $query->execute();
    $reviews = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    $query->close(); */       


    function getAuthor($id){
        include 'application/bdd_connect.php';
        $query = $pdo->prepare('SELECT * FROM `Account` WHERE id =?');
        $query->execute([$id]);
        $account = $query->fetch(PDO::FETCH_ASSOC);

        /* $query = $mysqli->prepare("SELECT * FROM `Account` WHERE id =?");
        $query->bind_param("i",$id);
        $query->execute();
        $account = $query->get_result()->fetch_assoc();
        $query->close();   */ 

        return $account["userName"];
      }

    $template = 'livre_d_or';
    include 'layout.phtml';


?>