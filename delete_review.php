<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';


    if(!empty($_POST)){
        $query = $pdo->prepare('DELETE FROM Review WHERE id=?');
        $query->execute([$_POST["id"]]);
        $add = $query->fetch(PDO::FETCH_ASSOC);

        /* $query = $mysqli->prepare("DELETE FROM Review WHERE id=?");        
        $query->bind_param("i",$_POST["id"]);    
        $query->execute();
        $query->close(); */
    }
    header("Location: livre_d_or.php#navbar");
?>