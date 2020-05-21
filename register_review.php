<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';


    if(!empty($_POST)){
        $query = $pdo->prepare('INSERT INTO Review (userId, message, mark) values (?,?,?)');
        $query->execute([$_SESSION["id"], $_POST["review"], $_POST["mark"]]);
        $add = $query->fetchAll(PDO::FETCH_ASSOC);

        /* $query = $mysqli->prepare("INSERT INTO Review (userId, message, mark) values (?,?,?)");        
        $query->bind_param("isi", $_SESSION["id"], $_POST["review"], $_POST["mark"]);    
        $query->execute();
        $query->close();  */          
    }
    header("Location: livre_d_or.php#navbar");
?>