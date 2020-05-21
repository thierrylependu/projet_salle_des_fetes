<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';

    if (!empty($_GET["id"])) {
        $query = $pdo->prepare('UPDATE Message SET status = "Non lu" WHERE id = ?');
        $query->execute([$_GET["id"]]);
        $message = $query->fetch(PDO::FETCH_ASSOC);

        /* $query = $mysqli->prepare("UPDATE Message SET status = 'Non lu' WHERE id = ?");        
        $query->bind_param("i", $_GET["id"]);    
        $query->execute();
        $query->close();   */         
    }



    header("Location: messages.php#navbar");

?>